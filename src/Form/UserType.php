<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Partenaire;
use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numCompte')
            ->add('nomComplet')
            ->add('telephone')
            ->add('email')
            ->add('adresse')
            ->add('statut')
            ->add('Partenaire', EntityType::class, [
                'class' => Partenaire::class,
                'choice_label' => 'partenaire_id'
            ])
            ->add('Utilisateur', EntityType::class, [
                'class' => Utilisateur::class,
                'choice_label' => 'utilisateur_id'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
