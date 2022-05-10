<?php

namespace App\Form;

use App\Entity\Participation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom_part',TextType::class)
            ->add('nom_part',TextType::class)
            ->add('type_part',ChoiceType::class, [
                'choices'  => [
                    'Veuillez choisir votre type' => null,
                    'createur de contenue' => 'createur de contenue',
                    'brand ' => 'brand',
                    'guest' => 'guest',


                ],

            ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participation::class,
        ]);
    }
}
