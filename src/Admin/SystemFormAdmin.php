<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SystemFormAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('title',TextType::class)
            ->add('formType',TextType::class)
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('title')
            ->add('formType')
            ->add('slug')
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('title');
        $show->add('formType');
        $show->add('slug');
    }

}
