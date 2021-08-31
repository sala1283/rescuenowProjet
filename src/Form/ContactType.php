<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('firstname', TextType::class, ['required' => true, 'label' => 'Nom', 'attr' => ['placeholder' => 'Entrer Votre nom']])
            ->add('lastname', TextType::class, ['required' => true, 'label' => 'Prénom', 'attr' => ['placeholder' => 'Entrer Votre prénom']])
            ->add('email', EmailType::class, ['required' => true, 'label' => 'Email', 'attr' => ['placeholder' => 'Votre Email']])
            ->add('phone', TelType::class, ['required' => true, 'label' => 'Téléphone', 'attr' => ['placeholder' => 'Entrer Votre numéro de téléphone']])
            ->add('demande', ChoiceType::class, [
                'choices' => [
                    'Information' => 1,
                    'Devis' => 2,

                ],
                'choice_attr' => [
                    'Information' => ['data-color' => 'Red'],
                    'Devis' => ['data-color' => 'Yellow'],

                ],
            ])
            ->add('message', TextareaType::class, ['required' => true, 'label' => 'Message', 'attr' => ['placeholder' => 'Veuillez saisir votre message']])
            ->add('submit', SubmitType::class, ['label' => 'Envoyer']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
