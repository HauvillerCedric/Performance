<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvaluationController extends AbstractController
{
    #[Route('/evaluation', name: 'app_evaluation_index')]
    public function index(): Response
    {
        return $this->render('evaluation/evaluation_index.html.twig');
    }
}
