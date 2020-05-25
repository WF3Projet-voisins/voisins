<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AccueilController extends AbstractController
{
   
    public function index(UserInterface $user)
    {
    

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController', 'user'=> $user
        ]);
    }
}
