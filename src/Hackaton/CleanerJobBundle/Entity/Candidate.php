<?php

namespace Hackaton\CleanerJobBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Job
 *
 * @ORM\Entity
 * @ORM\Table(name="candidates")
 */
class Candidate
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Hackaton\UserBundle\Entity\User", cascade="all")
     */
    protected $candidate;

    /**
     * @ORM\OneToOne(targetEntity="Hackaton\CleanerJobBundle\Entity\Job", cascade="all")
     */
    protected $job;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    protected $message;


}