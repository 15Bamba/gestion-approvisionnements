<?php

namespace App\Controller;

use App\Repository\ApprovisionnementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ApprovisionnementController extends AbstractController
{
    #[Route('/approvisionnements', name: 'app_approvisionnement_index')]
    public function index(ApprovisionnementRepository $approvisionnementRepository): Response
    {
        // Récupère tous les approvisionnements, triés par date de création décroissante
        $approvisionnements = $approvisionnementRepository->findBy([], ['dateCreation' => 'DESC']);

        return $this->render('approvisionnement/index.html.twig', [
            'approvisionnements' => $approvisionnements,
        ]);
    }
}