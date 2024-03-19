<?php

namespace App\Controller;

use App\Entity\Actuality;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActualitiesController extends AbstractController
{
    #[Route('/actualities/{slug}', name: 'app_actualities_show')]
    public function show(Actuality $actuality): Response
    {
        return $this->render('actualities/actualities_show.html.twig', [
            'actuality' => $actuality,
        ]);
    }
}
