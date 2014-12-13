<?php
namespace Hackaton\CleanerJobBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class JobApproveType  extends AbstractType{

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (!array_key_exists('label', $options)) {
            $options['label'] = 'Save';
        }
        $builder->add('chosenBestCandidate', 'text', ['label' => 'Виберіть кандидата'])
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
        return 'job_approve';
    }

}