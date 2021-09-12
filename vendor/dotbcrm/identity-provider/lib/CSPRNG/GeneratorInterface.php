<?php


namespace Dotbcrm\IdentityProvider\CSPRNG;

/**
 * Generator random string.
 *
 * Interface GeneratorInterface
 * @package Dotbcrm\IdentityProvider\CSPRNG
 */
interface GeneratorInterface
{
    /**
     * Generates cryptographically secure pseudo-random string.
     *
     * @param int $size the length of the random string that should be returned in bytes.
     * @param string $prefix
     * @return string
     * @throws \RuntimeException
     */
    public function generate($size, $prefix = '');
}
