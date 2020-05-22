<?php

namespace App\Controller;

use Symfony\Component\HttpClient\HttpClient;
use App\Entity\User;
use App\Entity\Category;
use App\Entity\SubCategory;
use App\Form\UserType;
use App\Repository\CategoryRepository;
use App\Repository\SubCategoryRepository;

use App\Service\FormsManager;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



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
            $user->setTimeGauge('0');
            $user->setTotalTimeServiceGiven('0');
            $user->setRoles(['ROLE_USER']);
            $file = $form->get('image')->getData();
            $user = $form->getData();
            if ($file) {
                $newFilename = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                $user->setImage($newFilename);
            } else {
                $user->setImage('https://cdn.pixabay.com/photo/2020/05/03/13/09/puppy-5124947_960_720.jpg');
            }
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            
            $token = new UsernamePasswordToken(
                $user,
                $password,
                'main',
                $user->getRoles()

            );

            $this->get('security.token_storage')->setToken($token);
            $this->get('session')->set('_security_main', serialize($token));

            return $this->redirectToRoute('chooseTypeServices', ['id'=> $user->getId()]);
            
        }

        return $this->render(
            'user/formInscription.html.twig',
            ['form' => $form->createView()]
        );
    }

    public function getUserAction(Request $request, UserRepository $userRepository, $id, CategoryRepository $categoryRepository, SubCategoryRepository $subCategoryRepository)
    {
        $user = $userRepository->find($id);
        $categories = $categoryRepository->findAll();
        $subCategories = $subCategoryRepository->findAll();

        $formUser = $this->createForm('App\Form\UserType', $user);
        $formUser->handleRequest($request);

        if ($formUser->isSubmitted()) {
            $user = $formUser->getData();
            $file = $formUser->get('image')->getData();
            if ($file) {
                $newFileName = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                $user->setImage($newFileName);
            }

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('userProfile', ['id' => $id]);
        }
        return $this->render('user/profileUser.html.twig', ["user" => $user, "categories" => $categories, "subCategories" => $subCategories, "formUser" => $formUser->createView()]);
    }

    public function updateUserAction(UserRepository $userRepository, $id, Request $request)
    {
    }


    public function deleteUserAction()
    {
        /* Si user veut delete son profil */
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
