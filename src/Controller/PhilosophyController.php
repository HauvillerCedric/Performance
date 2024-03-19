<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PhilosophyController extends AbstractController
{
    #[Route('/philosophy', name: 'app_philosophy_index')]
    public function index(): Response
    {
        return $this->render('philosophy/philosophy_index.html.twig');
    }
}
