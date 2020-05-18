<?php

namespace App\Form;

use App\Entity\SubCategory;
use App\Entity\Category;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        /*
        $builder
             ->add('lastname')
            ->add('firstname')
            ->add('email')
            ->add('password')
            ->add('image')
            ->add('postalCode')
            ->add('city')
            ->add('category')

            ->add('sub_category')




            ->add('roles')
            ->add('time_gauge')
            ->add('total_time_service_given')
            ->add('rank')
           
        ;
        */

        $builder
            ->add('firstname', TextType::class, [
                'label_attr'=>['class'=> 'red-bg', 'style'=> 'color : black'],
                'attr' => ['placeholder' => 'Prenom']
            ])
            ->add('lastname', TextType::class, [
                'label_attr'=>['class'=> 'red-bg', 'style'=> 'color : black'],
                'attr' => ['placeholder' => 'Nom']
            ])
            ->add('image',FileType::class, [
                'mapped'=>false,
                'required' =>false,
                'label_attr'=>['class'=> 'red-bg', 'style'=> 'color : black'],
                'attr' => ['placeholder' => 'image']
            ])
            ->add('postalCode', TextType::class, [
                'label_attr'=>['class'=> 'red-bg', 'style'=> 'color : black'],
                'attr' => ['placeholder' => 'Code postal', 'type' => 'number']
            ])
            ->add('lastname', TextType::class, [
                'label_attr'=>['class'=> 'red-bg', 'style'=> 'color : black'],
                'attr' => ['placeholder' => 'Ville']
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'multiple'=>true,
                'expanded'=>true,
                'label_attr'=>['class'=> 'red-bg', 'style'=> 'color : black'],
                'choice_label' => 'Categorie',
                'attr'=>['class'=>'row m-4 d-flex justify-content-around','style'=>'color : black']
                ])
            ->add('sub_category', EntityType::class, [
                'class' => SubCategory::class,
                'multiple'=>true,
                'expanded'=>true,
                'label_attr'=>['class'=> 'red-bg', 'style'=> 'color : black'],
                'choice_label' => 'Sous categorie',
                'attr'=>['class'=>'row m-4 d-flex justify-content-around','style'=>'color : black']
                ])

            ->add('email', TextType::class, [
                'label_attr'=>['class'=> 'red-bg', 'style'=> 'color : black'],
                'attr' => ['placeholder' => 'Email', 'type' => 'email']
            ])
            ->add('password', TextType::class, [
                'label_attr'=>['class'=> 'red-bg', 'style'=> 'color : black'],
                'attr' => ['placeholder' => 'Mot de passe', 'type' => 'password']
            ])


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
