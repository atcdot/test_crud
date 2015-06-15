<?php

namespace Test\CrudBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserAddressType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('zip', 'number', ['label' => 'Индекс'])
            ->add('city', 'text', ['label' => 'Город'])
            ->add('address', 'text', ['label' => 'Улица / дом'])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Test\CrudBundle\Entity\UserAddress'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'test_crudbundle_useraddress';
    }
}
