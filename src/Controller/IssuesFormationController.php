<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IssuesFormationController extends AbstractController
{
    #[Route('/issues/formation', name: 'app_issues_formation_index')]
    public function index(): Response
    {
        return $this->render('issues_formation/issuesFormation_index.html.twig');
    }
}
