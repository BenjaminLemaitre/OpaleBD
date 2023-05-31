<?php

namespace App\Controller\Admin;

use App\Entity\Auteurs;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AuteursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Auteurs::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            SlugField::new('slug')->setTargetFieldName('name'),          # on reprend le nom du produit pour générer un slug (bonnet_de_cuir)
            DateField::new('birthday'),
            TextField::new('jobs'),
            ImageField::new('illustration')
                ->setBasePath('assets/img/auteurs/')
                ->setUploadDir('public/assets/img/auteurs'),
            TextareaField::new('description'),
            AssociationField::new('CategoryArtwork')
        ];
    }
}
