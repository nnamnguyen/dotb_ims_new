<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User;

use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\UserProvider\DotbLocalUserProvider;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserChecker;
use Symfony\Component\Security\Core\User\UserInterface;

class DotbOIDCUserChecker extends UserChecker
{
    /**
     * Predefined user attributes.
     * @var array
     */
    protected $fixedUserAttributes = [
        'employee_status' => User::USER_EMPLOYEE_STATUS_ACTIVE,
        'status' => User::USER_STATUS_ACTIVE,
        'is_admin' => 0,
        'external_auth_only' => 1,
        'system_generated_password' => 0,
    ];

    /**
     * @var DotbLocalUserProvider
     */
    protected $localUserProvider;

    /**
     * @param DotbLocalUserProvider $localUserProvider
     */
    public function __construct(DotbLocalUserProvider $localUserProvider)
    {
        $this->localUserProvider = $localUserProvider;
    }

    public function checkPostAuth(UserInterface $user)
    {
        $this->loadDotbUser($user);
        parent::checkPostAuth($user);
    }

    /**
     * Find or create Dotb User.
     *
     * @param User $user
     * @throws \Exception
     */
    protected function loadDotbUser(User $user)
    {
        $userAttributes = $user->getAttribute('oidc_data');
        $identify = $user->getAttribute('oidc_identify');

        try {
            $dotbUser = $this->localUserProvider
                ->loadUserByField($identify['value'], $identify['field'])
                ->getDotbUser();
            $this->setUserData($dotbUser, $userAttributes);
        } catch (UsernameNotFoundException $e) {
            $userAttributes = array_merge(
                [$identify['field'] => $identify['value']],
                $this->fixedUserAttributes,
                $userAttributes
            );
            $dotbUser = $this->localUserProvider->createUser($userAttributes['user_name'], $userAttributes);
        }
        $user->setDotbUser($dotbUser);
    }

    /**
     * Compare user data and set changes
     * PopulateFromRow couldn't be used because all non-oidc fields are set to empty
     * @param \User $dotbUser
     * @param array $attributes
     */
    protected function setUserData(\User $dotbUser, array $attributes)
    {
        $isDataChanged = false;
        $email = null;
        if (isset($attributes['email'])) {
            $primaryEmail = $dotbUser->emailAddress->getPrimaryAddress($dotbUser);
            if (strcasecmp($primaryEmail, $attributes['email']) !== 0) {
                $email = $attributes['email'];
            }
            unset($attributes['email']);
        }

        $attributes = $this->getDbMassagedAttributes($attributes, $dotbUser);
        foreach ($attributes as $name => $value) {
            if (isset($dotbUser->$name) && strcasecmp($dotbUser->$name, $value) !== 0) {
                $dotbUser->$name = $value;
                $isDataChanged = true;
            }
        }
        if ($isDataChanged) {
            $dotbUser->save();
        }
        if ($email) {
            $dotbUser->emailAddress->addAddress($email, true);
            $dotbUser->emailAddress->save($dotbUser->id, $dotbUser->module_dir);
        }
    }

    /**
     * Get Db massaged attributes for comparison
     *
     * @param array $attributes
     * @param \User $dotbUser
     * @return array
     */
    private function getDbMassagedAttributes(array $attributes, \User $dotbUser): array
    {
        $db = $dotbUser->db;
        $fieldDefs = $dotbUser->getFieldDefinitions('name', array_keys($attributes));
        array_walk($attributes, function (&$value, $key) use ($db, $fieldDefs) {
            $value = $db->massageValue($value, $fieldDefs[$key], true);
        });

        return $attributes;
    }
}
