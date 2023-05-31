<?php

namespace App\Controller\Admin;

use App\Entity\Auteurs;
use App\Entity\Manif;
use App\Entity\CategoryArtwork;
use App\Entity\Header;
use App\Entity\Oeuvres;
use App\Entity\Series;
use App\Entity\User;
use App\Entity\Shop;
use App\Entity\Product;
use App\Entity\Carrier;
use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/admin.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('OpaleBD');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('CatégorieOeuvres', 'fas fa-list', CategoryArtwork::class); 
        yield MenuItem::linkToCrud('Manif', 'fas fa-calendar', Manif::class);
        yield MenuItem::linkToCrud('Auteurs', 'fas fa-user', Auteurs::class); 
        yield MenuItem::linkToCrud('Series', 'fas fa-server', Series::class); 
        yield MenuItem::linkToCrud('Oeuvres', 'fas fa-book', Oeuvres::class);
        yield MenuItem::linkToCrud('Categories Shop', 'fas fa-list', Shop::class);
        yield MenuItem::linkToCrud('Boutique', 'fas fa-cart-shopping', Product::class); 
        yield MenuItem::linkToCrud('Banniere', 'fas fa-desktop', Header::class);
        yield MenuItem::linkToCrud('Transporteur', 'fas fa-truck', Carrier::class);
        yield MenuItem::linkToCrud('Commandes', 'fas fa-cart-shopping', Order::class);
    }
}
