<?php


namespace Dotbcrm\Dotbcrm\Security\Csrf;

use Dotbcrm\Dotbcrm\Session\SessionStorage;
use Symfony\Component\Security\Csrf\Exception\TokenNotFoundException;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

/**
 * Token storage that uses PHP's native session handling. This class
 * assumes the users session is already started and available.
 *
 * Code based on symfony/security-csrf:
 * @see \Symfony\Component\Security\Csrf\TokenStorage\NativeSessionTokenStorage
 */
class CsrfTokenStorage implements TokenStorageInterface
{
    /**
     * The namespace used to store values in the session.
     * @var string
     */
    const SESSION_NAMESPACE = 'csrf_tokens';

    /**
     * @var Dotbcrm\Dotbcrm\Util\Arrays\TrackableArray\TrackableArray
     */
    protected $sessionStore;

    public function __construct(SessionStorage $store) {
        if(!$store->offsetExists(static::SESSION_NAMESPACE)) {
            $store->offsetSet(static::SESSION_NAMESPACE, array());
        }
        $this->sessionStore = $store->offsetGet(static::SESSION_NAMESPACE);
    }

    /**
     * {@inheritdoc}
     */
    public function getToken($tokenId)
    {
        if (!$this->sessionStore->offsetExists($tokenId)) {
            throw new TokenNotFoundException('The CSRF token with ID '.$tokenId.' does not exist.');
        }

        return (string) $this->sessionStore->offsetGet($tokenId);
    }

    /**
     * {@inheritdoc}
     */
    public function setToken($tokenId, $token)
    {
        $this->sessionStore->offsetSet($tokenId, (string) $token);
    }

    /**
     * {@inheritdoc}
     */
    public function hasToken($tokenId)
    {
        return $this->sessionStore->offsetExists($tokenId);
    }

    /**
     * {@inheritdoc}
     */
    public function removeToken($tokenId)
    {
        $token = $this->hasToken($tokenId) ? $this->getToken($tokenId) : null;

        $this->sessionStore->offsetUnset($tokenId);

        return $token;
    }
}
