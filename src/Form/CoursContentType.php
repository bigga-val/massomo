<?php

namespace App\Form;

use App\Entity\CoursContent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Cours;
use App\Entity\Professeur;
use App\Entity\Classe;
use Symfony\Component\Form\Extension\Core\Type\TextareaType; 
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints\File;

class CoursContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('chapitre',TextareaType::class,[
                'attr'=>['class'=>'tinymce'],
                
             ])
            ->add('contenue',TextareaType::class,[
                'attr'=>['class'=>'tinymce']
             ])
            ->add('idCours', EntityType::class,[
                'class'=>Cours::class,
                'choice_label'=>'designation'
            ])
            ->add('prof', EntityType::class,[
                'class'=>Professeur::class,
                'choice_label'=>'nomComplet'
            ])
            ->add('classe', EntityType::class,[
                'class'=>Classe::class,
                'choice_label'=>'designation'
            ])
            ->add('fileCours', FileType::class, [
                'label' => 'Fichier',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024m',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Le fichier doit être au format PDF',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CoursContent::class,
        ]);
    }
}
