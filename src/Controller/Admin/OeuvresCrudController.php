<?php

namespace App\Controller\Admin;

use App\Entity\Oeuvres;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OeuvresCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Oeuvres::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            SlugField::new('slug')->setTargetFieldName('name'),          # on reprend le nom du produit pour générer un slug (bonnet_de_cuir)
            ImageField::new('illustration')
                ->setBasePath('assets/img/oeuvres/')
                ->setUploadDir('public/assets/img/oeuvres'),
            TextField::new('subtitle'),
            TextareaField::new('description'),
            AssociationField::new('category'),
            AssociationField::new('auteur'),
            AssociationField::new('series')
                ->setRequired(false),
        ];
    }

}
