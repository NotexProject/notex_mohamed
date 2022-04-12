<?php

namespace App\Form;

use App\Entity\Abonnement;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbonnementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomabonnement' , TextType::class , [
                'label' => 'Nom de l"abonnement ' ,
                'attr' => [
                    'placeholder'=> 'Nom dde l abonnement ' ,
                    'class' => 'nomabonnement'
                ]
            ])
            ->add('description', TextType::class , [
                'label' => 'Description ' ,
                'attr' => [
                    'placeholder'=> 'Saisir la description ' ,
                    'class' => 'description'
                ]
            ])
            ->add('price', TextType::class ,  [
                'label' => 'Price ' ,
                'attr' => [
                    'placeholder'=> 'Saisir le  Prix' ,
                    'class' => 'price'
                ]
            ])
            ->add('image' , FileType::class, array('data_class' => null , 'label'=>"image")
    ) ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Abonnement::class,
        ]);
    }
}
