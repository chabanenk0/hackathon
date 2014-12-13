<?php

namespace Hackaton\UserBundle\EventListener;

use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Listener for user registration
 */
class RegistrationListener implements EventSubscriberInterface
{
    private $router;
    private $securityContext;

    public function __construct(UrlGeneratorInterface $router, SecurityContext $securityContext)
    {
        $this->router = $router;
        $this->securityContext = $securityContext;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            FOSUserEvents::REGISTRATION_INITIALIZE => 'onRegistrationInitialize',
        ];
    }

    /**
     * Redirect user to welcome page if user if authenticated
     * @param GetResponseUserEvent $event
     */
    public function onRegistrationInitialize(GetResponseUserEvent $event)
    {
        if ($this->securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $url = $this->router->generate('_welcome');
            $event->setResponse(new RedirectResponse($url));
        }
    }
}
