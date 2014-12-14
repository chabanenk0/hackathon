<?php

namespace Hackaton\UserBundle\Controller;

use Hackaton\UserBundle\Entity\Order;
use Hackaton\UserBundle\Entity\OrderItem;
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
        $jsonData = json_decode($request->getContent(), true);
        $foodId = $jsonData['food'];
        $dinningRoomId = $jsonData['dinningRoom'];
        $food = $this->getDoctrine()->getRepository('HackatonDinningRoomBundle:Food')->find($foodId);
        $dinningRoom = $this->getDoctrine()->getRepository('HackatonDinningRoomBundle:DinningRoom')->find($dinningRoomId);
        $session = $this->get('session');
        $em = $this->getDoctrine()->getEntityManager();
        if (($order = $session->get('order')) == null) {
            $order = new Order();
            //$order->setProfile($this->get('security.context')->getToken()->getUser()->getProfile());
            $order->setDinningRoom($dinningRoom);
            $session->set('order', $order);
            $em->persist($session->get('order'));
        }
        $orderItem = new OrderItem();
        $orderItem->setOrder($order);
        $orderItem->setFood($food);
        $session->get('order')->addOrderItem($orderItem);
        //$em->persist($session->get('order'));
        //$em->persist($orderItem);
        $em->flush();

        return new Response(count($session->get('order')->getProfile()));
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository('Hackaton\UserBundle\Entity\Order')->findBy(array());

        return $this->render('HackatonUserBundle:Profile:list.html.twig', array('orders' => $orders));
    }
}
