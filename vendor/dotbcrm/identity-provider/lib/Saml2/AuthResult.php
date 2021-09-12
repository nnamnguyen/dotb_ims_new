<?php


namespace Dotbcrm\IdentityProvider\Saml2;

/**
 * Class for store information about authorization response or request parameters that passed to service.
 */
class AuthResult
{
    /**
     * Destination url to send result.
     * @var string
     */
    protected $url;

    /**
     * HTTP method.
     * @var string
     */
    protected $method;

    /**
     * Additional attributes to store.
     * @var array
     */
    protected $attributes;

    /**
     * AuthResult constructor.
     * @param $url
     * @param $method
     * @param array $attributes
     */
    public function __construct($url, $method, $attributes = [])
    {
        $this->url = $url;
        $this->method = $method;
        $this->attributes = $attributes;
    }

    /**
     * Gets url to send result
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Gets HTTP method.
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Gets additional attributes to send.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
}
