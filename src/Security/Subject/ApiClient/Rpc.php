<?php


namespace Dotbcrm\Dotbcrm\Security\Subject\ApiClient;

use Dotbcrm\Dotbcrm\Security\Subject\ApiClient;

/**
 * A legacy RPC (SOAP or what was called "REST") API client used to make a change
 */
final class Rpc implements ApiClient
{
    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        return [
            '_type' => 'rpc-api',
        ];
    }
}
