<?php

namespace App\Controller;

use App\Entity\Service;
use App\Repository\HorairesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(HorairesRepository $horairesRepo, EntityManagerInterface $em): Response
    {
        // Récupérer les horaires d'ouverture
        $horaires = $horairesRepo->findAll();

        // Récupérer tous les services depuis la base de données
        $services = $em->getRepository(Service::class)->findAll();

        // Passer les horaires et les services à la vue
        return $this->render('index.html.twig', [
            'title' => 'Spectral by HTML5 UP',
            'horaires' => $horaires,
            'services' => $services, // Ajouter cette ligne pour passer les services à la vue
        ]);
    }
}