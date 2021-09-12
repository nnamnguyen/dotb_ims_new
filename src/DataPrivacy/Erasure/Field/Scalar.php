<?php declare(strict_types=1);


namespace Dotbcrm\Dotbcrm\DataPrivacy\Erasure\Field;

use DotbBean;
use Dotbcrm\Dotbcrm\DataPrivacy\Erasure\Field;

/**
 * Represents a scalar field stored on the bean itself
 */
final class Scalar implements Field
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name The field name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function erase(DotbBean $bean) : void
    {
        $bean->{$this->name} = null;
    }
}
