<?php


namespace Dotbcrm\Dotbcrm\Security\Subject;

use User as DotbUser;

/**
 * A Dotb user making changes through an API client
 */
final class User extends Bean
{
    /**
     * @var ApiClient
     */
    private $client;

    /**
     * Constructor
     *
     * @param DotbUser $user
     * @param ApiClient $client
     */
    public function __construct(DotbUser $user, ApiClient $client)
    {
        parent::__construct($user);

        $this->client = $client;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        return array_merge([
            '_type' => 'user',
        ], parent::jsonSerialize(), [
            'client' => $this->client->jsonSerialize(),
        ]);
    }
}
