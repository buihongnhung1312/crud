<?php

namespace Practise\FuncBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryTaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('description', 'text')
            ->add('position', 'number', array('pattern' => '[0-9]{1,9}'))
            ->add('save', 'submit');
    }

    // public function setDefaultOptions(OptionsResolverInterface $resolver)
    // {
    //     $resolver->setDefaults(array(
    //         'data_class' => 'Exercise01\DaTaBundle\Entity\Product',
    //     ));
    // }

    public function getName()
    {
        return 'product';
    }
}