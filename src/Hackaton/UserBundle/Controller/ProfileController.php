<?php

namespace Hackaton\UserBundle\Controller;

use Hackaton\UserBundle\Entity\Profile;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Hackaton\UserBundle\Form\Type\ProfileType;

class ProfileController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function manageAction(Request $request)
    {
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
        $profile = $user->getProfile() ? $user->getProfile() : new Profile();
        $form = $this->createForm(new ProfileType(), $profile);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $profile->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($profile);
            $em->flush();

            return $this->redirect($this->generateUrl('user_show_profile', array('id' => $profile->getId())));
        }

        return $this->render('HackatonUserBundle:Profile:update.html.twig', array('form' => $form->createView()));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function showAction($id)
    {
        $profile = $this->getDoctrine()->getRepository('HackatonUserBundle:User')->find($id)->getProfile();
        if (null == $profile) {
            $this->get('session')->getFlashBag()->add('fill_profile', 'Спочатку заповніть дані профілю!');

            return $this->redirect($this->generateUrl('user_manage_profile'));
        }

        return $this->render('HackatonUserBundle:Profile:showProfile.html.twig', array('profile' => $profile));
    }
}
