<?php


namespace Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\State\Storage;

use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\State\Storage;

/**
 * In-memory implementation of the state storage for behavior testing purposes
 */
final class InMemoryStorage implements Storage
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * {@inheritDoc}
     */
    public function get($var)
    {
        if (isset($this->data[$var])) {
            return $this->data[$var];
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function update($var, $value)
    {
        $this->data[$var] = $value;
    }
}
