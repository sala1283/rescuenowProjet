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

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, ['disabled' => true, 'label' => 'Mon nom utilisateur'])
            ->add('email', EmailType::class, ['disabled' => true, 'label' => 'Mon émail'])
            ->add('firstname', TextType::class, ['disabled' => true, 'label' => 'Mon nom'])
            ->add('lastname',  TextType::class, ['disabled' => true, 'label' => 'Mon prénom'])
            ->add('old_password', PasswordType::class, ['mapped' => false, 'label' => 'Mon mot de passe actuel', 'attr' => ['placeholder' => 'Veuillez saisir votre mot de passe actuel']])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identiques.',
                'label' => 'Mon nouveau mot de passe',
                'required' => true,
                'first_options' => [
                    'label' => 'Nouveau mot de passe',
                    'attr' => ['placeholder' => 'Mon nouveau mot de passe']
                ],
                'second_options' => [
                    'label' => 'Confirmer votre nouveau mot de passe',
                    'attr' => ['placeholder' => 'Veuillez confirmer votre nouveau mot de passe']
                ]
            ])
            ->add('submit', SubmitType::class, ['label' => "Mettre à jour"]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
