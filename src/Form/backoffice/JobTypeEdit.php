<?php

namespace App\Form\backoffice;

use App\Entity\Job;
use App\Entity\City;
use App\Entity\Statut;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class JobTypeEdit extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('Title')
            ->add('Description')
            ->add('city', EntityType::class, [
                'class' => City::class,
                'choice_label' => 'name'])
                ->add('statut', EntityType::class, [
                    'class' => Statut::class,
                    'choice_label' => 'nameStatut'])
            ->add('submit', SubmitType::class, array('label' => 'Enregistrer'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}