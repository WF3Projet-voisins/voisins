<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AccueilController extends AbstractController
{
   
    public function index(TokenStorageInterface $token, UserRepository $userRepository, ServiceRepository $serviceRepository)
    {
        $user=$token->getToken()->getUser();
        
        $nbUsers = $userRepository->findAll();
        $nbServices = $serviceRepository->findAll();

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController', 'user'=> $user, 'nbUsers'=> $nbUsers, 'nbServices'=> $nbServices
        ]);
    }
}
