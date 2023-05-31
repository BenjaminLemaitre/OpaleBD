<?php

namespace App\Controller;

use App\Entity\Auteurs;
use App\Entity\Manif;
use App\Entity\Oeuvres;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheResultatController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/recherche/resultat/{name}', name: 'app_recherche_resultat')]
    public function index(Request $request, $name): Response
    {
        $oeuvres = $this->entityManager->getRepository(Oeuvres::class)->findByOeuvres($name);
        $auteurs = $this->entityManager->getRepository(Auteurs::class)->findByAuteurs($name);
        $manifs = $this->entityManager->getRepository(Manif::class)->findByManif($name);

        $view = $this->render('search/resultat.html.twig', [
            'oeuvres' => $oeuvres,
            'auteurs' => $auteurs,
            'manifs' => $manifs,
        ]);

        $response = new Response($view);
        $response->headers->set('Content-Type', 'text/html');

        $json = [
            'view' => $view
        ];
        return $this->json($json);
    }
}
