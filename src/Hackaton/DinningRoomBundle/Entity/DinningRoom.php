<?php

namespace Hackaton\DinningRoomBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Dinning Room
 *
 * @ORM\Entity
 */
class DinningRoom extends Enterprise
{
    /**
     * @ORM\ManyToMany(targetEntity="Hackaton\DinningRoomBundle\Entity\Food", mappedBy="dinners")
     */
    private $foods;

    /**
     * @ORM\OneToMany(targetEntity="Hackaton\UserBundle\Entity\Order", mappedBy="dinningRoom")
     */
    private $orders;


    public function __construct()
    {
        parent::__construct();
        $this->foods = new ArrayCollection();
    }

    /**
     * @param Food $food
     * @return $this
     */
    public function addFood(Food $food){
        $this->foods->add($food);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getFoods()
    {
        return $this->foods;
    }
}
