<?php
// src/Admin/CategoryAdmin.php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class MenuAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('title', TextType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('title');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('title')
            ->add('slug')
            ->add('menuEntries');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('title');
    }
}
