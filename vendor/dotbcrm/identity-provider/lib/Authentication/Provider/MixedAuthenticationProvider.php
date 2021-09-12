<?php


namespace Dotbcrm\IdentityProvider\Authentication\Provider;

use Dotbcrm\IdentityProvider\Authentication\Token\MixedUsernamePasswordToken;

use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\ProviderNotFoundException;

/**
 * Supports a several type of authentication at once.
 * Goes through list of tokens and try to authenticate this tokens.
 *
 * Class MixedAuthenticationProvider
 * @package Dotbcrm\IdentityProvider\App\Provider
 */
class MixedAuthenticationProvider implements AuthenticationProviderInterface
{
    /**
     * @var AuthenticationProviderInterface[] | null
     */
    protected $providers = [];

    /**
     * @var string
     */
    protected $providerKey;

    /**
     * MixedAuthenticationProvider constructor.
     * @param array $providers
     * @param string $providerKey
     */
    public function __construct(array $providers, $providerKey)
    {
        $this->providers = $providers;
        $this->providerKey = $providerKey;
    }

    /**
     * @inheritdoc
     */
    public function authenticate(TokenInterface $token)
    {
        $lastException = null;
        $tokens = $token->getTokens();
        foreach ($tokens as $authToken) {
            foreach ($this->providers as $provider) {
                if (!$provider->supports($authToken)) {
                    continue;
                }

                try {
                    return $provider->authenticate($authToken);
                } catch (\Exception $e) {
                    if (!empty($e->errorLabel) && $e->errorLabel === 'license_seats_needed') {
                        throw $e;
                    }
                    $lastException = $e;
                }
            }
        }

        if ($lastException) {
            throw $lastException;
        }

        throw new ProviderNotFoundException(
            sprintf('No Authentication Provider found for token of class "%s".', get_class($token))
        );
    }

    /**
     * @inheritdoc
     */
    public function supports(TokenInterface $token)
    {
        return $token instanceof MixedUsernamePasswordToken && $this->providerKey == $token->getProviderKey();
    }
}
