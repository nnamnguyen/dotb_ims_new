<?php


namespace Dotbcrm\Dotbcrm\Performance\Dbal;

use Doctrine\DBAL\Logging\SQLLogger;

/**
 * Logs queries for DotbXhprof class
 *
 * @see \DotbXHprof
 */
class XhprofLogger implements SQLLogger
{
    /**
     * Maximum length of the parameter value to dump
     * @var int
     */
    const MAX_PARAM_LENGTH = 100;

    /**
     * @var array
     */
    public $currentQuery;

    /**
     * @var float|null
     */
    protected $start = null;

    /**
     * @var SQLLogger
     */
    protected $logger;

    /**
     * @var \DotbXHprof
     */
    protected $xhprof;

    /**
     * @param \DotbXhprof $xhprof instance of DotbXhprof class
     * @param SQLLogger $logger instance of SQLLogger class
     */
    public function __construct(\DotbXHprof $xhprof)
    {
        $this->xhprof = $xhprof;
    }

    /**
     * {@inheritdoc}
     */
    public function startQuery($sql, array $params = null, array $types = null)
    {
        $this->start = microtime(true);
        $this->currentQuery = array('sql' => $sql, 'params' => $params, 'types' => $types);
    }

    /**
     * {@inheritdoc}
     */
    public function stopQuery()
    {
        $duration = microtime(true) - $this->start;

        $sql = $this->currentQuery['sql'] . ($this->currentQuery['params']
                ? (' with ' . $this->stringify($this->currentQuery['params']))
                : '');

        $this->xhprof->trackSQL($sql, $duration);

        $this->start = 0;
        $this->currentQuery = null;
    }

    /**
     * @param array $message Array to log
     *
     * @return string
     */
    protected function stringify(array $message)
    {
        return json_encode(
            array_map(
                function ($str) {
                    if (is_string($str) && (strlen($str) > self::MAX_PARAM_LENGTH)) {
                        $str = substr($str, 0, self::MAX_PARAM_LENGTH) . '...';
                    }
                    return $str;
                },
                $message
            )
        );
    }
}
