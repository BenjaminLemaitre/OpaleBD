<?php

namespace App\Controller;

use App\Entity\Header;
use App\Entity\Manif;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/map', name: 'app_map')]
    public function index(): Response
    {

        $manif = $this->entityManager->getRepository(Manif::class)->findAll();
        $header = $this->entityManager->getRepository(Header::class)->findAll();
        

        return $this->render('map/index.html.twig', [
            'manif' => $manif,
            'header' => $header
        ]);
    }
}
