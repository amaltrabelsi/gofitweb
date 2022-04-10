<?php

namespace App\Form;

use App\Entity\Utilisateur;
use phpDocumentor\Reflection\Types\False_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class AjouterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('Prenom')
            ->add('Email')
            ->add('Mdp',PasswordType::class)
            ->add('Datedenaissance', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'input' => 'string',
            ])

            ->add('Adresse')
            ->add('Region' ,ChoiceType::class,
                array('choices'=> array(
                    'Ariana'=>'',
                    'Béja'	=>' Béja',
                   'Ben Arous'	=>'Ben Arous',
                    'Bizerte'	=>' Bizerte',
                    'Gabès'	=>'Gabès',
                    'Gafsa'	=>' Gafsa',
                    'Jendouba'=>'Jendouba',
                    'Kairouan'	=>'Kairouan',
                    'Kasserine'	=>' Kasserine',
                    'Kébili'	=>'Kébili',
                    'Le Kef'	=>' Le Kef',
                    'Mahdia'	=>'Mahdia',
                    'La Manouba'	=>'La Manouba',
                    'Médenine'	=>'Médenine',
                    'Monastir'	=>'Monastir',
                    'Nabeul'	=>'Nabeul',
                    'Sfax'	=>' Sfax',
                    'Sidi Bouzid'	=>'Sidi Bouzid',
                    'Siliana'	=>'Siliana',
                    'Sousse'	=>'Sousse',
                    'Tataouine'=>'Tataouine',
                    'Tozeur'	=>'Tozeur',
                    'Tunis'	=>'Tunis',
                    'Zaghouan'    =>'Zaghouan ',


                ) ))
            ->add('Numero')
            ->add('Role',ChoiceType::class,
                array('choices'=> array( 'Client'=>'Client',
                    'Admin'=>'Admin',
                    'Vendeur'=>'Vendeur' ,
                    'Coach'=>'Coach')
            ))
            ->add('Sexe',ChoiceType::class,array(
                'choices'=>array(
                    'Femme'=> 'Femme' ,
                 'Homme'=>'Homme' ,
                ),
               'multiple'=>False,
                'expanded'=>true
            ))

            ->add('question',ChoiceType::class,
                array('choices'=> array( 'Quel est votre signe astrologique ?'=>'Quel est votre signe astrologique ?',
                    'Quel est votre film préféré ?'=>'Quel est votre film préféré ?',
                    'Quelle était votre première voiture ?'=>'Quelle était votre première voiture ?' ,
                    'Dans quelle ville êtes-vous né(e) ?'=>'Dans quelle ville êtes-vous né(e) ? ?'),
                ))
            ->add('reponse')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
