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
    public function updateAction(Request $request)
    {
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
        $profile = new Profile();
        $form = $this->createForm(new ProfileType(), $profile);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $profile->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($profile);
            $em->flush();
        }

        return $this->render('HackatonUserBundle:Profile:update.html.twig', ['form' => $form->createView()]);
    }
}
