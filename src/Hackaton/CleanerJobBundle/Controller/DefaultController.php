<?php

namespace Hackaton\CleanerJobBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('HackatonCleanerJobBundle:Default:index.html.twig', array('name' => $name));
    }
}
