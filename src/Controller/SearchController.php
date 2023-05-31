<?php

namespace App\Controller;

use App\Entity\Auteurs;
use App\Entity\Header;
use App\Entity\Manif;
use App\Entity\Oeuvres;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/search', name: 'app_search')]
    public function index(Request $request): Response
    {
        $data = $request->query->get("recherche");

        $recherche = $this->entityManager->getRepository(Auteurs::class)->findByAuteurs($data);
        
        $rechercheOeuvre = $this->entityManager->getRepository(Oeuvres::class)->findByOeuvres($data);

        $rechercheManif = $this->entityManager->getRepository(Manif::class)->findByManif($data);

        $header = $this->entityManager->getRepository(Header::class)->findAll();

        return $this->render('search/index.html.twig', [
            'auteurs' => $recherche,
            'oeuvres' => $rechercheOeuvre,
            'manifs' => $rechercheManif,
            'header' => $header
        ]);
    }
}
