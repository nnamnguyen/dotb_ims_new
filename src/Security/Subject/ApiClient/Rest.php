<?php


namespace Dotbcrm\Dotbcrm\Security\Subject\ApiClient;

use Dotbcrm\Dotbcrm\Security\Subject\ApiClient;

/**
 * An REST API client used to make a change
 */
final class Rest implements ApiClient
{
    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        return [
            '_type' => 'rest-api',
        ];
    }
}
