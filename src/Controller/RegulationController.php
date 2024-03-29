<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegulationController extends AbstractController
{
    #[Route('/regulation', name: 'app_regulation_index')]
    public function index(): Response
    {
        return $this->render('regulation/regulation_index.html.twig');
    }
}
