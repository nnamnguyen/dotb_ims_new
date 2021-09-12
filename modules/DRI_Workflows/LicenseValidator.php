<?php

namespace DRI_Workflows;

use DRI_Workflows\Exception\InvalidLicenseException;
use DRI_Workflows\Exception\UserNotAuthorizedException;

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class LicenseValidator
{
    const KEY_VALID_UNTIL = 'valid_until';
    const KEY_NUMBER_OF_USERS = 'number_of_users';
    const KEY_LICENSE = 'license_key';
    const KEY_APPLICATION = 'application';

    /**
     * @var int
     */
    private static $currentUsers;

    /**
     * @var string
     */
    private $labelName = 'CUSTOMER_JOURNEY';

    /**
     * @var string
     */
    private $licenseAboutToExpireWarningInterval = '- 2 weeks';

    /**
     * @var string
     */
    private $notificationInterval = '- 2 days';

    /**
     * @var \DBManager
     */
    private $db;

    /**
     * @var \TimeDate
     */
    private $timeDate;

    /**
     * @var string
     */
    private $application;

    /**
     * @var string
     */
    private $licenseKey;

    /**
     * @var string
     */
    private $validationKeyEncrypted;

    /**
     * @var string
     */
    private $validationKey;

    /**
     * @var array
     */
    private $requiredKeys = array (
        self::KEY_LICENSE,
        self::KEY_APPLICATION,
        self::KEY_VALID_UNTIL,
        self::KEY_NUMBER_OF_USERS,
    );

    /**
     * @param string $application
     * @param string $licenseKey
     * @param string $validationKey
     */
    public function __construct($application, $licenseKey, $validationKey)
    {
        $this->application = $application;
        $this->licenseKey = $licenseKey;
        $this->validationKeyEncrypted = $validationKey;

        $this->db = \DBManagerFactory::getInstance();
        $this->timeDate = \TimeDate::getInstance();
    }

    /**
     * @throws \DRI_Workflows\Exception\InvalidLicenseException
     * @throws \DotbApiException
     */
    public function validateKey()
    {
    }

    /**
     * @throws \DRI_Workflows\Exception\InvalidLicenseException
     */
    public function validateCurrentUser()
    {
    }

    /**
     * @return \DateTime
     */
    private function getNotificationDate()
    {
        $notificationDate = $this->timeDate->getNow();
        $notificationDate->modify($this->notificationInterval);
        return $notificationDate;
    }

    /**
     * @param string $label
     * @throws InvalidLicenseException
     */
    private function throwError($label)
    {
    }

    /**
     * @return \DateTime
     */
    public function getValidUntil()
    {
        $validUntil = $this->timeDate->fromDbDate("2300-01-01");
        $validUntil->setTime(0, 0, 0);
        return $validUntil;
    }

    /**
     * @return int
     */
    public static function getCurrentUsers()
    {
        return 1;
    }

    /**
     * @return mixed
     */
    public function getUserLimit()
    {
        return 100;
    }
}
