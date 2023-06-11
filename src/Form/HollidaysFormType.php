<?php

namespace App\Form;



use App\Entity\Hollidays;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HollidaysFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        {
            $builder
                ->add('discription')
                ->add('day');
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hollidays::class,
        ]);
    }


}