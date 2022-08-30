<?php

namespace App\Form;

use App\Entity\Application;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApplicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $attr =[
            'attr' => [
                'class' => 'bg-lighter border-0  form-control-sm',
                'style' => 'background-color: var(--bs-gray-100)'
            ],
            'row_attr' => [
                'class' => 'border-bottom mb-3'
            ],
            'label_attr' => [
                'class' => 'small fw-bolder'
            ],
        ];

        $builder
            ->add('experience',TextareaType::class,$attr)
            ->add('model',ModelType::class,[
                'label' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Application::class,
        ]);
    }
}
