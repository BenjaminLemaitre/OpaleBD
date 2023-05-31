<?php

namespace App\Form;


use App\Classe\Search_agenda;
use App\Entity\CategoryArtwork;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchAgendaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('string', TextType::class, [
            'label' => false,
            'required' => false,
            'attr' => [
                'placeholder' => 'Votre recherche ...',
                'class' => 'form-control-sm'
            ]
        ])
        ->add('categorie', EntityType::class, [
            'label' => false,
            'class' => CategoryArtwork::class,
            'required' => false,
            'multiple' => true,
            'expanded' => true,
            'attr' => [
                'class'=>'row w-100 d-flex mx-auto'
            ]
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Filtrer',
            'attr' => [
                'class' =>'btn-block btn-info'
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Search_agenda::class,
            'method' => 'GET',
            'crsf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}