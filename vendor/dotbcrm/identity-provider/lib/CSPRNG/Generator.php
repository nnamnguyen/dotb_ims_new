<?php


namespace Dotbcrm\IdentityProvider\CSPRNG;

/**
 * @inheritDoc
 */
class Generator implements GeneratorInterface
{
    /**
     * @inheritDoc
     */
    public function generate($size, $prefix = '')
    {
        $length = $size - strlen($prefix);
        if ($length < 1) {
            throw new \RuntimeException('The size must be at least one point longer than the prefix length');
        }

        $bytes = random_bytes($length);
        $random = strtr(substr(base64_encode($bytes), 0, $length), '+/', '-_');
        $result = $prefix . $random;
        return $result;
    }
}
