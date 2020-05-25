<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AproposController extends AbstractController
{
    /**
     * @Route("/apropos", name="apropos")
     */
    public function index(TokenStorageInterface $token)
    {
        $user=$token->getToken()->getUser();
        return $this->render('apropos/index.html.twig', [
            'controller_name' => 'AproposController', 'user'=> $user
        ]);
    }
}
