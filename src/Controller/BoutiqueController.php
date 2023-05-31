<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Header;
use App\Entity\Product;
use App\Entity\Shop;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoutiqueController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/boutique', name: 'app_boutique')]
    public function index(Request $request): Response
    {
        $products = $this->entityManager->getRepository(Product::class)->findAll();

        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // la ligne en dessous provoque un bug, c'est le findWithSearch le soucis mais j'ai pas trouvé (voir chapitre 5 les produits > vidéo n°35 a 22min48)
            $products = $this->entityManager->getRepository(Product::class)->findWithSearch($search);
        }
        $header = $this->entityManager->getRepository(Header::class)->findAll();

        return $this->render('boutique/index.html.twig', [
            'products' => $products,
            'form' => $form->createView(),
            'header' => $header
        ]);
    }

    #[Route('/boutique/produit/{slug}', name: 'app_boutique_produit')]
    public function show($slug): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findOneBySlug($slug);
        $header = $this->entityManager->getRepository(Header::class)->findAll();
        
        if (!$product) {
            return $this->redirectToRoute('app_boutique');
        }

        return $this->render('boutique/show.html.twig', [
            'product' => $product,
            'header' => $header
        ]);
    }
}
