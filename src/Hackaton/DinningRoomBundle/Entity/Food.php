<?php

namespace Hackaton\DinningRoomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Food
 *
 * @ORM\Table(name="foods")
 * @ORM\Entity(repositoryClass="Acme\DemoBundle\Entity\EnterpriseRepository")
 */
class Food
{

    const UNIT_CASE = 1; // poshtuchno

    const UNIT_GRAMMS = 1; // kg

    const UNIT_LITRES = 1; // litry

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
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=50, nullable=true)
     */
    protected $image;

    /**
     * @var double
     *
     * @ORM\Column(name="price", type="float")
     */
    protected $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="unit", type="integer")
     */
    protected $unit;

    /**
     * @ORM\ManyToMany(targetEntity="Hackaton\DinningRoomBundle\Entity\Food", mappedBy="dishes")
     */
    protected $courses;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }


}