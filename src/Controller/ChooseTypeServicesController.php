<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ChooseTypeServicesController extends AbstractController
{
    
    public function chooseTypeServicesAction()
    {
        return $this->render('choose_type_services/index.html.twig');
    }
}
