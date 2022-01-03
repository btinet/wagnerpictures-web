<?php

namespace App\Admin;

use App\Entity\SampleComment;
use App\Entity\SampleImage;
use App\Entity\User;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SampleCommentAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('user',ModelType::class,[
                'class' => User::class
            ])
            ->add('sampleImage',ModelType::class,[
                'class' => SampleImage::class
            ])
            ->add('parent',ModelType::class,[
                'class' => SampleComment::class,
                'required' => false,
            ])
            ->add('content',TextareaType::class)
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('sampleImage',ModelType::class,[
                'class' => SampleImage::class
            ])
            ->add('user',ModelType::class,[
                'class' => User::class
            ])
            ->add('parent',ModelType::class,[
                'class' => SampleComment::class
            ])
            ->add('content',TextType::class)
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('sampleImage',ModelType::class,[
                'class' => SampleImage::class
            ])
            ->add('user',ModelType::class,[
                'class' => User::class
            ])
            ->add('parent',ModelType::class,[
                'class' => SampleComment::class
            ])
            ->add('content',TextType::class)
        ;
    }

}
