<?php
namespace Hackaton\CleanerJobBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class CandidateType  extends AbstractType{

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (!array_key_exists('label', $options)) {
            $options['label'] = 'Save';
        }
        $builder->add('message', 'text', ['label' => 'Про себе'])
            ->add('save', 'submit', ['label' => $options['label']]);
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Hackaton\CleanerJobBundle\Entity\Candidate',
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