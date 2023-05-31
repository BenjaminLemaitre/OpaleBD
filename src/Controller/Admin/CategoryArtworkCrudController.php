<?php

namespace App\Controller\Admin;

use App\Entity\CategoryArtwork;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoryArtworkCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategoryArtwork::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            ImageField::new('illustration')
                ->setBasePath('assets/img/categoryoeuvres/')
                ->setUploadDir('public/assets/img/categoryoeuvres'),
        ];
    }
    
}
