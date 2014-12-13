<?php

namespace Hackaton\DinningRoomBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('HackatonDinningRoomBundle:Job:index.html.twig', array('name' => $name));
    }
}
