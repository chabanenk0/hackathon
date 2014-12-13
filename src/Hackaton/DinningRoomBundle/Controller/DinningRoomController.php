<?php

namespace Hackaton\DinningRoomBundle\Controller;

use Hackaton\DinningRoomBundle\Entity\DinningRoom;
use Hackaton\DinningRoomBundle\Form\Type\DinningRoomType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DinningRoomController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $dinners = $this->getDoctrine()->getRepository('HackatonDinningRoomBundle:DinningRoom')->findAll();
        $locations = array();
        foreach ($dinners as $key => $value) {
            $locations[] = array($value->address, $value->latitude, $value->longitude);
        }

        return $this->render('HackatonDinningRoomBundle:DinningRoom:index.html.twig', array('locs' => $locations, 'dinners' => $dinners));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $dr = new DinningRoom();
        $form = $this->createForm(new DinningRoomType(), $dr);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dr);
            $em->flush();
        }

        return $this->render('HackatonDinningRoomBundle:DinningRoom:create.html.twig', array('form' => $form->createView()));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, $id)
    {
        $dr = $this->getDoctrine()->getRepository('HackatonDinningRoomBundle:DinningRoom')->find($id);
        $form = $this->createForm(new DinningRoomType(), $dr);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dr);
            $em->flush();
        }

        return $this->render('HackatonDinningRoomBundle:DinningRoom:create.html.twig', array('form' => $form->createView()));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        $dinner = $this->getDoctrine()->getRepository('HackatonDinningRoomBundle:DinningRoom')->find($id);

        return $this->render('HackatonDinningRoomBundle:DinningRoom:show.html.twig', array('dinner' =>$dinner));
    }
}
