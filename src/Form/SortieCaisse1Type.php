<?php

namespace App\Form;

use App\Entity\SortieCaisse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieCaisse1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('montant')
            ->add('raison')
            ->add('createdAt')
            ->add('approvedAt')
            ->add('active')
            ->add('createBy')
            ->add('approvedBy')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SortieCaisse::class,
        ]);
    }
}
