<?php

namespace App\Form;

use App\Entity\Adherent;
use App\Entity\Categorie;
use App\Entity\Club;
use App\Entity\Competition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdherentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,array('label'=>'Nom de l\'adherent:'))
            ->add('datenaissance',BirthdayType::class, ['format' =>'yyyyMMdd'])
            ->add('adresse',TextType::class)
            ->add('ville',TextType::class)
            ->add('categorie',EntityType::class,array(
                'class'=>Categorie::class,
                'choice_label'=>'libelle'
                ))
            ->add('club',EntityType::class,array(
                'class'=>Club::class,
                'choice_label'=>'nom'
                ))
            ->add('competition',EntityType::class,array(
                'class'=>Competition::class,
                'choice_label'=>'libelle',
                'multiple'=>true,
                'expanded'=>true
                ))
            ->add('save',SubmitType::class,array('label'=>'Enregistrer l\'adherent'))
            ->getForm();
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adherent::class,
        ]);
    }
}
