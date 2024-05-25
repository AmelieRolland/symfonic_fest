<?php

namespace App\Form;

use App\Entity\BandRegister;
use App\Entity\Country;
use App\Entity\MusicGenre;
use App\Entity\ProgDay;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Image;

class BandRegister1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('band_name' )
        ->add('creation_year')
        ->add('img_file_name', FileType::class, [
            'label' => 'Photo principale',
            'mapped' => false,
            'required' => false,
            'constraints' => [
                new Image()
            ]
        ])
        ->add('bandImage', FileType::class, [
            'label' => 'Autres photos',
            'mapped' => false,
            'required' => false,
            'multiple' => true,
            'constraints' => [
                new All(
                    [new Image()]
                )
            ]
        ])
        
        ->add('description')
        ->add('musicGenreId', EntityType::class, [
            'class' => MusicGenre::class,
            'label' => 'Genre musical',
            'choice_label' => 'genre_name',
        ])
        ->add('country', EntityType::class, [
            'class' => Country::class,
            'choice_label' => 'name',
            'label' => 'Pays'

        ])
        ->add('Inscription', SubmitType::class)


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BandRegister::class,
        ]);
    }
}
