<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MailboxController extends AbstractController
{
    /**
     * @Route("/mailbox", name="mailbox")
     */
    public function index()
    {
        return $this->render('mailbox/index.html.twig', [
            'controller_name' => 'MailboxController',
        ]);
    }
}
