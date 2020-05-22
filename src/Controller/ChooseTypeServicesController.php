<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ChooseTypeServicesController extends AbstractController
{
    
    public function chooseTypeServicesAction($id, UserRepository $userRepository)
    {
        $user = $userRepository->find($id);
        return $this->render('choose_type_services/index.html.twig', ['user'=>$user]);
    }
}
