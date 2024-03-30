<?php

namespace App\Admin;

use App\Entity\SampleImage;
use App\Entity\Tag;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\BooleanType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class SampleImageAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('imageFile',VichImageType::class,[
                'required'=>false,
            ])
            ->add('parent',ModelType::class,[
                'class' => SampleImage::class,
                'property' => 'title',
                'required' => false
            ])
            ->add('children',ModelType::class,[
                'class' => SampleImage::class,
                'property' => 'title',
                'multiple' => true,
                'required' => false
            ])
            ->add('tags',ModelType::class,[
                'class' => Tag::class
            ])
            ->add('title',TextType::class)
            ->add('description',TextareaType::class,[
                'required'=>false,
                'attr' => ['rows' => 6]
            ])
            ->add('isPublished',BooleanType::class,[
                'required'=>false,
            ])
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('title')
            ->add('image',VichImageType::class,[
                'attributes' => ['class' => 'img-fluid']
            ])
            ->add('description')
            ->add('isPublished',BooleanType::class)
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('title');
        $show->add('description');
    }

    public function prePersist(object $image): void
    {
        $this->manageFileUpload($image);
    }

    public function preUpdate(object $image): void
    {
        $this->manageFileUpload($image);
    }

    private function manageFileUpload(object $image): void
    {
        if ($image->getImageFile()) {

        }
    }
}