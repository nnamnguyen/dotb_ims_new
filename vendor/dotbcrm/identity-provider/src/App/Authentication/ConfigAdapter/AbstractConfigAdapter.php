<?php


namespace Dotbcrm\IdentityProvider\App\Authentication\ConfigAdapter;

abstract class AbstractConfigAdapter
{
    /**
     * modify idp-api configs to ipd-php
     * @param $config
     * @return array
     */
    abstract public function getConfig(string $config): array;

    /**
     * Decodes a JSON string.
     * @param string $encoded
     * @return mixed
     */
    protected function decode($encoded)
    {
        if (empty($encoded)) {
            return [];
        }
        try {
            return \GuzzleHttp\json_decode($encoded, true);
        } catch (\InvalidArgumentException $e) {
            return [];
        }
    }
}
