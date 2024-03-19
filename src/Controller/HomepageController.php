<?php

namespace App\Controller;

use App\Entity\Actuality;
use App\Repository\ActualityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage_index')]
    public function index(ActualityRepository $actualityRepository): Response
    {
        $threeActualities = $actualityRepository->findBy([], ['updatedAt' => 'DESC'], 3);
        return $this->render('homepage/homepage_index.html.twig', [
            'controller_name' => 'HomepageController',
            'threeActualities' => $threeActualities,
        ]);
    }
}
