<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Listener\Success;

use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User;

use Symfony\Component\Security\Core\Event\AuthenticationEvent;

class LoadUserOnSessionListener
{
    /**
     * set user in globals and session
     * @param AuthenticationEvent $event
     */
    public function execute(AuthenticationEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        $this->setGlobalUser($user);
        $this->setSessionUserId($user);
    }

    /**
     * set current user into global variables
     * @param User $user
     */
    protected function setGlobalUser(User $user)
    {
        global $current_user;
        $current_user = $user->getDotbUser();
    }

    /**
     * set user id into $_SESSION
     * @param User $user
     */
    protected function setSessionUserId(User $user)
    {
        $_SESSION['authenticated_user_id'] = $user->getDotbUser()->id;
    }
}
