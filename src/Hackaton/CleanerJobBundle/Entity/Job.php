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
     * @ORM\ManyToOne(targetEntity="Hackaton\UserBundle\Entity\User", cascade="all")
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

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param mixed $creator
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;
    }

    /**
     * @return mixed
     */
    public function getCandidates()
    {
        return $this->candidates;
    }

    /**
     * @param mixed $candidates
     */
    public function setCandidates($candidates)
    {
        $this->candidates = $candidates;
    }

    /**
     * @return mixed
     */
    public function getChosenBestCandidate()
    {
        return $this->chosenBestCandidate;
    }

    /**
     * @param mixed $chosenBestCandidate
     */
    public function setChosenBestCandidate($chosenBestCandidate)
    {
        $this->chosenBestCandidate = $chosenBestCandidate;
    }

}