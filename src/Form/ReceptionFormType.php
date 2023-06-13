<?php

namespace App\Form;

use App\Entity\Conge;
use App\Entity\Reception;

class ReceptionFormType extends AbstractType
{

    public function buildForm (FormBuilderInterface $builder , array $options): void
    {
        {
            $builder
                ->add('question')
                ->add('reponce')
                ->add('statut')
                ->add('datequestion')
                ->add('datereponce') ;
        }
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reception::class,
        ]);
    }


}