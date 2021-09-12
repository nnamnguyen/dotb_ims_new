<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication;

use Dotbcrm\IdentityProvider\Authentication\User as IdmUser;

class User extends IdmUser
{
    const USER_STATUS_ACTIVE = 'Active';
    const USER_STATUS_INACTIVE = 'Inactive';

    const USER_EMPLOYEE_STATUS_ACTIVE = 'Active';
    const USER_EMPLOYEE_STATUS_INACTIVE = 'Inactive';

    // User password generator types
    const PASSWORD_TYPE_SYSTEM = 'syst';
    const PASSWORD_TYPE_USER = 'user';

    // dotb config expiration types
    const PASSWORD_EXPIRATION_TYPE_TIME = 1;
    const PASSWORD_EXPIRATION_TYPE_LOGIN = 2;

    /**
     * @var bool
     */
    protected $isPasswordExpired = false;

    /**
     * @var \User
     */
    protected $dotbUser;

    /**
     * setter for mango base user
     * @param \User $user
     */
    public function setDotbUser(\User $user)
    {
        $this->dotbUser = $user;
    }

    /**
     * getter for mango base user
     * @return \User
     */
    public function getDotbUser()
    {
        return $this->dotbUser;
    }

    /**
     * set password expired
     * @param $isPasswordExpired
     */
    public function setPasswordExpired($isPasswordExpired)
    {
        $this->isPasswordExpired = $isPasswordExpired;
    }

    /**
     * Is credentials non expired?
     * @return boolean
     */
    public function isCredentialsNonExpired()
    {
        return !$this->isPasswordExpired;
    }

    /**
     * return dotb user password's type.
     * @return string
     */
    public function getPasswordType()
    {
        if ($this->dotbUser instanceof \User && !empty($this->dotbUser->system_generated_password)) {
            return self::PASSWORD_TYPE_SYSTEM;
        }
        return self::PASSWORD_TYPE_USER;
    }

    /**
     * return password last change date
     * @return string
     */
    public function getPasswordLastChangeDate()
    {
        return $this->getDotbUser()->pwd_last_changed;
    }

    /**
     * set password last change date
     * @param $date
     */
    public function setPasswordLastChangeDate($date)
    {
        $this->getDotbUser()->pwd_last_changed = $date;
    }

    /**
     * allows to update date_modified property
     * @param boolean $flag
     */
    public function allowUpdateDateModified($flag)
    {
        $this->getDotbUser()->update_date_modified = $flag;
    }

    /**
     * Return valid user login failed.
     * @return int
     */
    public function getLoginFailed()
    {
        return intval($this->getDotbUser()->getPreference('loginfailed'));
    }

    /**
     * Return user lockout.
     * @return bool
     */
    public function getLockout()
    {
        return (bool)$this->getDotbUser()->getPreference('lockout');
    }

    /**
     * Clear lockout state of user.
     */
    public function clearLockout()
    {
        /** @var \User $dotbUser */
        $dotbUser = $this->getDotbUser();
        $dotbUser->setPreference('lockout', '');
        $dotbUser->setPreference('loginfailed', 0);
        $dotbUser->savePreferencesToDB();
    }

    /**
     * Locking user.
     * @param $dateTime
     */
    public function lockout($dateTime)
    {
        /** @var \User $dotbUser */
        $dotbUser = $this->getDotbUser();
        $dotbUser->setPreference('lockout', '1');
        $dotbUser->setPreference('logout_time', $dateTime);
        $dotbUser->setPreference('loginfailed', 0);
        $dotbUser->savePreferencesToDB();
    }

    /**
     * Incrementing Login Failed.
     */
    public function incrementLoginFailed()
    {
        /** @var \User $dotbUser */
        $dotbUser = $this->getDotbUser();
        $dotbUser->setPreference('lockout', '');
        $dotbUser->setPreference('loginfailed', $this->getLoginFailed() + 1);
        $dotbUser->savePreferencesToDB();
    }

    public function hasAttribute($name)
    {
        if ($name == 'email') {
            return true;
        }
        return isset($this->dotbUser->$name) || parent::hasAttribute($name);
    }

    public function getAttribute($name)
    {
        if ($name == 'email') {
            return $this->dotbUser->emailAddress->getPrimaryAddress($this->dotbUser);
        }
        $value = parent::getAttribute($name);
        if (!is_null($value)) {
            return $value;
        } elseif ($this->dotbUser instanceof \User && isset($this->dotbUser->$name)) {
            return $this->dotbUser->$name;
        } else {
            return null;
        }
    }
}
