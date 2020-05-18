<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
