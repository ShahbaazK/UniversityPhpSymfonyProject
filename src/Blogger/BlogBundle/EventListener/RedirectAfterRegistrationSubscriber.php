<?php
/**
 * Created by PhpStorm.
 * User: stc508
 * Date: 03/01/19
 * Time: 15:28
 */

namespace Blogger\BlogBundle\EventListener;

    use FOS\UserBundle\Event\FormEvent;
    use FOS\UserBundle\FOSUserEvents;
    use Symfony\Component\EventDispatcher\EventSubscriberInterface;
    use Symfony\Component\HttpFoundation\RedirectResponse;
    use Symfony\Component\Routing\RouterInterface;
    use Symfony\Component\Security\Http\Util\TargetPathTrait;

class RedirectAfterRegistrationSubscriber implements EventSubscriberInterface
{
    use TargetPathTrait;

    private $router;

    /**
     * RedirectAfterRegistrationSubscriber constructor.
     * @param RouterInterface $router
     */


    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onRegistrationSuccess(FormEvent $event)
    {
        // main is your firewall's name
        $url = $this->getTargetPath($event->getRequest()->getSession(), 'main');

        if (!$url) {
            $url = $this->router->generate('blogger_home');
        }

        $response = new RedirectResponse($url);
        $event->setResponse($response);
    }

    public static function getSubscribedEvents()
    {
        return [
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess'
        ];
    }
}