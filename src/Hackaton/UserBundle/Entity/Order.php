<?php

namespace Hackaton\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Hackaton\DinningRoomBundle\Entity\Food;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="orders")
 * @ORM\Entity
 */
class Order
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Profile", inversedBy="orders", cascade={"persist"})
     * @ORM\JoinColumn(name="profile_id", referencedColumnName="id")
     */
    private $profile;

    /**
     * @ORM\ManyToOne(targetEntity="Hackaton\DinningRoomBundle\Entity\Food", inversedBy="orders", cascade={"persist"})
     */
    private $foods;

    public function __construct()
    {
        $this->foods = new ArrayCollection();
    }

    /**
     * @param Profile $profile
     * @return $this
     */
    public function setProfile(Profile $profile)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * @return Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @return ArrayCollection
     */
    public function getFoods()
    {
        return $this->foods;
    }

    /**
     * @param Food $food
     * @return $this
     */
    public function addFood(Food $food)
    {
        $this->foods->add($food);

        return $this;
    }
}
