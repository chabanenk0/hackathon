<?php

namespace Hackaton\CleanerJobBundle\Controller;

use Hackaton\CleanerJobBundle\Entity\Job;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class JobController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $jobs = $em->getRepository('Hackaton\CleanerJobBundle\Entity\Job')->findBy(array());

        return $this->render('HackatonCleanerJobBundle:Job:index.html.twig', array('jobs' => $jobs));
    }

    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
                throw new AccessDeniedException();
        }
        $user = $this->get('security.context')->getToken()->getUser();

        $job = new Job();

        $form = $this->createFormBuilder($job)
            ->add('name', 'text')
            ->add('description', 'text')
            ->add('save', 'submit', array('label' => 'Create Task'))
            ->getForm();


        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $job->setCreator($user);
            $em->persist($job);
            $em->flush();

            return $this->redirect($this->generateUrl('hackaton_cleaner_job_homepage'));
        }

        return $this->render('HackatonCleanerJobBundle:Job:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $job = $em->find('Hackaton\CleanerJobBundle\Entity\Job', $id);
        if ($job) {
            return $this->render(
                'HackatonCleanerJobBundle:Job:view.html.twig',
                array(
                    'job' => $job,
                    'edit_rights' => $this->isGrantedToEdit($job)
                )
            );
        } else {

        }

    }

    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $job = $em->find('Hackaton\CleanerJobBundle\Entity\Job', $id);
        if (!$this->isGrantedToEdit($job)) {
            throw new AccessDeniedException();
        }

        $form = $this->createFormBuilder($job)
            ->add('name', 'text')
            ->add('description', 'text')
            ->add('save', 'submit', array('label' => 'Save changes'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirect($this->generateUrl('hackaton_cleaner_job_homepage'));
        }

        return $this->render('HackatonCleanerJobBundle:Job:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    private function isGrantedToEdit($job)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $creator = $job->getCreator();

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')
            || !$job
            || !$user
            || !$creator
            || $user->getId() != $job->getCreator()->getId()
        ) {
            return false;
        }

        return true;
    }

}
