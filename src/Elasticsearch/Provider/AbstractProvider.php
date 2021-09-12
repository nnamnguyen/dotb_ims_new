<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider;

/**
 *
 * Base abstract provider
 *
 */
abstract class AbstractProvider implements ProviderInterface
{
    /**
     * Provider identifier
     * @var string
     */
    protected $identifier;

    /**
     * User context
     * @var \User
     */
    protected $user;

    /**
     * {@inheritdoc}
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * {@inheritdoc}
     */
    public function setUser(\User $user)
    {
        $this->user = $user;
    }
}
