<?php


namespace Dotbcrm\Dotbcrm\Security\Subject\ApiClient;

use Dotbcrm\Dotbcrm\Security\Subject\ApiClient;

/**
 * A BWC API client used to make a change
 */
final class Bwc implements ApiClient
{
    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        return [
            '_type' => 'bwc-api',
        ];
    }
}
