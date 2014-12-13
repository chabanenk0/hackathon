<?php

namespace Hackaton\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationFormType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'fos_user_registration';
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'hackaton_user_registration';
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class'         => 'Hackaton\UserBundle\Entity\User',
            'cascade_validation' => true,
        ]);
    }
}
