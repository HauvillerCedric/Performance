<?php

namespace App\Controller;

use App\Repository\AgencyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgenciesController extends AbstractController
{
    #[Route('/agencies', name: 'app_agencies_index')]
    public function index(AgencyRepository $agencyRepository): Response
    {
        $firstAgency = $agencyRepository->findOneBy(['city' => 'Mulhouse']);
        $secondAgency = $agencyRepository->findOneBy(['city' => 'Pfastatt']);

        return $this->render('agencies/agencies_index.html.twig', [
            'mulhouse' => $firstAgency,
            'pfastatt' => $secondAgency
        ]);
    }
}
