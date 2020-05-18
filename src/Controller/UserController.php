<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function addUserAction()
    {
        return $this->render('user/formInscription.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    public function getUserAction(Request $request, UserRepository $userRepository, $id)
    {
        $user = $userRepository->find($id);
        return $this->render('user/profileUser.html.twig', [
            'user' => $user
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
