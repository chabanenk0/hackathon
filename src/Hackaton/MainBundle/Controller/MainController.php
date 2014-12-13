<?php

namespace Hackaton\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('HackatonMainBundle:Main:index.html.twig');
    }
}
