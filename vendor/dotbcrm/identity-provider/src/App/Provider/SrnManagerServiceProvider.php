<?php


namespace Dotbcrm\IdentityProvider\App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Dotbcrm\IdentityProvider\Srn\Manager;

class SrnManagerServiceProvider implements ServiceProviderInterface
{
    /**
     * @inheritdoc
     */
    public function register(Container $app): void
    {
        $app['SrnManager'] = $app->protect(function (string $region) use ($app) {
            if (empty($app['config']['idm']['partition'])) {
                throw new \InvalidArgumentException('Partition MUST be set');
            }
            $managerConfig = [
                'partition' => $app['config']['idm']['partition'],
                'region' => $region,
            ];
            return new Manager($managerConfig);
        });
    }
}
