<?php

namespace App\Controller;

use App\Entity\Auteurs;
use App\Entity\Header;
use App\Entity\Manif;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ManifController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/manif/{slug}', name: 'app_manif')]
    public function index($slug): Response
    {
        $manif = $this->entityManager->getRepository(Manif::class)->findBySlug($slug);
        $header = $this->entityManager->getRepository(Header::class)->findAll();
        $auteur = $this->entityManager->getRepository(Auteurs::class)->findAll();

        return $this->render('manif/index.html.twig', [
            "manif" => $manif[0],
            'header' => $header,
            'auteur' => $auteur
        ]);
    }
}
