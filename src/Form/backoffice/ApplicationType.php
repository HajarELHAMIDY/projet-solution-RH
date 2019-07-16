<?php

namespace App\Form\backoffice;

use App\Entity\Application;
use App\Entity\Statut;
use App\Entity\Job;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ApplicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          
            ->add('statut', EntityType::class, [
                'class' => Statut::class,
                'choice_label' => 'nameStatut'])
                
            ->add('Comment')
            ->add('submit', SubmitType::class, array('label' => 'Confirmer'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Application::class,
        ]);
    }
}