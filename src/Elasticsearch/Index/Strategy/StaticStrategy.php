<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Index\Strategy;

/**
 *
 * Use a static index for given module. Index names can be overriden
 * through `$dotb_config`. If none given, we default to the name "shared".
 *
 * Example configuration:
 *
 * $dotb_config['full_text_engine']['Elastic']['index_strategy']['Accounts'] = array(
 *      'strategy' => 'static',
 *      'index' => 'index_name_goes_here',
 * );
 *
 */
class StaticStrategy extends AbstractStrategy
{
    const DEFAULT_INDEX = 'shared';

    /**
     * {@inheritdoc}
     */
    public function getManagedIndices($module)
    {
        return array($this->getStaticIndex($module));
    }

    /**
     * {@inheritdoc}
     */
    public function getReadIndices($module, array $context = array())
    {
        return array($this->getStaticIndex($module));
    }
    /**
     * {@inheritdoc}
     */
    public function getWriteIndex($module, array $context = array())
    {
        return $this->getStaticIndex($module);
    }

    /**
     * Return static index configuration for given module
     * @param string $module
     * @return array
     */
    protected function getStaticIndex($module)
    {
        return $this->getModuleConfig($module, 'index', self::DEFAULT_INDEX);
    }
}
