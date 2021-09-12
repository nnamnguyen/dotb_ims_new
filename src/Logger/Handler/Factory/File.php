<?php


namespace Dotbcrm\Dotbcrm\Logger\Handler\Factory;

use Monolog\Handler\StreamHandler;
use Dotbcrm\Dotbcrm\Logger\Formatter\BackwardCompatibleFormatter;
use Dotbcrm\Dotbcrm\Logger\Handler\Factory;

/**
 * File handler factory
 */
class File implements Factory
{
    /**
     * Default configuration for file handler
     *
     * @var array
     */
    protected static $defaults = array(
        'dir' => '.',
        'name' => 'dotbcrm',
        'ext' => 'log',
        'suffix' => '',
        'dateFormat' => '%c',
    );

    /**
     * {@inheritDoc}
     *
     * Creates file handler
     */
    public function create($level, array $config)
    {
        $config = array_merge(self::$defaults, $config);

        $path = $this->getFilePath($config['dir'], $config['name'], $config['ext'], $config['suffix']);
        $handler = new StreamHandler($path, $level);

        $formatter = new BackwardCompatibleFormatter($config['dateFormat']);
        $handler->setFormatter($formatter);

        return $handler;
    }

    /**
     * Returns log file path
     *
     * @param string $dir Log directory
     * @param string $name File name
     * @param string $ext File extension
     * @param string $suffix File suffix
     * @return string
     */
    protected function getFilePath($dir, $name, $ext, $suffix)
    {
        $dir = rtrim($dir, '/');
        $ext = ltrim($ext, '.');
        $path = $dir . '/' . $name;

        if ($suffix && $this->isFileNameSuffixValid($suffix)) {
            // if the global config contains date-format suffix, it will create suffix by parsing datetime
            $path .= '_' . date(str_replace('%', '', $suffix));
        }

        if ($ext) {
            $path .= '.' . $ext;
        }

        return $path;
    }

    /**
     * Checks if the filename suffix is valid
     *
     * @param string $suffix Filename suffix
     * @return string
     */
    protected function isFileNameSuffixValid($suffix)
    {
        return isset(\DotbLogger::$filename_suffix[$suffix]);
    }
}
