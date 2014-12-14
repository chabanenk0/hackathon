<?php

namespace Hackaton\DinningRoomBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FoodExistType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('foods', 'entity', array(
                'label' => 'Существующая еда',
                'class' => 'HackatonDinningRoomBundle:Food',
                'property' => 'name',
                'empty_value' => 'Choose a food',
                'multiple' => true,
                'expanded' => false,
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
            'cascade_validation' => true,
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'food_exist';
    }
}
