<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\UserType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Service\FormsManager;

class UserController extends AbstractController
{
    public function addUserAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        $form = null;
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('image')->getData();
            $user = $form->getData();
            if($file) {
                $newFilename = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                $user->setImage($newFilename);

                // 3) Encode the password (you could also do this via Doctrine listener)
                $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($password);

                // 4) save the User!
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                $this->addFlash('info',"user : ".$user->getName()." well added");
                return $this->redirectToRoute('/inscription');
            }

        }

        return $this->render(
            'user/formInscription.html.twig',
            array('form' => $form->createView())
        );
    }

    public function getUserAction()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    public function updateUserAction()
    {
        /* update des infos user */
        return $this->render('user/profileUser.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    public function deleteUserAction()
    {
        /* Si user veut delete son profil */
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
