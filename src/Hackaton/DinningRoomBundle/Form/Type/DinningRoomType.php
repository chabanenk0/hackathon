<?php

namespace Hackaton\DinningRoomBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DinningRoomType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', null, ['label' => 'Название'])
        ->add('description', null, ['label' => 'Описание'])
        ->add('file', 'file', ['label' => 'Фото'])
        ->add('latitude', null, ['label' => 'Широта', 'attr' => ['hidden' => 'hidden']])
        ->add('longitude', null, ['label' => 'Долгота', 'attr' => ['hidden' => 'hidden']])
        ->add('address', null, ['label' => 'Адресс', /*'attr' => ['hidden' => 'hidden']*/])
        ->add('url', null, ['label' => 'Ссылка']);
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Hackaton\DinningRoomBundle\Entity\DinningRoom',
            'cascade_validation' => true,
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'dinning_room';
    }
}
