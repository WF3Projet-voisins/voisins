<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\ContactType;
use App\Entity\Contact;
use DateTimeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    
    public function addContactAction(Request $request)
    {
        $form = null;
        // 1) build the form
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

                $contact->setCreatedAt(new \DateTime());

                $contact = $form->getData();
                // 4) save the Contact!
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($contact);
                $entityManager->flush();
                $this->addFlash('info',"contact : ".$contact->getName()." well added");
                //return $this->redirectToRoute('user/index.html.twig');
                return $this->render('home/index.html.twig', [
                    'controller_name' => $contact->getName()
                ]);

        }

       





        return $this->render(
            'contact/index.html.twig',
            array('form' => $form->createView())
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
