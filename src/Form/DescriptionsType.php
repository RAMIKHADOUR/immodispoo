<?php

namespace App\Form;

use App\Entity\Descriptions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DescriptionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('surface')
            ->add('prix')
            ->add('chambres')
            ->add('salle_bain')
            ->add('etages')
            ->add('nomber_etages')
            ->add('internet')
            ->add('garage')
            ->add('piscine')
            ->add('camera')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Descriptions::class,
        ]);
    }
}
