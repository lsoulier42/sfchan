<?php

namespace App\Form;

use App\Entity\Board;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BoardType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
         $builder
             ->add(
                 "title",
                 TextType::class,
                 [
                     'required' => true,
                     'label' => 'Titre'
                 ]
             )
             ->add(
                 "description",
                 TextareaType::class,
                [
                    'required' => true,
                    'label' => 'Description'
                ]
             )
             ->add('submit', SubmitType::class, [
                 'label' => 'Créer'
             ]);
    }

    /**
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Board::class
            ]
        );
    }
}