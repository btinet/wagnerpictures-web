<?php
// src/Admin/CategoryAdmin.php

namespace App\Admin;

use App\Entity\Menu;
use App\Entity\MenuEntry;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class MenuEntryAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('type', ModelType::class, [
                'class' => Menu::class,
                'property' => 'title',
                'required' => false
            ])
            ->add('parent', ModelType::class, [
                'class' => MenuEntry::class,
                'property' => 'title',
            ])
            ->add('title', TextType::class)
            ->add('route', TextType::class)
            ->add('icon', TextType::class,[
                'required' => false
            ]);
    }


    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('title')
            ->add('parent', ModelType::class, [
                'class' => MenuEntry::class,
                'property' => 'title',
            ])
            ->add('route', TextType::class)
            ->add('type', EntityType::class, [
                'class' => Menu::class,
                'choice_label' => 'name',
            ])
            ->add('icon', TextType::class);
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('title');
    }
}
