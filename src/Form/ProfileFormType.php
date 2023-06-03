<?php
namespace App\Form;
use App\Entity\UserProfile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class ProfileFormType extends  AbstractType
{
    public function buildForm (FormBuilderInterface $builder , array $options): void
    {
        {
            $builder
                ->add('adresse')
                ->add('contracttype')
                ->add('status')
                ->add('dateofbirth')
                ->add('countrycode')
                ->add('medicalfilenumber')
                ->add('joindate')
                ->add('currentrank')
                ->add('telephone')
                ->add('sex')
                ->add('upperhierarchy') ;

        }
    }
        public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserProfile::class,
        ]);
    }
}