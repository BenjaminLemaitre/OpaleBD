<?php

namespace App\Controller\Admin;

use App\Entity\Series;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SeriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Series::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            AssociationField::new('auteur'),
        ];
    }
}
