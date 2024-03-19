<?php

namespace App\Controller;

use App\Repository\LicenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LicenceBEAController extends AbstractController
{
    #[Route('/licenceBEA', name: 'app_licence_bea_index')]
    public function index(LicenceRepository $licenceRepository): Response
    {
        $licenceBEA = $licenceRepository->find('2');
        return $this->render('licence_bea/licence_bea_index.html.twig', [
            'licenceBEA' => $licenceBEA,
        ]);
    }
}
