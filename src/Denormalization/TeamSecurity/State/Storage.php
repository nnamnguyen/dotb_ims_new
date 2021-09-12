<?php


namespace Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\State;

/**
 * Denormalization state storage
 */
interface Storage
{
    /**
     * Returns state variable
     *
     * @param string $var
     * @return mixed
     */
    public function get($var);

    /**
     * Updates state variable
     *
     * @param string $var
     * @param mixed $value
     * @return void
     */
    public function update($var, $value);
}
