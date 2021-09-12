<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\Visibility;

/**
 *
 * Visibility strategy collection
 *
 */
class StrategyCollection extends \SplObjectStorage
{
    /**
     * {@inheritdoc}
     * @param \DotbVisibility $strategy
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getHash($strategy)
    {
        if (!$strategy instanceof \DotbVisibility) {
            throw new \InvalidArgumentException('\DotbVisibility class expected');
        }
        return get_class($strategy);
    }

    /**
     * Add strategies for given modules
     * @param array $modules
     */
    public function addModuleStrategies(array $modules)
    {
        foreach ($modules as $module) {
            $this->addBeanStrategies(\BeanFactory::newBean($module));
        }
    }

    /**
     * Add strategies from given bean
     * @param \DotbBean $bean
     */
    public function addBeanStrategies(\DotbBean $bean)
    {
        foreach ($bean->loadVisibility()->getStrategies() as $strategy) {
            $this->addStrategy($strategy);
        }
    }

    /**
     * Attach visibility strategy object
     * @param \DotbVisibility $strategy
     */
    public function addStrategy(\DotbVisibility $strategy)
    {
        if ($strategy instanceof StrategyInterface) {
            $this->attach($strategy);
        }
    }
}
