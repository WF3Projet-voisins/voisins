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
            ->add('postalCode', NumberType::class, [
                'label_attr'=>['class'=> 'red-bg', 'style'=> 'color : black','type' => 'number'],
                'attr' => ['placeholder' => 'Code postal', 'type' => 'number']
            ])
            ->add('city', TextType::class, [
                'label_attr'=>['class'=> 'red-bg', 'style'=> 'color : black'],
                'attr' => ['placeholder' => 'Ville']
            ])

  
            
            ->add('category_affinity', EntityType::class, [
                'class' => Category::class,
                'multiple'=>true,
                'expanded'=>true,
                'label_attr'=>['class'=> 'red-bg', 'style'=> 'color : black'],
                'choice_label' => 'name',
                'attr'=>['class'=>'row m-4 d-flex justify-content-around','style'=>'color : black']
                ])
                
            ->add('sub_cat_affinity', EntityType::class, [
                'class' => SubCategory::class,
                'multiple'=>true,
                'expanded'=>true,
                'label_attr'=>['class'=> 'red-bg', 'style'=> 'color : black'],
                'choice_label' => 'name',
                'attr'=>['class'=>'row m-4 d-flex justify-content-around','style'=>'color : black']
                ])
            ->add('email', TextType::class, [
                'label_attr'=>['class'=> 'red-bg', 'style'=> 'color : black'],
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
