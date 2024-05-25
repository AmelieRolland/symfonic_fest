<?php

namespace App\Form;

use App\Entity\BandRegister;
use App\Entity\Days;
use App\Entity\ProgDay;
use App\Entity\Scene;
use App\Repository\BandRegisterRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProgFormType extends AbstractType


    {
        private $bandRegisterRepository;
    
        public function __construct(BandRegisterRepository $bandRegisterRepository)
        {
            $this->bandRegisterRepository = $bandRegisterRepository;
        }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('hour', null, [
                'widget' => 'single_text',
            ])
            ->add('days', EntityType::class, [
                'class' => Days::class,
                'choice_label' => 'day',
            ])
            ->add('scene', EntityType::class, [
                'class' => Scene::class,
                'choice_label' => 'scene_name',
            ])
            -> add('bandRegister', EntityType::class, [
                'class' => BandRegister::class,
                'choice_label' => 'band_name',
            ])
            ->add('Inscription', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProgDay::class,
        ]);
    }
}
