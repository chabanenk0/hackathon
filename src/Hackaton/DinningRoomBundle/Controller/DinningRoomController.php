<?php

namespace Hackaton\DinningRoomBundle\Controller;

use Hackaton\DinningRoomBundle\Entity\DinningRoom;
use Hackaton\DinningRoomBundle\Entity\Food;
use Hackaton\DinningRoomBundle\Form\Type\DinningRoomType;
use Hackaton\DinningRoomBundle\Form\Type\FoodExistType;
use Hackaton\DinningRoomBundle\Form\Type\FoodType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DinningRoomController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $dinners = $this->getDoctrine()->getRepository('HackatonDinningRoomBundle:DinningRoom')->findBy([],['id'=>'DESC']);
        $locations = array();
        foreach ($dinners as $key => $value) {
            $locations[] = array('dsa' . mt_rand(1,15),$value->getLatitude(), $value->getLongitude());
        }
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $dinners,
            $request->query->get('page', 1)/*page number*/,
            10/*limit per page*/
        );


        return $this->render('HackatonDinningRoomBundle:DinningRoom:index.html.twig', array('locs' => $locations, 'pagination' => $pagination));
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
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Request $request,$id)
    {
        $dinner = $this->getDoctrine()->getRepository('HackatonDinningRoomBundle:DinningRoom')->find($id);
        $food = new Food();
        $form = $this->createForm(new FoodType(), $food);
        $existingFoodForm = $this->createForm(new FoodExistType(), null);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($food);
            $food->addDinner($dinner);
            $em->flush();
        }

        return $this->render('HackatonDinningRoomBundle:DinningRoom:show.html.twig',
            array(
                'dinner' =>$dinner,
                'form' => $form->createView(),
                'form2' => $existingFoodForm->createView(),
            ));
    }
}
