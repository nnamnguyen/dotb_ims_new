<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler;

use Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\GlobalSearch;
use ReflectionClass;

/**
 *
 * Abstract Handler
 *
 */
abstract class AbstractHandler implements HandlerInterface
{
    /**
     * @var GlobalSearch
     */
    protected $provider;

    /**
     * {@inheritdoc}
     */
    public function setProvider(GlobalSearch $provider)
    {
        $this->provider = $provider;
    }

    /**
     * {@inheritdoc}
     *
     * Use the class basename as name/identifier. If needed this can be
     * overruled in the implementing handler class.
     */
    public function getName()
    {
        $ref = new ReflectionClass($this);
        return $ref->getShortName();
    }
}
