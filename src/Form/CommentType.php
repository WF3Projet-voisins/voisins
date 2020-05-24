<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Comment;
use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('message', TextareaType::class)
            ->add('user_from', EntityType::class, ['class' => User::class, 'multiple' => false, 'expanded' => false, 'choice_label' => 'id'])
            ->add('service', EntityType::class, ['class' => Service::class, 'multiple' => false, 'expanded' => false, 'choice_label' => 'id'])
            ->add('save', SubmitType::class)
        ;
    }

    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
