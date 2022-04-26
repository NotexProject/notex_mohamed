<?php

namespace App\Form;

use App\Entity\Compt;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints\ValidCaptcha;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
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
            ->add('email', TextType::class)
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('username', TextType::class , [
                'label' => 'username ' ,
                'attr' => [
                    'placeholder'=> 'username' ,
                    'class' => 'username'
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
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
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Brand' => 'ROLE_BRAND',
                    'Administrateur' => 'ROLE_ADMIN',
                    'Content Creator' => 'ROLE_CONTENT'

                ],
                'expanded' => true,
                'multiple' => true,
                'label' => 'Rôles'
            ])
            ->add('captchaCode', CaptchaType::class, array(
                'captchaConfig' => 'ExampleCaptchaUserRegistration',
                'constraints' => [
                    new ValidCaptcha([
                        'message' => 'Invalid captcha, please try again',
                    ]),
                ],
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Compt::class,
        ]);
    }
}
