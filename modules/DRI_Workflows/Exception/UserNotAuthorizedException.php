<?php

namespace DRI_Workflows\Exception;

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class UserNotAuthorizedException extends InvalidLicenseException
{
    public $errorLabel = 'invalid_license';
    public $messageLabel = 'ERROR_USER_MISSING_ACCESS';
    public $httpCode = 403;
}
