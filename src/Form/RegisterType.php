<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, ['required' => true, 'label' => 'Nom utilisateur', 'attr' => ['placeholder' => 'Entrer Votre nom utilisateur']])
            ->add('firstname', TextType::class, ['required' => true, 'label' => 'Nom', 'attr' => ['placeholder' => 'Entrer Votre nom']])
            ->add('lastname', TextType::class, ['required' => true, 'label' => 'Prénom', 'attr' => ['placeholder' => 'Entrer Votre prénom']])
            ->add('email', EmailType::class, ['required' => true, 'label' => 'Email', 'attr' => ['placeholder' => 'Entrer Votre émail']])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identiques.',
                'label' => 'Votre mot de passe',
                'required' => true,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => ['placeholder' => 'Veuillez saisir votre mot de passe']
                ],
                'second_options' => [
                    'label' => 'Confirmer votre mot de passe',
                    'attr' => ['placeholder' => 'Veuillez confirmer votre mot de passe']
                ]
            ])
            ->add('submit', SubmitType::class, ['label' => "S'inscrire"]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
