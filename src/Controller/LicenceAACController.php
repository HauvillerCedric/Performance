<?php

namespace App\Controller;

use App\Repository\LicenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LicenceAACController extends AbstractController
{
    #[Route('/licenceAAC', name: 'app_licence_aac_index')]
    public function index(LicenceRepository $licenceRepository): Response
    {
        $licenceAAC = $licenceRepository->find('3');

        return $this->render('licence_aac/licence_aac_index.html.twig', [
            'licenceAAC' => $licenceAAC,
        ]);
    }
}
