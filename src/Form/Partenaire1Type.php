<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Depot;
use App\Entity\Partenaire;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * @Route("/api")FormBuilderInterfaceFormBuilderInterface
 */
class Partenaire1Type extends AbstractType
{

/**
 * @Route("/partenaire")
 */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numCompte')
            ->add('nomEntreprise')
            ->add('telephone')
            ->add('email')
            ->add('adresse')
            ->add('statut')
            ->add('ninea')
            ->add('Depot', EntityType::class, [
                'class' => Depot::class,
                'choice_label'=> 'depot_id' 
            ])
            ->add('User', EntityType::class, [
                'class' => User::class, 
                'choice_label'=> 'user_id'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Partenaire::class,
        ]);
    }

}
