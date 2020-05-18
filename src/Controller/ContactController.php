<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function addContactAction()
    {
        /* envoyer un message pour nous contacter */
        /* voir form */
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }


    public function getContactAction()
    {
        /*  utile si mise en place d'un dashboard admin */
    }

    public function deleteContactAction()
    {
        /* utile si mise en place d'un dashboard admin */
    }

    
}
