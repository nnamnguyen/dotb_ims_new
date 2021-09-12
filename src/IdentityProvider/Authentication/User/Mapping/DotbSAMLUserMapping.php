<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User\Mapping;

use OneLogin_Saml2_Response;
use Dotbcrm\IdentityProvider\Authentication\UserMapping\SAMLUserMapping;

/**
 * Class for getting proper mappings of NameID field and possible custom fields for User create/update.
 */
class DotbSAMLUserMapping extends SAMLUserMapping
{
    /**
     * Dotb SAML config.
     * @var array
     */
    protected $config;

    /**
     * @var \DOMXpath
     */
    protected $xpath;

    /**
     * @param array $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * @param OneLogin_Saml2_Response $response
     * @return array
     */
    public function map($response)
    {
        $result = [
            'create' => [],
            'update' => [],
        ];

        foreach (array_keys($result) as $category) {
            foreach ($this->getCustomFields($category) as $field => $attribute) {
                if ($this->hasAttribute($response, $attribute)) {
                    $result[$category][$field] = $this->getAttribute($response, $attribute);
                }
            }
        }

        return $result;
    }

    /**
     * @param OneLogin_Saml2_Response $response
     * @return array
     */
    public function mapIdentity($response)
    {
        $fields = $this->getCustomFields('check');

        $field = $this->getIdentityField();

        if (isset($fields['user_name']) && $this->hasAttribute($response, $fields['user_name'])) {
            $value = $this->getAttribute($response, $fields['user_name']);
        } else {
            $value = $response->getNameId();
        }

        return [
            'field' => $field,
            'value' => $value,
        ];
    }

    /**
     * Get SP identity field, email by default
     *
     * @inheritDoc
     */
    protected function getIdentityField()
    {
        return !empty($this->config['sp']['dotbCustom']['id']) ? $this->config['sp']['dotbCustom']['id'] : 'email';
    }

    /**
     * Get fields list of a particular category from SAML settings.
     *
     * @param string $type
     * @return array
     */
    protected function getCustomFields($type)
    {
        if (isset($this->config['sp']['dotbCustom']['saml2_settings'][$type])) {
            return $this->config['sp']['dotbCustom']['saml2_settings'][$type];
        } else {
            return [];
        }
    }

    /**
     * Extract attribute from SAML response array by its name.
     *
     * @param OneLogin_Saml2_Response $response
     * @param string $name
     * @return mixed
     */
    protected function getAttribute(OneLogin_Saml2_Response $response, $name)
    {
        if (!empty($this->config['sp']['dotbCustom']['useXML'])) {
            $xpath = $this->getDOMXPath($response->getXMLDocument());
            $xmlNodes = $xpath->query($name);
            if ($xmlNodes === false || $xmlNodes->length == 0) {
                return null;
            }
            return $xmlNodes->item(0)->nodeValue;
        }

        $attributes = $response->getAttributes();
        return isset($attributes[$name]) ? $attributes[$name][0] : null;
    }

    /**
     * Check existence of an attribute in SAML response.
     *
     * @param OneLogin_Saml2_Response $response
     * @param string $name
     * @return bool
     */
    protected function hasAttribute(OneLogin_Saml2_Response $response, $name)
    {
        return !is_null($this->getAttribute($response, $name));
    }

    /**
     * Build DOMXPath.
     *
     * @param \DOMDocument $xml
     * @return \DOMXpath
     */
    protected function getDOMXPath($xml)
    {
        if (!$this->xpath) {
            $this->xpath = new \DOMXpath($xml);
        }
        return $this->xpath;
    }
}
