<?php


namespace Dotbcrm\IdentityProvider\App\Command;

use Dotbcrm\IdentityProvider\App\Application;

/**
 * ApplicationAwareInterface for console commands
 */
interface ApplicationAwareInterface
{
    /**
     * @param Application $app an application instance.
     */
    public function setApplicationInstance(Application $app);
}
