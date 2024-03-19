<?php

namespace App\Controller;

use App\Repository\PerfectionnementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PerfectionnementController extends AbstractController
{
    #[Route('/perfectionnement', name: 'app_perfectionnement_index')]
    public function index(PerfectionnementRepository $perfectionnementRepository): Response
    {
        $perfectionnement = $perfectionnementRepository->find('1');
        return $this->render('perfectionnement/Perfectionnement_index.html.twig', [
            'perfectionnement' => $perfectionnement,
        ]);
    }
}
