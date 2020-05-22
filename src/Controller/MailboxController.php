<?php

namespace App\Controller;

use App\Entity\Mailbox;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class MailboxController extends AbstractController
{
    
    public function addMailboxAction()
    {
        $id=63;
        // On appelle la donne user
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);                
        // On appelle la liste de tous les messagerie       
        $messages = $this->getDoctrine()->getRepository(Mailbox::class)->findAll();
                
        /* mailbox index */
        return $this->render('mailbox/index.html.twig', [
            "user"       =>  $user,
            "messages"   =>  $messages
        ]);
    }

    /**
     * @Route("/user/mailbox/add", name="addMailbox")
     */
    public function addMailbox()
    {
        $id=63;
        // On appelle la donne user
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);                

        /* envoyer un message */
        return $this->render('mailbox/addMailbox.html.twig', [
            "user"       =>  $user,
        ]);
    }

    /**
     * @Route("/user/mailbox/view/{id}", name="viewMailbox")
     */
    public function viewMailbox()
    {
        $id=63;
        // On appelle la donne user
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);                

        /* récupère les messages de la bdd entity Mailbox */
        return $this->render('mailbox/viewMailbox.html.twig', [
            "user"       =>  $user,
        ]);
    }

    /**
     * @Route("/user/mailbox/update/{id}", name="updateMailbox")
     */
    public function updateMailbox()
    {
        $id=63;
        // On appelle la donne user
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);                

        /* modifier le message envoyé ? à voir si c'est utile ... */
        return $this->render('mailbox/updateMailbox.html.twig', [
            "user"       =>  $user,
        ]);

    }

    /**
     * @Route("/user/mailbox/delete/{id}", name="deleteMailbox")
     */
    public function deleteMailbox()
    {
        $id=63;
        // On appelle la donne user
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);                

        /* supprimer des messages de la bdd */
        return $this->render('mailbox/deleteMailbox.html.twig', [
            "user"       =>  $user,
        ]);

    }
}