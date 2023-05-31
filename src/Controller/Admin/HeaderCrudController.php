<?php

namespace App\Controller\Admin;

use App\Entity\Header;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HeaderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Header::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('url', 'Lien vers la page'),
            ImageField::new('banniere', 'Bannière 1550x255')
            ->setBasePath('assets/img/pub/')
            ->setUploadDir('public/assets/img/pub/')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
        ];
    }
    
}
