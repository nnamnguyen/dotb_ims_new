<?php


namespace Dotbcrm\Dotbcrm\DependencyInjection\Exception;

use Psr\Container\ContainerExceptionInterface;

/**
 * Designates unavailability of a service, e.g. due to unmet runtime dependencies
 */
class ServiceUnavailable extends \RuntimeException implements ContainerExceptionInterface
{
}
