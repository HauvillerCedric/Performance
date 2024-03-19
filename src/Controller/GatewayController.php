<?php

namespace App\Controller;

use App\Repository\GatewayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GatewayController extends AbstractController
{
    #[Route('/gateway', name: 'app_gateway_index')]
    public function index(GatewayRepository $gatewayRepository): Response
    {
        $gateway = $gatewayRepository->find('1');

        return $this->render('gateway/gateway_index.html.twig', [
            'gateway' => $gateway,
        ]);
    }
}
