<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FaqsController extends AbstractController
{
    /**
     * @Route("/faqs", name="faqs")
     */
    public function index(UserRepository $userRepository)
    {
        $users = $userRepository->findAll();
        foreach($users as $user){

        return $this->render('faqs/index.html.twig', [
            'controller_name' => 'FaqsController', 'user' => $user
        ]);
    }
    }
}
