<?php

namespace App\Controller\Admin;

use App\Entity\Manif;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ManifCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Manif::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            SlugField::new('slug')->setTargetFieldName('name'),          # on reprend le nom du produit pour générer un slug 
            TextField::new('localisation'),
            NumberField::new('latitude'),
            NumberField::new('longitude'),
            ImageField::new('affiche')
                ->setBasePath('assets/img/affiches/')
                ->setUploadDir('public/assets/img/affiches')
                ->setUploadedFileNamePattern('[randomhash].[extension]'),
            AssociationField::new('categorie'),
            AssociationField::new('auteur'),
            DateField::new('date'),
            DateField::new('datefin'),
        ];
    }
}
