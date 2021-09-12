<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler;

/**
 *
 * Handler filter iterator
 *
 */
class HandlerFilterIterator extends \FilterIterator
{
    /**
     * @var string
     */
    protected $interface;

    /**
     * Ctor
     * @param HandlerCollection $collection
     * @param string $interface
     */
    public function __construct(\Iterator $collection, $interface)
    {
        $this->setInterface($interface);
        parent::__construct($collection);
    }

    /**
     * {@inheritdoc}
     */
    public function accept()
    {
        return in_array($this->interface, class_implements($this->current()));
    }

    /**
     * Set interface to filter by
     * @param string $interface
     */
    protected function setInterface($interface)
    {
        $this->interface = sprintf(
            'Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler\%sHandlerInterface',
            $interface
        );

        // ensure interface is valid
        if (!interface_exists($this->interface)) {
            throw new \LogicException("Handler interface '{$this->interface}' does not exist");
        }
    }
}
