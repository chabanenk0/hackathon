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

//    /**
//     * @ORM\ManyToOne(targetEntity="Hackaton\UserBundle\Entity\Profile", inversedBy="orders", cascade="persist")
//     * @ORM\JoinColumn(name="profile_id", referencedColumnName="id")
//     */
//    private $profile;

    /**
     * @ORM\ManyToOne(targetEntity="Hackaton\DinningRoomBundle\Entity\DinningRoom", inversedBy="orders", cascade={"persist"})
     * @ORM\JoinColumn(name="dinning_room_id", referencedColumnName="id")
     */
    private $dinningRoom;


    /**
     * @ORM\OneToMany(targetEntity="Hackaton\UserBundle\Entity\OrderItem", mappedBy="order", cascade={"persist"})
     */
    private $items;

    public function __construct()
    {
        $this->foods = new ArrayCollection();
        $this->items = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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

    /**
     * @return mixed
     */
    public function getDinningRoom()
    {
        return $this->dinningRoom;
    }

    /**
     * @param mixed $dinningRoom
     */
    public function setDinningRoom($dinningRoom)
    {
        $this->dinningRoom = $dinningRoom;
    }

    /**
     * @param OrderItem $food
     * @return $this
     */
    public function addOrderItem(OrderItem $orderItem)
    {
        $this->items->add($orderItem);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param mixed $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }



}
