<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonnelController extends AbstractController
{
    #[Route('/personnel', name: 'app_personnel_index')]
    public function index(): Response
    {
        return $this->render('personnel/personnel_index.html.twig');
    }
}
