<?php

namespace DRI_Workflows\Exception;

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class InvalidLicenseException extends \DotbApiException
{
    public $errorLabel = 'invalid_license';
    public $messageLabel = 'ERROR_INVALID_LICENSE';
    public $httpCode = 403;
}
