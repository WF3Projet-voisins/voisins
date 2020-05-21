<?php

namespace App\Form;

use App\Entity\SubCategory;
use App\Entity\Category;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => ['placeholder' => 'Nom']
            ])
            ->add('lastname', TextType::class, [
                'attr' => ['placeholder' => 'Nom']
            ])
            ->add('image',FileType::class, [
                'mapped'=>false,
                'required' =>false,
                'attr' => ['placeholder' => 'image']
            ])
            ->add('postalCode', NumberType::class, [    
                'attr' => ['placeholder' => 'Code postal', 'type' => 'number'],
               
            ])
            ->add('city', TextType::class, [               
                'attr' => ['placeholder' => 'Ville']
            ])
            
            ->add('category_affinity', EntityType::class, [
                'class' => Category::class,
                'multiple'=>true,
                'expanded'=>true,
                'choice_label' => 'name',
                ])
                
            ->add('sub_cat_affinity', EntityType::class, [
                'class' => SubCategory::class,
                'multiple'=>true,
                'expanded'=>true,
                'choice_label' => 'name'
                ])
                
            ->add('email', TextType::class, [
                'attr' => ['placeholder' => 'Email', 'type' => 'email']
            ])
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
            ->add('save', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
