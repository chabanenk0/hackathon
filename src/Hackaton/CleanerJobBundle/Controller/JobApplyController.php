<?php

namespace Hackaton\CleanerJobBundle\Controller;

use Hackaton\CleanerJobBundle\Entity\Candidate;
use Hackaton\CleanerJobBundle\Entity\Job;
use Hackaton\CleanerJobBundle\Form\Type\CandidateType;
use Hackaton\CleanerJobBundle\Form\Type\JobApproveType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class JobApplyController extends Controller
{
    public function newAction(Request $request, $jobId)
    {
        $em = $this->getDoctrine()->getManager();
        $job = $em->find('Hackaton\CleanerJobBundle\Entity\Job', $jobId);

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')) {
                throw new AccessDeniedException();
        }
        $user = $this->get('security.context')->getToken()->getUser();

        $candidate = new Candidate();
        $candidate->setJob($job);
        $candidate->setCandidate($user);

        $form = $this->createForm(new CandidateType(), $candidate);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($candidate);
            $em->flush();

            return $this->redirect($this->generateUrl('hackaton_cleaner_job_homepage'));
        }

        return $this->render('HackatonCleanerJobBundle:JobApply:new.html.twig', array(
            'form' => $form->createView(),
            'job' => $job,
        ));
    }

    public function viewAction($jobId)
    {
        $em = $this->getDoctrine()->getManager();
        $job = $em->find('Hackaton\CleanerJobBundle\Entity\Job', $jobId);
        $candidates = $job->getCandidates();
        if ($job) {
            return $this->render(
                'HackatonCleanerJobBundle:JobApply:view.html.twig',
                array(
                    'candidates' => $candidates,
                    'edit_rights' => $this->isGrantedToApprove($job),
                    'jobId' => $jobId,
                )
            );
        } else {
            throw new AccessDeniedException();
      }

    }

    public function approveAction(Request $request, $jobId)
    {
        $em = $this->getDoctrine()->getManager();
        $job = $em->find('Hackaton\CleanerJobBundle\Entity\Job', $jobId);
        if (!$this->isGrantedToApprove($job)) {
            throw new AccessDeniedException();
        }

        $form = $this->createForm(new JobApproveType(), $job, array('label' => 'Save best candidate'));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirect($this->generateUrl('hackaton_cleaner_job_homepage'));
        }

        return $this->render('HackatonCleanerJobBundle:JobApply:choose.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    private function isGrantedToApprove($job)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $creator = $job->getCreator();

        if (!$this->get('security.authorization_checker')->isGranted('ROLE_USER')
            || !$user
            || !$creator
            || $user->getId() != $creator->getId()
        ) {
            return false;
        }

        return true;
    }

}
