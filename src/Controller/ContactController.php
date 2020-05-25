<?php

namespace App\Controller;

use DateTimeInterface;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ContactController extends AbstractController
{
    
    public function addContactAction(TokenStorageInterface $token, Request $request, UserRepository $userRepository)
    {
        $securityContext = $this->container->get('security.authorization_checker');
        $user=$token->getToken()->getUser();
        $form = null;
        // 1) build the form
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() ) {
            if($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')){
                $contact->setUser($user);
                $contact->setName($user->getLastname() .' '. $user->getFirstname());
                $contact->setMail($user->getEMail());
            }
                $contact->setCreatedAt(new \DateTime());

                $contact = $form->getData();
                // 4) save the Contact!
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($contact);
                $entityManager->flush();
                $this->get('session')->getFlashBag()->add('Message', 'Message bien envoyé');
                return $this->redirectToRoute('contactAdd');

                
                    }

            

        
            return $this->render(
                'contact/index.html.twig',
                array('form' => $form->createView(),'user' => $user)
            );
        







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
