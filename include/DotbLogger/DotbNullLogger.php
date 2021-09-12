<?php



/**
 * Null logger, used for slim entry points that run from preDispatch.php
 * @api
 */
class DotbNullLogger
{
    /**
     * Overloaded method that ignores the log request
     *
     * @param string $method
     * @param string $message
     */
    public function __call($method, $message)
    {
    }
}

