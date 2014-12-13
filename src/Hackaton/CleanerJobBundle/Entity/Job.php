<?php

namespace Hackaton\CleanerJobBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Job
 * @ORM\Entity
 * @ORM\Table(name="jobs")
 */
class Job
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
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="description", type="string", length=400, nullable=true)
     */
    protected $description;

    /**
     * @ORM\OneToOne(targetEntity="Hackaton\UserBundle\Entity\User", cascade="all")
     */
    protected $creator;

    /**
     * @ORM\OneToOne(targetEntity="Hackaton\CleanerJobBundle\Entity\Candidate", cascade="all")
     */
    protected $candidates;

    /**
     * @ORM\OneToOne(targetEntity="Hackaton\UserBundle\Entity\User", cascade="all")
     */
    protected $chosenBestCandidate;



}