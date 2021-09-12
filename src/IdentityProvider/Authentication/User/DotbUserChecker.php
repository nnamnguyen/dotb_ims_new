<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User;

use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Lockout;

use Symfony\Component\Security\Core\User\UserChecker;
use Symfony\Component\Security\Core\User\UserInterface;

class DotbUserChecker extends UserChecker
{
    /**
     * @var Lockout
     */
    protected $lockout;

    /**
     * @inheritDoc
     * @param Lockout $lockout
     */
    public function __construct(Lockout $lockout)
    {
        $this->lockout = $lockout;
    }

    /**
     * {@inheritdoc}
     */
    public function checkPreAuth(UserInterface $user)
    {
        parent::checkPreAuth($user);

        if ($user instanceof User && $this->lockout->isEnabled() && $this->lockout->isUserLocked($user)) {
            $this->lockout->throwLockoutException($user);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function checkPostAuth(UserInterface $user)
    {
        /**
         * All password expiration requests are processed in Mango after login
         * Disable IdM auth password expire check by default
         * @see \Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Listener\Success\UserPasswordListener
         * @var User $user
         */
        $user->setPasswordExpired(false);
        parent::checkPostAuth($user);
    }
}
