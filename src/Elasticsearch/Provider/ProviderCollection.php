<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider;

use Dotbcrm\Dotbcrm\Elasticsearch\Container;

/**
 *
 * Provider collection iterator
 *
 */
class ProviderCollection implements \IteratorAggregate
{
    /**
     * @var AbstractProvider[]
     */
    private $providers = array();

    /**
     * @param array $providers Provider list
     */
    public function __construct(Container $container, array $providers = array())
    {
        foreach ($providers as $provider) {
            if (!$provider instanceof ProviderInterface) {
                $provider = $container->getProvider($provider);
            }
            $this->addProvider($provider);
        }
    }

    /**
     * {@inheritdoc}
     * @return ProviderInterface[]
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->providers);
    }

    /**
     * Add provider
     * @param AbstractProvider $provider
     */
    public function addProvider(AbstractProvider $provider)
    {
        $this->providers[] = $provider;
    }
}
