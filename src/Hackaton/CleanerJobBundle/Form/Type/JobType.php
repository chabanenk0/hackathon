<?php
namespace Hackaton\CleanerJobBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class JobType  extends AbstractType{

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (!array_key_exists('label', $options)) {
            $options['label'] = 'Save';
        }
        $builder->add('name', 'text', ['label' => 'Назва вакансії'])
            ->add('description', 'text', ['label' => 'Опис вакансії', 'required' => false])
            ->add('save', 'submit', ['label' => $options['label']]);
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Hackaton\CleanerJobBundle\Entity\Job',
            'cascade_validation' => true,
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'job';
    }

}