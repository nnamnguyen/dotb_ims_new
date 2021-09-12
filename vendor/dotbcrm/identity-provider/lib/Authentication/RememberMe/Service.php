<?php


namespace Dotbcrm\IdentityProvider\Authentication\RememberMe;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Service
{
    /**
     * @var SessionInterface
     */
    protected $storage;

    const STORAGE_KEY = 'loggedInIdentities';

    /**
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->storage = $session;
    }

    /**
     * Stores the token
     *
     * @param TokenInterface $token
     */
    public function store(TokenInterface $token): void
    {
        $this->storage->set(self::STORAGE_KEY, [$token]);
    }

    /**
     * Retrieves remembered token if any
     *
     * @return TokenInterface|null
     */
    public function retrieve(): ?TokenInterface
    {
        return $this->storage->get(self::STORAGE_KEY)[0] ?? null;
    }

    /**
     * Clear remembered tokens
     */
    public function clear(): void
    {
        $this->storage->remove(self::STORAGE_KEY);
    }
}
