<?php


namespace Dotbcrm\IdentityProvider\Authentication\UserMapping;

use Dotbcrm\IdentityProvider\Authentication\User;

use Symfony\Component\Ldap\Entry;

/**
 * Mapping between LDAP Identity provider User attributes to App User attributes based on mapping config.
 */
class LDAPUserMapping implements MappingInterface
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
    public function map($entry)
    {
        $result = [];
        foreach ($this->mapping as $idpKey => $appKey) {
            $value = $this->getEntryValue($entry, $idpKey);
            if (!is_null($value)) {
                $result[$appKey] = $value;
            }
        }
        return $result;
    }

    /**
     * For LDAP we have strict identity-map: 'username' -> username-from-token.
     *
     * @inheritDoc
     */
    public function mapIdentity($token)
    {
        return [
            'field' => 'username',
            'value' => $token->getUsername(),
        ];
    }

    /**
     * For LDAP we have IdentityValue always set to Username.
     *
     * @inheritDoc
     */
    public function getIdentityValue(User $user)
    {
        return $user->getUsername();
    }

    /**
     * Get value from LDAP entry by a given key.
     *
     * @param Entry $entry
     * @param string $key
     * @return mixed
     */
    protected function getEntryValue(Entry $entry, $key)
    {
        if (!$entry->hasAttribute($key)) {
            return null;
        }

        $value = $entry->getAttribute($key);
        if (is_array($value)) {
            return $value[0];
        } else {
            return $value;
        }
    }
}
