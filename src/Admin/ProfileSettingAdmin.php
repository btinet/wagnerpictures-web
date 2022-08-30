<?php

namespace App\Admin;

use App\Entity\SystemForm;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProfileSettingAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('title',TextType::class)
            ->add('description',TextareaType::class)
            ->add('form',ModelType::class,[
                'class' => SystemForm::class,
                'property' => 'title',
                'multiple' => false,
                'required' => true
            ])
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('title')
            ->add('form')
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('title');
        $show->add('form');
        $show->add('description');
    }

}
