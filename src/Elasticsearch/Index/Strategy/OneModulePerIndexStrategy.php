<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Index\Strategy;

/**
 *
 * Use a static index for given module. For ES 6.x, it requires one index per module
 *
 *
 */
class OneModulePerIndexStrategy extends StaticStrategy
{
    /**
     * {@inheritdoc}
     */
    protected function getStaticIndex($module)
    {
        return strtolower($module);
    }
}
