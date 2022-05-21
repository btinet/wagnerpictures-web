<?php

namespace App\Form;

use App\Entity\Model;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $attr =[
            'attr' => [
                'class' => 'bg-light border-0  form-control-sm'
            ],
            'row_attr' => [
                'class' => 'border-bottom mb-3'
            ],
            'label_attr' => [
                'class' => 'small fw-bolder'
            ],
        ];

        $builder
            ->add('height',TextType::class,$attr)
            ->add('weight',TextType::class,$attr)
            ->add('shoeSize',TextType::class,$attr)
            ->add('clothingSize',TextType::class,$attr)
            ->add('hairColor',TextType::class,$attr)
            ->add('eyeColor',TextType::class,$attr)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Model::class
        ]);
    }
}
