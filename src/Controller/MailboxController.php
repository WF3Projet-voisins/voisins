<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MailboxController extends AbstractController
{
    /**
     * @Route("/mailbox", name="mailbox")
     */
    public function addMailboxAction()
    {

        /* envoyer un message */
        return $this->render('mailbox/index.html.twig', [
            'controller_name' => 'MailboxController',
        ]);
    }


    public function getMailboxAction()
    {
        /* récupère les messages de la bdd entity Mailbox */
    }

    public function updateMailboxAction()
    {
        /* modifier le message envoyé ? à voir si c'est utile ... */
    }

    public function deleteMailboxAction()
    {
        /* supprimer des messages de la bdd */
    }
}
