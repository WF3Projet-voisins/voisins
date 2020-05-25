<?php

namespace App\Controller;

use App\Repository\FaqRepository;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class FaqsController extends AbstractController
{
    /**
     * @Route("/faqs", name="faqs")
     */
    public function index(TokenStorageInterface $token, FaqRepository $faqRepository, UserRepository $userRepository)
    {
        $user=$token->getToken()->getUser();
        $faqs = $faqRepository->findAll();

        return $this->render('faqs/index.html.twig', [
            'controller_name' => 'FaqsController', 'user' => $user, "faqs"=>$faqs
        ]);
    
    }
}
