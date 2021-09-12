<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User;

use Etechnika\IdnaConvert\IdnaConvert;
use Dotbcrm\IdentityProvider\Authentication\Exception\InvalidIdentifier\EmptyFieldException;
use Dotbcrm\IdentityProvider\Authentication\Exception\InvalidIdentifier\EmptyIdentifierException;
use Dotbcrm\IdentityProvider\Authentication\Exception\InvalidIdentifier\IdentifierInvalidFormatException;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User;
use Dotbcrm\Dotbcrm\IdentityProvider\Authentication\UserProvider\DotbLocalUserProvider;

use Symfony\Component\Security\Core\User\UserChecker;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

/**
 * Class performs post authentication checking for Dotb SAML user.
 * It searches for corresponding Dotb User in database;
 * if User is not found and auto-creation is enabled it creates one.
 *
 * @package Dotbcrm\Dotbcrm\IdentityProvider\Authentication\User
 */
class DotbSAMLUserChecker extends UserChecker
{
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

    /**
     * Check if SAML user corresponds to Dotb User.
     * If found auth is considered OK.
     * If not found and automatic user-provisioning is set to true, Dotb User is created and auth is OK.
     * If user-provisioning is set to false, auth fails.
     *
     * {@inheritdoc}
     */
    public function checkPostAuth(UserInterface $user)
    {
        $this->loadDotbUser($user);
        parent::checkPostAuth($user);
    }

    /**
     * Find or create Dotb User.
     *
     * @param User $user
     */
    protected function loadDotbUser(User $user)
    {
        $nameIdentifier = $user->getUsername();
        $provision = $user->getAttribute('provision');

        $fixedAttributes = [
            'employee_status' => User::USER_EMPLOYEE_STATUS_ACTIVE,
            'status' => User::USER_STATUS_ACTIVE,
            'is_admin' => 0,
            'external_auth_only' => 1,
            'system_generated_password' => 0,
        ];

        $defaultAttributes = [
            'user_name' => $nameIdentifier,
            'last_name' => $nameIdentifier,
            'email' => $nameIdentifier,
        ];

        $identityField = $user->getAttribute('identityField');
        $identityValue = $user->getAttribute('identityValue');
        $this->validateIdentifier($identityField, $identityValue);

        try {
            $dotbUser = $this->localUserProvider->loadUserByField($identityValue, $identityField)->getDotbUser();
            $this->updateUserCustomFields($dotbUser, $user->getAttribute('attributes')['update']);
        } catch (UsernameNotFoundException $e) {
            if (!$provision) {
                throw $e;
            }
            $userAttributes = array_merge(
                $defaultAttributes,
                $user->getAttribute('attributes')['create'],
                $fixedAttributes
            );
            $dotbUser = $this->localUserProvider->createUser($nameIdentifier, $userAttributes);
        }
        $user->setDotbUser($dotbUser);
    }

    /**
     * Update custom fields of Dotb User.
     *
     * @param \User $dotbUser
     * @param array $customFields
     */
    protected function updateUserCustomFields($dotbUser, $customFields = [])
    {
        $updated = false;

        foreach ($customFields as $field => $value) {
            if (!property_exists($dotbUser, $field)) {
                continue;
            }

            if ($dotbUser->$field != $value) {
                $dotbUser->$field = $value;
                $updated = true;
            }
        }

        if ($updated) {
            $dotbUser->save();
        }
    }

    /**
     * Validation Identifier
     *
     * @param string $field
     * @param string $nameIdentifier
     * @throws EmptyFieldException
     * @throws EmptyIdentifierException
     * @throws IdentifierInvalidFormatException
     */
    protected function validateIdentifier($field, $nameIdentifier)
    {
        if ('' == $field) {
            throw new EmptyFieldException('Empty field name of identifier');
        }
        if ('' == $nameIdentifier) {
            throw new EmptyIdentifierException('Empty identifier');
        }
        if ('email' == $field && !filter_var(IdnaConvert::encodeString($nameIdentifier), FILTER_VALIDATE_EMAIL)) {
            throw new IdentifierInvalidFormatException('Invalid format of nameIdentifier email expected');
        }
    }
}
