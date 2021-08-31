<?php

namespace App\Form;

use App\Entity\Incident;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class IncidentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('description', TextareaType::class, ['required' => true, 'label' => 'Ticket', 'attr' => ['placeholder' => 'Veuillez saisir votre message']])
            ->add('submit', SubmitType::class, ['label' => 'Envoyer']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Incident::class,
        ]);
    }
}
