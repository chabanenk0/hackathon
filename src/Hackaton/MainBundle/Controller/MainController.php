<?php

namespace Hackaton\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $jobs = $this->getDoctrine()->getRepository('HackatonCleanerJobBundle:Job')->findAll();

        return $this->render('HackatonMainBundle:Main:index.html.twig', array('jobs' => $jobs));
    }
}
