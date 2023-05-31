<?php

namespace App\Controller;

use App\Classe\Search_agenda;
use App\Entity\CategoryArtwork;
use App\Entity\Header;
use App\Entity\Manif;
use App\Form\SearchAgendaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgendaController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/agenda', name: 'app_agenda')]
    public function index(Request $request): Response
    {
        $category = $this->entityManager->getRepository(CategoryArtwork::class)->findAll();
        $searchAgenda = new Search_agenda();
        $form = $this->createForm(SearchAgendaType::class, $searchAgenda);

        $form->handleRequest($request);
        $manif = $this->entityManager->getRepository(Manif::class)->findByAgenda();

        if ($form->isSubmitted() && $form->isValid()) {
            $manif = $this->entityManager->getRepository(Manif::class)->findWithSearch($searchAgenda);
        }

        $header = $this->entityManager->getRepository(Header::class)->findAll();

        return $this->render('agenda/index.html.twig', [
            'manif' => $manif,
            'form' => $form->createView(),
            'category' => $category,
            'header' => $header,
        ]);
    }
}
