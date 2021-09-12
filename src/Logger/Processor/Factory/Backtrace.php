<?php


namespace Dotbcrm\Dotbcrm\Logger\Processor\Factory;

use Dotbcrm\Dotbcrm\Logger\Processor\BacktraceProcessor;
use Dotbcrm\Dotbcrm\Logger\Processor\Factory;

/**
 * Backtrace processor factory
  */
class Backtrace implements Factory
{
    /** @inheritDoc */
    public function create(array $config)
    {
        return new BacktraceProcessor();
    }
}
