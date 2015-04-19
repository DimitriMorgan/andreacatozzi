<?php

namespace AndreaCatozzi\BackOfficeBundle\Form\Media;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PictureType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('path', 'file', array('data_class' => null))
            ->add('alt')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AndreaCatozzi\BackOfficeBundle\Entity\Media\Picture'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'andreacatozzi_backofficebundle_media_picture';
    }
}
