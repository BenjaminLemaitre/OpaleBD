<?php

namespace App\Controller;

use App\Entity\Header;
use App\Entity\Manif;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
        $manif = $this->entityManager->getRepository(Manif::class)->findAll();
        $header = $this->entityManager->getRepository(Header::class)->findAll();

        return $this->render('accueil/index.html.twig', [
            'manif' => $manif,
            'header' => $header
        ]);
    }
}
