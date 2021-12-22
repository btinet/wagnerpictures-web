<?php

namespace App\Admin;

use App\Form\AddressType;
use App\Form\CompanyNameType;
use App\Form\PrivateNameType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserAdmin extends AbstractAdmin
{
    protected UserPasswordHasherInterface $passwordHasher;

    public function __construct(string $code, string $class, string $baseControllerName,UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct($code, $class, $baseControllerName);
        $this->passwordHasher = $passwordHasher;
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $userId = $this->getRequest()->get($this->getIdParameter());

        $form->with('account', ['class' => 'col-md-6']);
        $form->add('email', EmailType::class);
        if(empty($userId))
        {
            $form->add('password', RepeatedType::class,[
                'type' => PasswordType::class,
                'invalid_message' => 'password not equal',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ]);
        }
        $form->add('roles', ChoiceType::class,[
                'choices' => [
                    'admin' => ['ROLE_ADMIN'=>'ROLE_ADMIN'],
                    'user' => ['ROLE_USER'=>'ROLE_USER'],
                ],
                'placeholder' => 'Choose an option',
                'required' => true,
                'multiple' => true
            ])
            ->end()
            ->with('invoice address', ['class' => 'col-md-6'])
            ->add('address', AddressType::class,['label' => false])
            ->end()
            ->with('personal', ['class' => 'col-md-6'])
            ->add('privatName', PrivateNameType::class,['label' => false])
            ->end()
            ->with('company', ['class' => 'col-md-6'])
            ->add('companyName', CompanyNameType::class,['required'=>false,'label' => false])
            ->end()

            ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {

    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->add('id')
            ->addIdentifier('privatName')
            ->add('companyName')
            ->add('email')
            ->add('address.city')
            ->add('address.country')
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('privatName');
        $show->add('companyName',);
        $show->add('address.street');
        $show->add('address.postalCode');
        $show->add('address.city');
        $show->add('address.country');
        $show->add('email');
    }

    public function prePersist($object):void
    {
        $encodedPassword = $this->passwordHasher->hashPassword($object,$object->getPassword());
        $object->setPassword($encodedPassword);
    }

}