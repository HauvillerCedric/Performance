<?php

namespace App\Controller;

use App\Repository\LicenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LicenceBController extends AbstractController
{
    #[Route('/licenceB', name: 'app_licence_b_index')]
    public function index(LicenceRepository $licenceRepository): Response
    {
        $licenceB = $licenceRepository->find('1');
        return $this->render('licence_b/Licence_b_index.html.twig', [
            'licenceB' => $licenceB,
        ]);
    }
}
