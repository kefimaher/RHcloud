<?php

namespace App\Form;


use App\Entity\Conge;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CongeFormType   extends  AbstractType
{

    public function buildForm (FormBuilderInterface $builder , array $options): void
    {
        {
            $builder
                ->add('start_day')
                ->add('end_day')
                ->add('type_conge')
                ->add('discription')
                ->add('cretification') ;
        }
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Conge::class,
        ]);
    }



}