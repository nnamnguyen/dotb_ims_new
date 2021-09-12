<?php


namespace Dotbcrm\IdentityProvider\Authentication\User;

use Dotbcrm\IdentityProvider\Authentication\User;
use Dotbcrm\IdentityProvider\App\Authentication\Lockout;

use Symfony\Component\Security\Core\User\UserChecker;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * This class performs post authentication checking for Local user.
 *
 * @package Dotbcrm\IdentityProvider\Authentication\User
 */
class LocalUserChecker extends UserChecker
{
    /**
     * @var Lockout
     */
    protected $lockout;

    /**
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
}
