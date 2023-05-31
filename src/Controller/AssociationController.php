<?php

namespace App\Controller;

use App\Entity\Header;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AssociationController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/association', name: 'app_association')]
    public function index(): Response
    {
        $header = $this->entityManager->getRepository(Header::class)->findAll();

        return $this->render('association/index.html.twig', [
            'header' => $header,
        ]);
    }
}
