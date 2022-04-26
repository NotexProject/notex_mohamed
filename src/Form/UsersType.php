<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullname', TextType::class , [
                'label' => 'fullname ' ,
                'attr' => [
                    'placeholder'=> 'Nom Complet' ,
                    'class' => 'fullname'
                ]
            ])
            ->add('email', EmailType::class)
            ->add('username', TextType::class , [
                'label' => 'username ' ,
                'attr' => [
                    'placeholder'=> 'username' ,
                    'class' => 'username'
                ]
            ])
            ->add('password', PasswordType::class , [
                'label' => 'Password ' ,
                'attr' => [
                    'placeholder'=> 'ur Password' ,
                    'class' => 'password'
                ]
            ])
            ->add('birth', DateType::class, array(
                'required' => false,
                'widget' => 'single_text',

                'empty_data' => null,
                'attr' => array(
                    'placeholder' => 'Date Match mm/dd/yyyy'
                )))
            ->add('country', TextType::class , [
                'label' => 'Country ' ,
                'attr' => [
                    'placeholder'=> 'Country' ,
                    'class' => 'Country'
                ]
            ])
            ->add('adress', TextType::class , [
                'label' => ' Adresse ' ,
                'attr' => [
                    'placeholder'=> 'Votre Adresse ' ,
                    'class' => 'adress '
                ]
            ])
            ->add('role',ChoiceType::class, [
                'choices'  => [
                    'Veuillez choisir votre choix' => null,
                    'content creator' => 'content creator',
                    'Brand ' => 'Brand',
                    'Visitor' => 'Visitor',


                ],

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
