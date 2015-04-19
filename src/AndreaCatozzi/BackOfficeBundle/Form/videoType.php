<?php

namespace AndreaCatozzi\BackOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilderInterface;

class videoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('createdAt');
        $builder->add('updatedAt');
        $builder->add('description', 'textarea');
        $builder->add('path');
    }
    public function getName()
    {
        return 'videoForm';
    }
}