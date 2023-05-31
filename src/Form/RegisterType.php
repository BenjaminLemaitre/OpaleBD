<?php

namespace App\Form;

use App\Entity\User;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotCompromisedPassword;
use Symfony\Component\Validator\Constraints\Regex;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('lastname', TextType::class, [
            'label' => 'Nom',
            'constraints' => new Length([
                'min' => 2,
                'max' => 30
            ]),
            'attr' =>[
                'placeholder' => 'Merci de saisir votre nom'
            ]
        ])
        ->add('firstname', TextType::class, [
            'label' => 'Prénom',
            'constraints' => new Length([
                'min' => 2,
                'max' => 30
            ]),
            'attr' =>[
                'placeholder' => 'Merci de saisir votre prénom'
            ]
        ])
        ->add('gender', ChoiceType::class, [
            'label' => false,
            'choices' => [
                'Homme' => '0',
                'Femme' => '1',
            ],
            'data' => 0,
            'expanded' => true,
            ])
        ->add('pseudo', TextType::class, [
            'constraints' => new Length([
                'min' => 2,
                'max' => 30
            ]),
            'attr' =>[
                'placeholder' => 'Merci de saisir votre pseudo'
            ]
        ])
        ->add('email', EmailType::class, [
            'constraints' => new Length([
                'min' => 5,
                'max' => 70
            ]),
            'attr' =>[
                'placeholder' => 'Merci de saisir votre Email'
            ]
        ])
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Le mot de passe et la confirmation doivent être identique',
            'required' => true,
            'constraints' => [new Regex([
                'match' => true,
                'pattern' => '#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$#',
                'message' => 'Doit contenir au moins 8 caractères, une majuscule, et un chiffre'
            ])],

            'first_options' => [
                'label' => 'Mot de passe',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre mot de passe'
                ]],
            'second_options' => [
                'label' => 'Confirmer votre mot de passe',
                'attr' => [
                    'placeholder' => 'Merci de confirmer votre mot de passe'
                ]],
        ])
        ->add('submit', SubmitType::class, [
            'label' => "S'inscrire"
        ])
        ->add('captcha', Recaptcha3Type::class, [
            'constraints' => new Recaptcha3(),
            'action_name' => 'inscription',
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
