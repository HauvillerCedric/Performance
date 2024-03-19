<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EuroController extends AbstractController
{
    #[Route('/euro', name: 'app_euro_index')]
    public function index(): Response
    {
        return $this->render('euro/euro_index.html.twig');
    }
}
