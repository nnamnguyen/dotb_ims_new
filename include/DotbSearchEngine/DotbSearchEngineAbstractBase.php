<?php


/**
 * Base class for search engine drivers
 *
 *                      !!! DEPRECATION WARNING !!!
 *
 * All code in include/DotbSearchEngine is going to be deprecated in a future
 * release. Do not use any of its APIs for code customizations as there will be
 * no guarantee of support and/or functionality for it. Use the new framework
 * located in the directories src/SearchEngine and src/Elasticsearch.
 *
 * @deprecated
 */
abstract class DotbSearchEngineAbstractBase implements DotbSearchEngineInterface
{
    /**
     * Logger to use to report problems
     * @var LoggerManager
     */
    public $logger;

    /**
     * Ctor
     */
    public function __construct(LoggerManager $logger = null)
    {
        $this->logger = $logger ?: LoggerManager::getLogger();
    }

    /**
     * This function checks config to see if search engine is down.
     *
     * @return Boolean
     */
    public static function isSearchEngineDown()
    {
        $settings = Administration::getSettings();
        if (!empty($settings->settings['info_fts_down'])) {
            return true;
        }
        return false;
    }

    /**
     * This function marks config to indicate that search engine is up or down.
     *
     * @param Boolean $isDown
     */
    public static function markSearchEngineStatus($isDown = true)
    {
        $admin = BeanFactory::newBean('Administration');
        $admin->saveSetting('info', 'fts_down', $isDown? 1: 0);
    }
}
