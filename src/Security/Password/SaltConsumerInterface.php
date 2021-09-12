<?php


namespace Dotbcrm\Dotbcrm\Security\Password;

/**
 *
 * Interface to be implemented by hash backends which are in need
 * of salt to be generated.
 *
 */
interface SaltConsumerInterface
{
    /**
     * Set salt generator
     * @param SaltGeneratorInterface $salt
     */
    public function setSalt(Salt $salt);
}
