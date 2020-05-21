<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Service;
use App\Entity\Category;
use App\Entity\Duration;
use App\Entity\SubCategory;
use App\Entity\TypeService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('status')
            ->add('image', FileType::class, ['mapped' => false, 'required' => false])
            ->add('duration', EntityType::class, ['class' => Duration::class, 'multiple' => false, 'expanded' => true, 'choice_label' => 'duration']) /* FK */
            ->add('type_service', EntityType::class, ['class' => TypeService::class, 'multiple' => false, 'expanded' => false, 'choice_label' => 'name'])
            ->add('sub_category', EntityType::class, ['class' => SubCategory::class, 'multiple' => false, 'expanded' => false, 'choice_label' => 'name', 'group_by' => 'category.name'])
            ->add('save', SubmitType::class);;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
