<?php

namespace App\Form;

use App\Entity\AffectationCours;
use App\Entity\Classe;
use App\Entity\Cours;
use App\Entity\Professeur;
use App\Entity\AnneeScolaire;
use App\Form\ClasseType;
use App\Form\CoursType;
use App\Form\ProfesseurType;
use App\Form\AnneeScolaireType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\FormTypeInterface;

use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class AffectationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('created_at',BirthdayType::class,['widget'=>'single_text','required'=>false])
            ->add('charge_horaire')
            ->add('cours',EntityType::class,array('class'=>Cours::class,'choice_label'=>'designation'))
            ->add('professeur',EntityType::class,array('class'=>Professeur::class,'choice_label'=>'nom_complet'))
            ->add('classe',EntityType::class,array('class'=>Classe::class,'choice_label'=>'designation'))
            ->add('annee_scolaire',EntityType::class,array('class'=>AnneeScolaire::class,'choice_label'=>'designation'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AffectationCours::class,
        ]);
    }
}
