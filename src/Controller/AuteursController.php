<?php

namespace App\Controller;

use App\Entity\Auteurs;
use App\Entity\Header;
use App\Entity\Oeuvres;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuteursController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/auteurs/{slug}', name: 'app_auteurs')]
    public function index($slug): Response
    {
        $auteur = $this->entityManager->getRepository(Auteurs::class)->findBySlug($slug);
        $header = $this->entityManager->getRepository(Header::class)->findAll();
        $oeuvre = $this->entityManager->getRepository(Oeuvres::class)->findAll();

        return $this->render('auteurs/index.html.twig', [
            "auteur" => $auteur[0],
            'header' => $header,
            'oeuvre' => $oeuvre
        ]);
    }
}
