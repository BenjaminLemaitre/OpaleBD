<?php

namespace App\Controller;

use App\Entity\Auteurs;
use App\Entity\Header;
use App\Entity\Oeuvres;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtworkController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/oeuvres/{slug}', name: 'app_artwork')]
    public function index($slug): Response
    {
        $oeuvre = $this->entityManager->getRepository(Oeuvres::class)->findBySlug($slug);
        $header = $this->entityManager->getRepository(Header::class)->findAll();
        $auteur = $this->entityManager->getRepository(Auteurs::class)->findAll();


        return $this->render('artwork/index.html.twig', [
            'oeuvre' => $oeuvre[0],
            'header' => $header,
            'auteur' => $auteur
        ]);
    }
}
