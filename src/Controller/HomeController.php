<?php

namespace App\Controller;

use App\Entity\Service;
use App\Repository\HorairesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Document\Temoignage; // Importer la classe Temoignage
use Doctrine\ODM\MongoDB\DocumentManager; // Importer DocumentManager

class HomeController extends AbstractController
{
    private $documentManager;

    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    #[Route('/', name: 'home')]
    public function index(HorairesRepository $horairesRepo, EntityManagerInterface $em): Response
    {
        // Récupérer les horaires d'ouverture
        $horaires = $horairesRepo->findAll();

        // Récupérer tous les services depuis la base de données
        $services = $em->getRepository(Service::class)->findAll();

        // Récupérer les témoignages approuvés
        $temoignages = $this->documentManager->getRepository(Temoignage::class)
            ->findBy(['approved' => true]); // Récupère uniquement les témoignages approuvés

        // Passer les horaires, les services et les témoignages à la vue
        return $this->render('index.html.twig', [
            'title' => 'Spectral by HTML5 UP',
            'horaires' => $horaires,
            'services' => $services, // Ajouter cette ligne pour passer les services à la vue
            'temoignages' => $temoignages, // Ajouter les témoignages
        ]);
    }

    #[Route('/temoignages/form', name: 'temoignage_submit', methods: ['GET', 'POST'])]
    public function submitTemoignage(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $name = $request->request->get('name');
            $comment = $request->request->get('comment');
            $rating = $request->request->get('rating');

            $temoignage = new Temoignage();
            $temoignage->setName($name);
            $temoignage->setComment($comment);
            $temoignage->setRating($rating);
            $temoignage->setApproved(false); // Par défaut, les témoignages sont non approuvés

            $this->documentManager->persist($temoignage);
            $this->documentManager->flush();

            return $this->redirectToRoute('home'); // Redirige vers la page d'accueil après soumission
        }

        return $this->render('temoignages/form.html.twig'); // Créez ce fichier Twig pour le formulaire
    }

    #[Route('/temoignages/moderation', name: 'temoignage_moderation', methods: ['GET'])]
    public function showModerationTemoignages(): Response
    {
        $temoignages = $this->documentManager->getRepository(Temoignage::class)
            ->findBy(['approved' => false]); // Récupère uniquement les témoignages non approuvés

        return $this->render('temoignages/moderer.html.twig', [
            'temoignages' => $temoignages,
        ]);
    }

    #[Route('/temoignages/approuver/{id}', name: 'temoignage_approuver', methods: ['POST'])]
    public function approveTemoignage(string $id): Response
    {
        $temoignage = $this->documentManager->getRepository(Temoignage::class)->find($id);

        if ($temoignage) {
            $temoignage->setApproved(true);
            $this->documentManager->flush();
        }

        return $this->redirectToRoute('temoignage_moderation'); // Redirige vers la page de modération après approbation
    }

    #[Route("/temoignages/rejeter/{id}", name: "temoignage_rejeter", methods: ["POST"])]
public function rejectTemoignage(string $id): Response
{
    $temoignage = $this->documentManager->getRepository(Temoignage::class)->find($id);

    if ($temoignage) {
        $this->documentManager->remove($temoignage); // Supprimer le témoignage
        $this->documentManager->flush();
    }

    return $this->redirectToRoute('temoignage_moderation'); // Redirige vers la page de modération après suppression
}

#[Route("/temoignages/supprimer/{id}", name: "temoignage_supprimer", methods: ["POST"])]
public function deleteTemoignage(string $id): Response
{
    $temoignage = $this->documentManager->getRepository(Temoignage::class)->find($id);

    if ($temoignage) {
        $this->documentManager->remove($temoignage); // Supprimer le témoignage
        $this->documentManager->flush();
    }

    return $this->redirectToRoute('temoignage_approved_list'); // Redirige vers la liste des témoignages approuvés après suppression
}
#[Route('/temoignages/approuves', name: 'temoignage_approved_list')]
public function listApprovedTemoignages(): Response
{
    // Récupérer les témoignages approuvés
    $temoignages = $this->documentManager->getRepository(Temoignage::class)
        ->findBy(['approved' => true]);

    return $this->render('temoignages/list.html.twig', [
        'temoignages' => $temoignages,
    ]);
}
}

