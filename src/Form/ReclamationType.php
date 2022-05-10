<?php

namespace App\Form;

use App\Entity\Compt;
use App\Entity\Offre;
use App\Entity\Reclamation;
use App\Entity\User;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typereclamation')
            ->add('datereclamation',DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'data' => new \DateTime("today")
            ))
            ->add('descriptionrecla',TextareaType::class)
            ->add('comuniquer',TextareaType::class)
            ->add('etat',ChoiceType::class, [
                'choices'  => [
                    'Rien' => 'Rien',
                    'En cours' => 'En cours',
                    'Traiter' => 'Traiter',
                    'Non Traiter' => 'Non Traiter',
                ],
            ])
            ->add('cinreclameur',EntityType::class, [
                'class' => Compt::class,
                'choice_label' => 'idcompt',
            ])

            ->add('offreareclamer',EntityType::class, [
                'class' => Offre::class,
                'choice_label' => 'idoffre',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
