<?php

namespace App\Controller;

use App\Entity\Mailbox;
use App\Form\MailboxType;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\MailboxRepository;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MailboxController extends AbstractController
{

    /**
     * @Route("/user/mailbox/", name="index")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {        
        // FR - On appelle la donne user
         // usually you'll want to make sure the user is authenticated first
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
                      
        // On appelle la liste de tous les messagerie       
        $messages = $this->getDoctrine()->getRepository(Mailbox::class)->findAll();

        $messagesForMailBox = $paginator->paginate(
            $messages,
            $request->query->getInt('page',1),
            2   
        );
     
        /* mailbox index */
        return $this->render('mailbox/index.html.twig', [
            "user"       =>  $user,            
            "messagesForMailBox"   =>  $messagesForMailBox
        ]);
    }

    /**
     * @Route("/user/mailbox/add", name="addMailboxAction")
     */
    public function addMailboxAction(Request $request)
    {
        // FR - On appelle la donne user
        // généralement, vous voudrez vous assurer que l'utilisateur est authentifié en premier
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // renvoie votre objet User, ou null si l'utilisateur n'est pas authentifié
        // utiliser la documentation en ligne pour indiquer à votre éditeur votre classe d'utilisateurs exacte
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $form = null;
        // On instancie l'entité Mailbox
        $mailbox = new Mailbox();
        // Nous créons l'objet formulaire
        $form = $this->createForm(MailboxType::class, $mailbox);
        // On récupère les données saisies
        $form->handleRequest($request);
        //On vérifie si le formulaire a été envoyé et si les données sont valides
        if ($form->isSubmitted() && $form->isValid()){
            // Ici le formulaire a été envoyé et les données sont valides
            $mailbox->setCreatedAt(new \DateTime('now'));
            $mailbox->setUserFrom($user);
            // On instancie Doctrine                            - $manager
            $doctrine = $this->getDoctrine()->getManager();
            // On hygrate $mailbox                              - $manager
            $doctrine->persist($mailbox);
            // On écrit dans la dase  de données                - $manager
            $doctrine->flush();

            //$this->addFlush('messageMailbox','Votre nouvelle message a bien été publié');
            return  $this->redirectToRoute('mailbox');
        }

        // envoyer un message 
        return $this->render('mailbox/addMailbox.html.twig', [            
            "user"          => $user,
            "mailbox"       => $mailbox,
            "mailboxForm"   => $form->createView()            
        ]);
    }

    /**
     * @Route("/user/mailbox/view/{id}", name="viewMailboxAction")
     */
    public function viewMailboxAction($id, UserRepository $userRepository, MailboxRepository $MailboxRepository)
    {
        // FR - On appelle la donne user
        // généralement, vous voudrez vous assurer que l'utilisateur est authentifié en premier
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // renvoie votre objet User, ou null si l'utilisateur n'est pas authentifié
        // utiliser la documentation en ligne pour indiquer à votre éditeur votre classe d'utilisateurs exacte
        /** @var \App\Entity\User $user */
        $user = $this->getUser();                

        // On instancie l'entité Mailbox
        $mailbox = new Mailbox();
        $mailbox = $MailboxRepository->find($id);

        $mbUserFrom = new User();
        $mbUserFrom = $userRepository->find($mailbox->getUserFrom());
        
        $mbUserFor = new User();
        $mbUserFor = $userRepository->find($mailbox->getUserFor());
 
        /* récupère les messages de la bdd entity Mailbox */
        return $this->render('mailbox/viewMailbox.html.twig', [
            "user"          => $user,
            "mailbox"       => $mailbox,            
            "mbuserfrom"    => $mbUserFrom,
            "mbuserfor"     => $mbUserFor
        ]);
    }

    /**
     * @Route("/user/mailbox/update/{id}", name="updateMailboxAction")
     */
    public function updateMailboxAction($id, Request $request, MailboxRepository $MailboxRepository)
    {
        // FR - On appelle la donne user
        // généralement, vous voudrez vous assurer que l'utilisateur est authentifié en premier
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // renvoie votre objet User, ou null si l'utilisateur n'est pas authentifié
        // utiliser la documentation en ligne pour indiquer à votre éditeur votre classe d'utilisateurs exacte
        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        $form = null;
        // On instancie l'entité Mailbox
        $mailbox = new Mailbox();
        $mailbox = $MailboxRepository->find($id);
        // Nous créons l'objet formulaire
        $form = $this->createForm(MailboxType::class, $mailbox);
        // On récupère les données saisies
        $form->handleRequest($request);
        //On vérifie si le formulaire a été envoyé et si les données sont valides
        if ($form->isSubmitted() && $form->isValid()){
            // Ici le formulaire a été envoyé et les données sont valides
            $mailbox->setCreatedAt(new \DateTime('now'));
            $mailbox->setUserFrom($user);
            // On instancie Doctrine                            - $manager
            $doctrine = $this->getDoctrine()->getManager();
            // On hygrate $mailbox                              - $manager
            $doctrine->persist($mailbox);
            // On écrit dans la dase  de données                - $manager
            $doctrine->flush();

            //$this->addFlush('messageMailbox','Votre nouvelle message a bien été publié');
            return  $this->redirectToRoute('mailbox');
        }

        /* modifier le message envoyé ? à voir si c'est utile ... */
        return $this->render('mailbox/updateMailbox.html.twig', [            
            "user"          => $user,
            "mailbox"       => $mailbox,
            "mailboxForm"   => $form->createView()            
        ]);
    }

    /**
     * @Route("/user/mailbox/delete/{id}", name="deleteMailboxAction")
     */
    public function deleteMailboxAction($id, UserRepository $userRepository, MailboxRepository $MailboxRepository)
    {
         // FR - On appelle la donne user
        // généralement, vous voudrez vous assurer que l'utilisateur est authentifié en premier
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // renvoie votre objet User, ou null si l'utilisateur n'est pas authentifié
        // utiliser la documentation en ligne pour indiquer à votre éditeur votre classe d'utilisateurs exacte
        /** @var \App\Entity\User $user */
        $user = $this->getUser();                

        // On instancie l'entité Mailbox
        $mailbox = new Mailbox();
        $mailbox = $MailboxRepository->find($id);

        $mbUserFrom = new User();
        $mbUserFrom = $userRepository->find($mailbox->getUserFrom());
        
        $mbUserFor = new User();
        $mbUserFor = $userRepository->find($mailbox->getUserFor());
  
        /* supprimer des messages de la bdd */
        return $this->render('mailbox/deleteMailbox.html.twig', [
            "user"       =>  $user,
            "mailbox"       => $mailbox,            
            "mbuserfrom"    => $mbUserFrom,
            "mbuserfor"     => $mbUserFor
        ]);
    }

    /**
     * @Route("/user/mailbox/ouidel/{id}", name="ouidelMailboxAction")
     */
    public function ouidelMailboxAction($id, MailboxRepository $MailboxRepository)
    {
        // FR - On appelle la donne user
        // généralement, vous voudrez vous assurer que l'utilisateur est authentifié en premier
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $mailbox = $MailboxRepository->find($id);
        $manager = $this->getDoctrine()->getManager();

        $manager->remove($mailbox);
        $manager->flush();

        /* supprimer des messages de la bdd */
        return $this->redirectToRoute('mailbox');
    }
}