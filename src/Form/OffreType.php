<?php

namespace App\Form;

use App\Entity\Compt;
use App\Entity\Offre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\User;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class OffreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomoffre')
            ->add('datedebut',DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'data' => new \DateTime("yesterday")
            ])
            ->add('datefin',DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'data' => new \DateTime("yesterday")
            ])
            ->add('description',TextareaType::class)
            ->add('imgsrc',FileType::class , ['mapped'=> false])
            ->add('couleur',ColorType::class)
            ->add('typeoffre', ChoiceType::class, [
                'choices' => [
                    'Choisir votre type offre' => [
                        'Faite votre choix' => 'Faite votre choix',

                    ],
                    'Offre Créateur de Contenu' => [
                        'Demande Sponsoring' => 'Demande_Sponsoring',
                        'Demande Partenaire' => 'Demande_Partenaire',
                    ],
                    'Offre Sponsor' => [
                        'Besoin de CC pour Contrat' => 'Besoin_de_CC_pour_Contrat',
                        'Besoin de CC pour Publicite' => 'Besoin_de_CC_pour_Publicite',
                        'Besoin de CC pour Evennement' => 'Besoin_de_CC_pour_Evennement',]
                    ,],])

            ->add('cincreateuroffre',EntityType::class, [
        'class' => Compt::class,
        'choice_label' => 'idcompt',

    ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offre::class,
        ]);
    }
}
