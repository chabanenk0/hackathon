<?php

namespace Hackaton\UserBundle\EventListener;

use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Listener responsible to register user with him profile, car and car_photos data
 */
class RegistrationSuccessListener implements EventSubscriberInterface
{
    private $router;
    private $em;
    private $session;

    public function __construct(UrlGeneratorInterface $router, EntityManager $em, Session $session)
    {
        $this->router = $router;
        $this->em = $em;
        $this->session = $session;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess'
        ];
    }

    /**
     * Redirec user to main page and shows flash if registration is successful
     * @param FormEvent $event
     */
    public function onRegistrationSuccess(FormEvent $event)
    {
        $this->session->getFlashBag()->add('user_registered', 'Спасибо за регистрацию но еще не все, прежде чем начать деятельность на сайте, нужно заполнить информацию профиля!');
        $url = $this->router->generate('_welcome');
        $event->setResponse(new RedirectResponse($url));
    }
}
