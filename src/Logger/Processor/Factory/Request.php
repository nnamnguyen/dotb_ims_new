<?php


namespace Dotbcrm\Dotbcrm\Logger\Processor\Factory;

use Dotbcrm\Dotbcrm\Logger\Processor\RequestProcessor;
use Dotbcrm\Dotbcrm\Logger\Processor\Factory;

/**
 * Request processor factory
  */
class Request implements Factory
{
    /** @inheritDoc */
    public function create(array $config)
    {
        return new RequestProcessor();
    }
}
