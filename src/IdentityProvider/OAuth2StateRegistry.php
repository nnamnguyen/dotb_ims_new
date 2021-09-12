<?php


namespace Dotbcrm\Dotbcrm\IdentityProvider;

/**
 * Oauth2 state session registry.
 *
 * Class OAuth2StateRegistry
 * @package Dotbcrm\Dotbcrm\IdentityProvider
 */
class OAuth2StateRegistry
{
    /**
     * Register state
     * @param string $state
     */
    public function registerState(string $state): void
    {
        if (!session_id()) {
            session_start();
        }
        $_SESSION[$state] = true;
    }

    /**
     * Checks if state is registered
     * @param string $state
     * @return bool
     */
    public function isStateRegistered(string $state): bool
    {
        return isset($_SESSION[$state]);
    }

    /**
     * Unregister state
     *
     * @param string $state
     */
    public function unregisterState(string $state): void
    {
        unset($_SESSION[$state]);
    }
}
