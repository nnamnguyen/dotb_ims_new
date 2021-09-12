<?php
/**
 * Your installation or use of this DotBCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotBCRM file.
 *
 * Copyright (C) DotBCRM Inc. All rights reserved.
 */

namespace Dotbcrm\Stage2;

use \Zend\Http\Client;
use DotbApiException;
use DotbApiExceptionError;
use DotbApiExceptionNotFound;
use DotbApiExceptionInvalidGrant;
use DotbApiExceptionNotAuthorized;

/**
 * This action is not allowed for this user due to Hint license expired.
 */
class HintApiExceptionNoLicense extends DotbApiException
{
    public $httpCode = 402;
    public $errorLabel = 'no_license';
    public $messageLabel = 'EXCEPTION_NO_LICENSE';
}

/**
 * This action is not allowed for this user due to Hint license expired.
 */
class HintApiExceptionLicenseExpired extends DotbApiException
{
    public $httpCode = 402;
    public $errorLabel = 'license_expired';
    public $messageLabel = 'EXCEPTION_LICENSE_EXPIRED';
}

/**
 * Class Stage2HttpClient
 *
 * HTTP REST API client for Dotb's Stage2 service.
 */
class Stage2HttpClient
{
    //
    //  Public properties
    //
    public $endpoint;
    public $accessToken;
    public $instanceId;
    public $licenseKey;

    //
    //  Public instance methods
    //

    /**
     * Constructor
     *
     * @param string $endpoint Endpoint on which Stage2 service is to be found.
     */
    public function __construct($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * Proxy to service's ping method.
     *
     * @return void
     * @throws DotbApiException
     * @throws DotbApiExceptionError
     * @throws DotbApiExceptionInvalidGrant
     * @throws DotbApiExceptionNotAuthorized
     * @throws DotbApiExceptionNotFound
     */
    public function ping()
    {
        $this->callNoAuthorization('GET', '/v1/ping');
    }

    /**
     * Proxy to service's authorize endpoint.
     *
     * @return array Response body when successful
     * @throws DotbApiException
     * @throws DotbApiExceptionError
     * @throws DotbApiExceptionInvalidGrant
     * @throws DotbApiExceptionNotAuthorized
     * @throws DotbApiExceptionNotFound
     */
    public function newToken()
    {
        //  Make the request.
        $response = $this->call('POST', '/v1/token');

        //  Return decoded body.
        return json_decode($response->getBody(), true);
    }

    //
    //  Raw access methods
    //

    /**
     * Makes a non-authorized HTTP request to instance-relative endpoint.
     *
     * @param string $method HTTP method (e.g. 'get')
     * @param string $path Relative path of REST API endpoint
     * @param array $body Request body converted to JSON for request purposes
     * @return \Zend_Http_Response HTTP response returned by Zend HTTP client
     * @throws DotbApiException
     * @throws DotbApiExceptionError
     * @throws DotbApiExceptionInvalidGrant
     * @throws DotbApiExceptionNotAuthorized
     * @throws DotbApiExceptionNotFound
     */
    public function callNoAuthorization($method, $path, array $body = array(), $timeout = 10)
    {
        return $this->call($method, $path, $body, $timeout, false);
    }

    /**
     * Makes an HTTP request with the given HTTP method.
     *
     * @param string $method HTTP method (e.g. 'get')
     * @param string $path Relative path of REST API endpoint
     * @param array $body Request body converted to JSON for request purposes
     * @param int $timeout
     * @param bool $authorization True if authorization should be used for the request.
     *
     * @return \Zend_Http_Response HTTP response returned by Zend HTTP client
     * @throws DotbApiException
     * @throws DotbApiExceptionError
     * @throws DotbApiExceptionInvalidGrant
     * @throws DotbApiExceptionNotAuthorized
     * @throws DotbApiExceptionNotFound
     */
    public function call(
        $method,
        $path,
        array $body = array(),
        $timeout = 10,
        $authorization = true)
    {
        $client = new \Zend_Http_Client();
        $client->setMethod($method);

        $uri = $this->endpoint . $path;

        $client->setUri($uri);

        $client->setConfig(array(
            'timeout' => $timeout
        ));

        if ($authorization) {
            //  If we have access token use bearer authentication
            //  otherwise use basic authentication.
            if (isset($this->accessToken)) {
                $client->setHeaders(
                    'authorization',
                    'bearer ' . $this->accessToken
                );
            } else {
                if (!isset($this->instanceId) || !isset($this->licenseKey)) {
                    throw new DotbApiException('Either accessToken or instanceId/licenseKey need to be set in client\'s options.');
                }

                $client->setHeaders(
                    'authorization',
                    'Basic ' . base64_encode($this->instanceId . ':' . $this->licenseKey)
                );
            }
        }

        //  Set the request's body as JSON if given.
        if (!empty($body)) {
            $client->setRawData(json_encode($body));
            $client->setHeaders('Content-Type', 'application/json');
        }

        //  Make the request.
        $response = $client->request();

        //  Analyze the response.
        switch ($response->getStatus()) {
            case 401:
                throw new DotbApiExceptionInvalidGrant();
            case 402:
                $body = json_decode($response->getBody(), true);
                if (is_null($body) || is_null($body['message'])) {
                    $GLOBALS['log']->error('Invalid response from Hint /token endpoint');
                    throw new HintApiExceptionNoLicense();
                }

                // In the message we can find the reason for the failure.
                // Consult SubscriptionServiceClient class on Hint backend for details.
                switch ($body['message']) {
                    case 'ExpiredDotbCRMLicense':
                    case 'ExpiredHintLicense':
                        throw new HintApiExceptionLicenseExpired();
                    case 'NoHintLicense':
                    default:
                        throw new HintApiExceptionNoLicense();
                }
                break;
            case 403:
                throw new DotbApiExceptionNotAuthorized();
            case 404:
                throw new DotbApiExceptionNotFound();
            case 200:
                return $response;
            default:
                throw new DotbApiExceptionError();
        }
    }
}
