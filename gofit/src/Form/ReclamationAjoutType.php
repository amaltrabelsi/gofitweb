<?php

namespace App\Form;

use App\Entity\Reclamation;
use App\Entity\Terrain;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReclamationAjoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Contenu')
            ->add('Fkutilisateur',EntityType::class,[
                'class'=> Utilisateur::class,
                'choice_label'=>'email'
                ])
            ->add('FkterrainRecId',EntityType::class,[
                    'class'=> Terrain::class,
                    'choice_label'=>'terrainId']
                )

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
