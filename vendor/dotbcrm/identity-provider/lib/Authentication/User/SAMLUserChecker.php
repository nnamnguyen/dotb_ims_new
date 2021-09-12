<?php


namespace Dotbcrm\IdentityProvider\Authentication\User;

use Dotbcrm\IdentityProvider\Authentication\User as LocalUser;
use Symfony\Component\Security\Core\User\UserChecker;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Dotbcrm\IdentityProvider\Authentication\Exception\InvalidIdentifier\EmptyFieldException;
use Dotbcrm\IdentityProvider\Authentication\Exception\InvalidIdentifier\EmptyIdentifierException;
use Dotbcrm\IdentityProvider\Authentication\Exception\InvalidIdentifier\IdentifierInvalidFormatException;
use Dotbcrm\IdentityProvider\Authentication\UserProvider\LocalUserProvider;
use Dotbcrm\IdentityProvider\Authentication\Provider\Providers;
use Etechnika\IdnaConvert\IdnaConvert;

/**
 * Class SAMLUserChecker
 *
 * This class performs post authentication checking for SAML user.
 *
 * @package Dotbcrm\IdentityProvider\Authentication\User
 */
class SAMLUserChecker extends UserChecker
{
    /**
     * @var LocalUserProvider
     */
    protected $localUserProvider;

    /**
     * SAML provider configuration.
     * @var array
     */
    protected $config;

    public function __construct(LocalUserProvider $localUserProvider, array $config)
    {
        $this->localUserProvider = $localUserProvider;
        $this->config = $config;
    }

    /**
     * @inheritDoc
     */
    public function checkPostAuth(UserInterface $user)
    {
        $value = $user->getAttribute('identityValue');
        $field = $user->getAttribute('identityField');
        $this->validateIdentifier($field, $value);

        try {
            $localUser = $this->getLocalUser($value);
        } catch (UsernameNotFoundException $e) {
            if (empty($this->config['sp']['provisionUser'])) {
                throw $e;
            }
            $localUser = $this->localUserProvider->createUser(
                $value,
                Providers::SAML,
                $user->getAttribute('attributes')
            );
        }
        $user->setLocalUser($localUser);

        parent::checkPostAuth($user);
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

    /**
     * @param $value
     * @return LocalUser
     * @throws \Throwable
     */
    private function getLocalUser($value): LocalUser
    {
        try {
            $localUser = $this->localUserProvider->loadUserByFieldAndProvider($value, Providers::SAML);
        } catch (UsernameNotFoundException $e) {
            $localUser = $this->localUserProvider->loadUserByFieldAndProvider($value, Providers::LOCAL);
            $this->localUserProvider->linkUser(
                $localUser->getAttribute('id'),
                Providers::SAML,
                $value
            );
        }

        return $localUser;
    }
}
