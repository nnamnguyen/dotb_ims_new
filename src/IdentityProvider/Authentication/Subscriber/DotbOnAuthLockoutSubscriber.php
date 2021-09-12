<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Subscriber;

use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Lockout;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User;
use Dotbcrm\Dotbcrm\Logger\Factory as LoggerFactory;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Core\User\UserProviderInterface;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

/**
 * example subscriber
 */
class DotbOnAuthLockoutSubscriber implements EventSubscriberInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * @var Lockout
     */
    protected $lockout;

    /**
     * @var UserProviderInterface
     */
    protected $userProvider;

    /**
     * @param Lockout $lockout
     * @param UserProviderInterface $userProvider
     */
    public function __construct(Lockout $lockout, UserProviderInterface $userProvider)
    {
        $this->lockout = $lockout;
        $this->userProvider = $userProvider;
        $this->setLogger(LoggerFactory::getLogger('authentication'));
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            AuthenticationEvents::AUTHENTICATION_SUCCESS => 'onSuccess',
            AuthenticationEvents::AUTHENTICATION_FAILURE => 'onFailure',
        ];
    }

    /**
     * runs on success
     * @param AuthenticationEvent $event
     */
    public function onSuccess(AuthenticationEvent $event)
    {
        if (!$this->lockout->isEnabled()) {
            return;
        }

        /** @var User $user */
        $user = $event->getAuthenticationToken()->getUser();
        if ($user->getLoginFailed() || $user->getLockout()) {
            $user->clearLockout();
        }

        return;
    }

    /**
     * runs on failure
     * @param AuthenticationEvent $event
     */
    public function onFailure(AuthenticationEvent $event)
    {
        $username = $event->getAuthenticationToken()->getUsername();
        /** @var User $user */
        $user = $this->userProvider->loadUserByUsername($username);
        if ($user) {
            $user->incrementLoginFailed();
            $this->logger->critical('FAILED LOGIN:attempts[' . $user->getLoginFailed() .'] - '. $username);
        } else {
            $this->logger->critical('FAILED LOGIN: ' . $username);
        }

        if (!$this->lockout->isEnabled()) {
            return;
        }

        if (!$user) {
            return;
        }

        if ($user->getLoginFailed() >= $this->lockout->getFailedLoginsCount()) {
            $user->lockout($this->lockout->getTimeDate()->nowDb());
        }
        return;
    }
}
