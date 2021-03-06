<?php


namespace Dotbcrm\IdentityProvider\Authentication\UserMapping;

use Dotbcrm\IdentityProvider\Authentication\User;

/**
 * Mapping between SAML Identity provider User attributes to App User attributes based on mapping config.
 */
class SAMLUserMapping implements MappingInterface
{
    /**
     * IdP to App mapping fields.
     * @var array
     */
    protected $mapping = [];

    /**
     * @param array $mapping
     */
    public function __construct(array $mapping)
    {
        $this->mapping = $mapping;
    }

    /**
     * @inheritDoc
     */
    public function map($response)
    {
        $result = [];
        $idpUserAttributes = $response->getAttributes();

        foreach ($this->mapping as $idpKey => $appKey) {
            // add field mapped to 'name_id' to regular fields.
            if ($idpKey === 'name_id') {
                $nameId = $response->getNameId();
                $result[$appKey] = $nameId;
                continue;
            }
            if (array_key_exists($idpKey, $idpUserAttributes)) {
                $result[$appKey] = $this->processValue($idpUserAttributes[$idpKey]);
            }
        }
        return $result;
    }

    /**
     * If no 'name_id' was specified defaults mapping to 'email' field.
     *
     * @inheritDoc
     */
    public function mapIdentity($response)
    {
        return [
            'field' => $this->getIdentityField(),
            'value' => $response->getNameId()
        ];
    }

    /**
     * Get SP identity field, email by default
     *
     * @return string
     */
    protected function getIdentityField()
    {
        return isset($this->mapping['name_id']) ? $this->mapping['name_id'] : 'email';
    }

    public function getIdentityValue(User $user)
    {
        $identityField = $this->getIdentityField();
        return $user->hasAttribute($identityField) ? $user->getAttribute($identityField) : null;
    }

    /**
     * Get meaningful value.
     *
     * @param array $value
     * @return array
     */
    protected function processValue(array $value)
    {
        return $value[0];
    }
}
