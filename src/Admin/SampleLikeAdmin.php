<?php
namespace App\Admin;

use App\Entity\SampleImage;
use App\Entity\User;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;

class SampleLikeAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('samples', ModelType::class, [
                'class' => SampleImage::class
            ])
            ->add('user', ModelType::class, [
                'class' => User::class
            ]);
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->add('id');;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id');
    }

}
