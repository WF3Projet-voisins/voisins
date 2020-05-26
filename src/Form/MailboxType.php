<?php

namespace App\Form;

use App\Entity\Mailbox;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class MailboxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('message_title', TextType::class,['attr'=>[
                'placeholder'=>"Titre de message"
                ]
            ])
            ->add('user_for',EntityType::class,[
                // recherche des choix dans cette entité
                'class' => User::class,            
                // utilise la propriété User.username comme chaîne d'options visible                  
                'choice_label' => function ($user) {
                    return $user->getLastname() . " " . $user->getFirstname(); 
                }                      
            ])
            ->add('message_body', TextareaType::class,['attr'=>[
                'placeholder'=>"Votre message"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mailbox::class,
        ]);
    }
}
