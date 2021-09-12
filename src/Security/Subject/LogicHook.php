<?php


namespace Dotbcrm\Dotbcrm\Security\Subject;

use Dotbcrm\Dotbcrm\Security\Subject;

/**
 * A logic hook making changes
 */
final class LogicHook implements Subject
{
    /**
     * @var string
     */
    private $class;

    /**
     * @var string
     */
    private $method;

    /**
     * Constructor
     *
     * @param string $class
     * @param string $method
     */
    public function __construct($class, $method)
    {
        $this->class = $class;
        $this->method = $method;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        return [
            '_type' => 'logic-hook',
            'class' => $this->class,
            'method' => $this->method,
        ];
    }
}
