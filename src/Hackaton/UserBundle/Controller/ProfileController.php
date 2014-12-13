<?php

namespace Hackaton\UserBundle\Controller;

use Hackaton\UserBundle\Entity\Profile;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        $profile = $this->getDoctrine()->getRepository('HackatonUserBundle:Profile')->find($id);
        if (!$profile instanceof Profile) {
            throw new NotFoundHttpException('Profile with this identifier not found!');
        }

        return $this->render('HackatonUserBundle:Profile:showProfile.html.twig', array('profile' => $profile));
    }
}
