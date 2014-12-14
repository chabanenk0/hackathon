<?php

namespace Hackaton\DinningRoomBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Hackaton\UserBundle\Entity\Order;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Food
 *
 * @ORM\Table(name="foods")
 * @ORM\Entity
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
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var $temp
     */
    private $temp;

    /**
     * @var double
     *
     * @ORM\Column(name="price", type="float")
     */
    protected $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="unit", type="integer", nullable=true)
     */
    protected $unit;

    /**
     * @ORM\ManyToMany(targetEntity="Hackaton\DinningRoomBundle\Entity\DinningRoom", inversedBy="foods")
     * @ORM\JoinTable(name="dinners_foods")
     */
    protected $dinners;

    /**
     * @ORM\OneToMany(targetEntity="Hackaton\UserBundle\Entity\OrderItem", mappedBy="food")
     */
    protected $order_items;

    public function __construct()
    {
        $this->dinners = new ArrayCollection();
        $this->order_items = new ArrayCollection();
        $this->courses = new ArrayCollection();
    }

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
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getTemp()
    {
        return $this->temp;
    }

    /**
     * @param mixed $temp
     */
    public function setTemp($temp)
    {
        $this->temp = $temp;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param int $unit
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    /**
     * @return mixed
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * @param mixed $courses
     */
    public function setCourses($courses)
    {
        $this->courses = $courses;
    }

    /**
     * @return mixed
     */
    public function getDinners()
    {
        return $this->dinners;
    }

    /**
     * @param mixed $dinners
     */
    public function setDinners($dinners)
    {
        $this->dinners = $dinners;
    }

    /**
     * @return mixed
     */
    public function getOrderItems()
    {
        return $this->order_items;
    }

    /**
     * @param mixed $order_items
     */
    public function setOrderItems($order_items)
    {
        $this->order_items = $order_items;
    }


}
