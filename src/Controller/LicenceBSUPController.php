<?php

namespace App\Controller;

use App\Repository\LicenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LicenceBSUPController extends AbstractController
{
    #[Route('/licenceBSUP', name: 'app_licence_bsup_index')]
    public function index(LicenceRepository $licenceRepository): Response
    {
        $licenceBSUP = $licenceRepository->find(4);
        return $this->render('licence_bsup/licence_bsup_index.html.twig', [
            'licenceBSUP' => $licenceBSUP,
        ]);
    }
}
