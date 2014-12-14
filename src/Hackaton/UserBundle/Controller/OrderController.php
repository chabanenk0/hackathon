<?php

namespace Hackaton\UserBundle\Controller;

use Hackaton\UserBundle\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addFoodAction(Request $request)
    {
        $foodId = json_decode($request->getContent(), true)['food'];
        $food = $this->getDoctrine()->getRepository('HackatonDinningRoomBundle:Food')->find($foodId);
        $session = $this->get('session');
        if ($session->get('order') == null) {
            $order = new Order();
            $order->setProfile($this->get('security.context')->getToken()->getUser()->getProfile());
            $session->set('order', $order);
        }
        $session->get('order')->addFood($food);
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($session->get('order'));
        $em->flush();

        return new Response(count($session->get('order')->getProfile()));
    }
}
