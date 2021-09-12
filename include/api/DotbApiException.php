<?php


class DotbApiException extends DotbException
{
    /**
     * The HTTP response code to send to the consumer in case of an exception
     *
     * @var integer
     */
    public $httpCode = 400;

    /**
     * The label for the description of this exception. Used in help documentation.
     * Maps to the $messageLabel value with '_DESC' appended to it.
     *
     * @var string
     */
    public $descriptionLabel;

    /**
     * @param string $messageLabel optional Label for error message.  Used to load the appropriate translated message.
     * @param array $msgArgs optional set of arguments to substitute into error message string
     * @param string|null $moduleName Provide module name if $messageLabel is a module string, leave empty if
     *  $messageLabel is in app strings.
     * @param int $httpCode
     * @param string $errorLabel
     */
    public function __construct($messageLabel = null, $msgArgs = null, $moduleName = null, $httpCode = 0, $errorLabel = null)
    {

        if ($httpCode != 0) {
            $this->httpCode = $httpCode;
        }
        parent::__construct($messageLabel, $msgArgs, $moduleName, $errorLabel);
        if (!empty($this->messageLabel)) {
            $this->descriptionLabel = $this->messageLabel . '_DESC';
        }
    }

    public function getHttpCode()
    {
        return $this->httpCode;
    }
}
/**
 * General error, no specific cause known.
 */
class DotbApiExceptionError extends DotbApiException
{
    public $httpCode = 500;
    public $errorLabel = 'fatal_error';
    public $messageLabel = 'EXCEPTION_FATAL_ERROR';
}

/**
 * Incorrect API version
 */
class DotbApiExceptionIncorrectVersion extends DotbApiException
{
    public $httpCode = 301;
    public $errorLabel = 'incorrect_version';
    public $messageLabel = 'EXCEPTION_INCORRECT_VERSION';
}

/**
 * Token not supplied or token supplied is invalid.
 * The client should display the username and password screen
 */
class DotbApiExceptionNeedLogin extends DotbApiException
{
    public $httpCode = 401;
    public $errorLabel = 'need_login';
    public $messageLabel = 'EXCEPTION_NEED_LOGIN';
}

/**
 * The user's session is invalid
 * The client should get a new token and retry.
 */
class DotbApiExceptionInvalidGrant extends DotbApiException
{
    public $httpCode = 401;
    public $errorLabel = 'invalid_grant';
    public $messageLabel = 'EXCEPTION_INVALID_TOKEN';
}

/**
 * This action is not allowed for this user.
 */
class DotbApiExceptionNotAuthorized extends DotbApiException
{
    public $httpCode = 403;
    public $errorLabel = 'not_authorized';
    public $messageLabel = 'EXCEPTION_NOT_AUTHORIZED';
}
/**
 * This user is not active.
 */
class DotbApiExceptionPortalUserInactive extends DotbApiException
{
    public $httpCode = 403;
    public $errorLabel = 'inactive_portal_user';
    public $messageLabel = 'EXCEPTION_INACTIVE_PORTAL_USER';
}
/**
 * Portal is not activated by configuration.
 */
class DotbApiExceptionPortalNotConfigured extends DotbApiException
{
    public $httpCode = 403;
    public $errorLabel = 'portal_not_configured';
    public $messageLabel = 'EXCEPTION_PORTAL_NOT_CONFIGURED';
}
// @codingStandardsIgnoreStart
/**
 * # of active users exceeds license seats
 */
class DotbApiExceptionLicenseSeatsNeeded extends DotbApiException
{
    public $httpCode = 403;
    public $errorLabel = 'license_seats_needed';
    public $messageLabel = 'EXCEPTION_LICENSE_SEATS_NEEDED';
}
// @codingStandardsIgnoreEnd
/**
 * URL does not resolve into a valid REST API method.
 */
class DotbApiExceptionNoMethod extends DotbApiException
{
    public $httpCode = 404;
    public $errorLabel = 'no_method';
    public $messageLabel = 'EXCEPTION_NO_METHOD';
}
/**
 * Resource specified by the URL does not exist.
 */
class DotbApiExceptionNotFound extends DotbApiException
{
    public $httpCode = 404;
    public $errorLabel = 'not_found';
    public $messageLabel = 'EXCEPTION_NOT_FOUND';
}
/**
 * Thrown when the client attempts to edit the data on the server that was already edited by
 * different client.
 */
class DotbApiExceptionEditConflict extends DotbApiException
{
    public $httpCode = 409;
    public $errorLabel = 'edit_conflict';
    public $messageLabel = 'EXCEPTION_EDIT_CONFLICT';
}

class DotbApiExceptionInvalidHash extends DotbApiException
{
    public $httpCode = 412;
    public $errorLabel = 'metadata_out_of_date';
    public $messageLabel = 'EXCEPTION_METADATA_OUT_OF_DATE';
}

class DotbApiExceptionRequestTooLarge extends DotbApiException
{
    public $httpCode = 413;
    public $errorLabel = 'request_too_large';
    public $messageLabel = 'EXCEPTION_REQUEST_TOO_LARGE';
}
/**
 * One of the required parameters for the request is missing.
 */
class DotbApiExceptionMissingParameter extends DotbApiException
{
    public $httpCode = 422;
    public $errorLabel = 'missing_parameter';
    public $messageLabel = 'EXCEPTION_MISSING_PARAMTER';
}
/**
 * One of the required parameters for the request is incorrect.
 */
class DotbApiExceptionInvalidParameter extends DotbApiException
{
    public $httpCode = 422;
    public $errorLabel = 'invalid_parameter';
    public $messageLabel = 'EXCEPTION_INVALID_PARAMETER';
}
/**
 * The API method is unable to process parameters due to some of them being wrong.
 */
class DotbApiExceptionRequestMethodFailure extends DotbApiException
{
    public $httpCode = 424;
    public $errorLabel = 'request_failure';
    public $messageLabel = 'EXCEPTION_REQUEST_FAILURE';
}

/**
 * The client is out of date for this version
 */
class DotbApiExceptionClientOutdated extends DotbApiException
{
    public $httpCode = 433;
    public $errorLabel = 'client_outdated';
    public $messageLabel = 'EXCEPTION_CLIENT_OUTDATED';
}

/**
 * When used as a proxy, this means that our API made a call and got a response
 * it couldn't handle
 */
class DotbApiExceptionConnectorResponse extends DotbApiException
{
    public $httpCode = 502;
    public $errorLabel = 'bad_gateway';
    public $messageLabel = 'EXCEPTION_CONNECTOR_RESPONSE';
}

/**
 * We're in the maintenance mode
 */
class DotbApiExceptionMaintenance extends DotbApiException
{
    public $httpCode = 503;
    public $errorLabel = 'maintenance';
    public $messageLabel = 'EXCEPTION_MAINTENANCE';
}

/**
 * The server is busy or overloaded. Generally should be temporary.
 */
class DotbApiExceptionServiceUnavailable extends DotbApiException
{
    public $httpCode = 503;
    public $errorLabel = 'service_unavailable';
    public $messageLabel = 'EXCEPTION_SERVICE_UNAVAILABLE';
}

/**
 * SearchEngine is unavailable
 */
class DotbApiExceptionSearchUnavailable extends DotbApiExceptionServiceUnavailable
{
    public $errorLabel = 'search_unavailable';
    public $messageLabel = 'EXCEPTION_SEARCH_UNAVAILABLE';
}

/**
 * SearchEngine runtime error
 */
class DotbApiExceptionSearchRuntime extends DotbApiExceptionError
{
    public $errorLabel = 'search_runtime';
    public $messageLabel = 'EXCEPTION_SEARCH_RUNTIME';
}

/**
 * Locked field edit attempt exception
 */
class DotbApiExceptionFieldEditDisabled extends DotbApiExceptionNotAuthorized
{
    public $errorLabel = 'field_locked';
    public $messageLabel = 'EXCEPTION_FIELD_LOCKED_FOR_EDIT';
}
