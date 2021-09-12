<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\Listener\Success;

use Dotbcrm\Dotbcrm\Session\SessionStorage;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User;

use Symfony\Component\Security\Core\Event\AuthenticationEvent;

class UserPasswordListener
{
    /**
     * @var \DotbConfig
     */
    protected $config;

    /**
     * @var \TimeDate
     */
    protected $timeDate;

    /**
     * @var SessionStorage
     */
    protected $sessionStorage;

    /**
     * check is password expired
     * @param AuthenticationEvent $event
     * @return void
     */
    public function execute(AuthenticationEvent $event)
    {
        $isExpired = false;
        /** @var User $user */
        $user = $event->getAuthenticationToken()->getUser();
        $expirationType = (int) $this->getConfigValue($user->getPasswordType(), 'expiration', 0);
        switch ($expirationType) {
            case User::PASSWORD_EXPIRATION_TYPE_TIME:
                $isExpired = $this->checkPasswordTime($user);
                break;
            case User::PASSWORD_EXPIRATION_TYPE_LOGIN:
                $isExpired = $this->checkPasswordLoginAttempts($user);
                break;
        }
        if ($isExpired) {
            $this->setSessionVariable('hasExpiredPassword', '1');
        }
    }

    /**
     * Check how many times user has tried to login?
     * @param User $user
     * @return bool
     */
    protected function checkPasswordLoginAttempts(User $user)
    {
        $dotbUser = $user->getDotbUser();
        $attempts = $dotbUser->getPreference('loginexpiration');
        $dotbUser->setPreference('loginexpiration', ++$attempts);
        $user->allowUpdateDateModified(false);
        $user->getDotbUser()->save();

        $result = false;
        if ($attempts >= $this->getConfigValue($user->getPasswordType(), 'expirationlogin')) {
            $this->setSessionVariable('expiration_label', 'LBL_PASSWORD_EXPIRATION_LOGIN');
            $result = true;
        }
        return $result;
    }

    /**
     * Is user password time expired?
     * @param User $user
     * @return bool
     */
    protected function checkPasswordTime(User $user)
    {
        $userPasswordType = $user->getPasswordType();
        $lastChangeDate = $user->getPasswordLastChangeDate();
        if ($lastChangeDate) {
            $lastChangeDate = $this->getTimeDate()->fromDb($lastChangeDate);
        } else {
            $lastChangeDate = $this->getTimeDate()->nowDb();
            $user->setPasswordLastChangeDate($lastChangeDate);
            $user->allowUpdateDateModified(false);
            $user->getDotbUser()->save();
            $lastChangeDate = $this->getTimeDate()->fromDb($lastChangeDate);
        }
        $multiplier = $this->getConfigValue($userPasswordType, 'expirationtype', 1) ?: 1;
        // SP-1790:
        // Creating user with default password expiration settings results in password expired page on first login
        // Below, we calc $expireday essentially doing type*time; that requires that expirationtype factor is 1 or
        // greater, however, expirationtype defaults to following values: 0/day, 7/week, 30/month
        // (See and {debug} PasswordManager.tpl for more info)
        $daysInterval = $multiplier * $this->getConfigValue($userPasswordType, 'expirationtime', 1);
        if ($this->getTimeDate()->getNow()->ts < $lastChangeDate->get("+$daysInterval days")->ts) {
            return false;
        } else {
            $this->setSessionVariable('expiration_label', 'LBL_PASSWORD_EXPIRATION_TIME');
            return true;
        }
    }

    /**
     * return password's settings from dotb config
     * @return \TimeDate
     */
    protected function getTimeDate()
    {
        if (!$this->timeDate) {
            $this->timeDate = \TimeDate::getInstance();
        }
        return $this->timeDate;
    }

    /**
     * return password's settings from dotb config
     * @return \DotbConfig
     */
    protected function getDotbConfig()
    {
        if (!$this->config) {
            $this->config = \DotbConfig::getInstance();
        }
        return $this->config;
    }

    /**
     * return passwordsetting config value
     * @param $first
     * @param $second
     * @param null $default
     * @return mixed
     */
    protected function getConfigValue($first, $second, $default = null)
    {
        return $this->getDotbConfig()->get(sprintf('passwordsetting.%s%s', $first, $second), $default);
    }

    /**
     * set variable into $_SESSION
     * @param $key
     * @param $value
     */
    protected function setSessionVariable($key, $value)
    {
        if (!$this->sessionStorage) {
            $this->sessionStorage = SessionStorage::getInstance();
            if (!$this->sessionStorage->sessionHasId()) {
                $this->sessionStorage->start();
            }
        }
        $this->sessionStorage[$key] = $value;
    }
}
