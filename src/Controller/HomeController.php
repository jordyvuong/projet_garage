<?php

namespace App\Controller;

use App\Repository\HorairesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(HorairesRepository $horairesRepo): Response
    {
        // Récupérer les horaires d'ouverture
        $horaires = $horairesRepo->findAll();

        // Passer les horaires à la vue
        return $this->render('index.html.twig', [
            'title' => 'Spectral by HTML5 UP',
            'horaires' => $horaires,
        ]);
    }
}