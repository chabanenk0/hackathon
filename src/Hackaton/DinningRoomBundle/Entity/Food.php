<?php

namespace Hackaton\DinningRoomBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Food
 *
 * @ORM\Table(name="foods")
 * @ORM\Entity(repositoryClass="Hackaton\DinningBundle\Entity\FoodRepository")
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
     * @ORM\ManyToMany(targetEntity="Hackaton\DinningRoomBundle\Entity\Food", mappedBy="dishes")
     */
    protected $courses;

    /**
     * @ORM\ManyToMany(targetEntity="Hackaton\DinningRoomBundle\Entity\DinningRoom", inversedBy="foods")
     * @ORM\JoinTable(name="dinners_foods")
     */
    protected $dinners;

    protected $foods;

    public function __construct()
    {
        $this->dinners = new ArrayCollection();
    }

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
     * @param DinningRoom $room
     * @return $this
     */
    public function addDinner(DinningRoom $room)
    {
        $this->dinners->add($room);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getDinners()
    {
        return $this->dinners;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function getAbsolutePath()
    {
        return null === $this->image ? null : $this->getUploadDir() . '/' . $this->image;
    }

    public function getWebPath()
    {
        return null === $this->image ? null : $this->getUploadDir() . '/' . $this->image;
    }

    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/foods';
    }

    /**
     * Get file.
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Sets file.
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        if (isset($this->image)) {
            $this->temp = $this->image;
            $this->image = null;
        } else {
            $this->image = 'initial';
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            $filename = sha1(uniqid(mt_rand(), true));
            $this->image = $filename . '.' . $this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }
        $this->getFile()->move($this->getUploadRootDir(), $this->image);
        if (isset($this->temp) && $this->temp != 'default_photo.jpg') {
            unlink($this->getUploadRootDir() . '/' . $this->temp);
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    /**
     * @param $image
     * @return $this
     */
    public function setPath($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->image;
    }

    public function getFoods()
    {
        return $this->foods;
    }
}
