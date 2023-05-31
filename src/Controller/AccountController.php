<?php

namespace App\Controller;

use App\Entity\Header;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/mon-compte', name: 'app_account')]
    public function index(): Response
    {
        $header = $this->entityManager->getRepository(Header::class)->findAll();


        return $this->render('account/index.html.twig', [
            'header' => $header,
        ]);
    }
}
