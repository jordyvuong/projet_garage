<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Repository\VoitureRepository;


class VoitureController extends AbstractController
{
    // Action pour afficher les voitures d'occasion
    #[Route('/voitures-occasion', name: 'app_voitures_occasion')]
    public function index(VoitureRepository $voitureRepository): Response
    {
        $voitures = $voitureRepository->findAll();
        return $this->render('voiture/index.html.twig', [
            'voitures' => $voitures,
        ]);
    }

    // Nouvelle action pour ajouter une voiture
    #[Route('/voitures-occasion/new', name: 'app_voiture_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imageFile')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uiqid().'.'.$imageFile->guessExtension();

                // Déplacer le fichier image dans le répertoire d'uploads
                try {
                    $imageFile->move(
                        $this->getParameter('uploads_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Gérer l'erreur si l'upload échoue
                }

                // Enregistrer le chemin de l'image dans l'entité
                $voiture->setImage($newFilename);
            }

            // Enregistrer la voiture dans la base de données
            $entityManager->persist($voiture);
            $entityManager->flush();

            // Redirection après ajout
            return $this->redirectToRoute('app_voitures_occasion');
        }

        return $this->render('voiture/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
