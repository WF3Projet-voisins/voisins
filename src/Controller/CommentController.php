<?php

namespace App\Controller;


use App\Entity\Comment;
use App\Repository\CommentRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentController extends AbstractController
{
    
    public function save(Comment $comment)
    {
        
    }
}
