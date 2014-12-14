<?php

namespace Hackaton\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfileType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fio', null, ['label' => 'ФИО'])
            ->add('gender', 'choice', [
                'label' => 'Пол',
                'choices' => ['М' => 'М', 'Ж' => 'Ж'],
                'data' => null,
                'required' => false,
                'empty_value' => 'Choose gender',
            ])
            ->add('file', 'file', ['label' => 'Аватар', 'required' => false]);
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Hackaton\UserBundle\Entity\Profile',
            'cascade_validation' => true,
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'profile';
    }
}
