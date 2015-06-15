<?php

namespace Test\CrudBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Test\CrudBundle\Entity\UserAddress;
use Test\CrudBundle\Entity\UserRoles;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', 'text', ['label' => 'Имя'])
            ->add('lastName', 'text', ['label' => 'Фамилия'])
            ->add('age', 'number', ['label' => 'Возраст'])
            ->add('email', 'email', ['label' => 'Email'])
//            ->add('password', 'password', ['label' => 'Пароль'])
            ->add('password', 'repeated', [
                'first_name'  => 'password',
                'second_name' => 'confirm',
                'type'        => 'password',
                'first_options'  => array('label' => 'Пароль'),
                'second_options' => array('label' => 'Пароль еще раз'),
            ])
            ->add('userRoles', 'entity', [
                'label'    => 'Роли',
                'class'    => 'TestCrudBundle:UserRoles',
                'property' => 'roleName',
            ]);

        $builder
            ->add('userAddresses', 'collection', array(
                'label'          => 'Адрес пользователя',
                'type'           => new UserAddressType(),
                'allow_add'      => true,
                'allow_delete'   => true,
                'prototype'      => true,
                'prototype_name' => 'user_address__name__',
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Test\CrudBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'test_crudbundle_user';
    }
}
