<?php


/**
 * Search Engines drivers factory class
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
class DotbSearchEngineFactory
{
    /**
     * @var DotbSearchEngineInterface
     */
    public static $_instance;

    /**
     * Singleton pattern
     */
    private function __construct(){}

    /**
     * getInstance()
     *
     * Connect to the backend engine and store for later use
     *
     * @static
     * @return DotbSearchEngineInterface
     */
    public static function getInstance($name = '', $config = array(), $useDefaultWhenFTSDown = false)
    {
        if ($useDefaultWhenFTSDown && DotbSearchEngineAbstractBase::isSearchEngineDown())
        {
            $name = 'DotbSearchEngine';
        }

       if (!isset(self::$_instance[$name]))
       {
           self::$_instance[$name] = self::setupEngine($name, $config);
       }

       return self::$_instance[$name];
    }

    public static function getFTSEngineNameFromConfig()
    {
        $name = "";
        if(isset($GLOBALS['dotb_config']['full_text_engine']) &&
           is_array($GLOBALS['dotb_config']['full_text_engine']))
        {
            $keys = array_keys($GLOBALS['dotb_config']['full_text_engine']);
            $name = array_pop($keys);
        }
        return $name;
    }
    /**
     * @static
     * @param string $name
     * @param array $config
     * @return mixed (bool|DotbSearchEngineInterface)
     */
    protected static function setupEngine($name = '', $config = array())
    {
        // if name is empty set name and config
        if(empty($name) && !empty($GLOBALS['dotb_config']['full_text_engine'])) {
            $name = self::getFTSEngineNameFromConfig();
            $config = $GLOBALS['dotb_config']['full_text_engine'][$name];
        }

        // if config is empty set config
        if(empty($config) && !empty($GLOBALS['dotb_config']['full_text_engine'][$name])) {
            $config = $GLOBALS['dotb_config']['full_text_engine'][$name];
        }

        $paths = array(
            "include/DotbSearchEngine/{$name}/DotbSearchEngine{$name}.php" => $name,
            // fallback to base engine if unknown engine name
            "include/DotbSearchEngine/DotbSearchEngine.php" => '',
        );

        // object loader using custom override
        foreach ($paths as $path => $baseClass) {
            if (DotbAutoLoader::requireWithCustom($path, true)) {
                $engineClass = DotbAutoLoader::customClass("DotbSearchEngine{$baseClass}");
                $engineInstance = new $engineClass($config);
                if ($engineInstance instanceof DotbSearchEngineInterface) {
                    $GLOBALS['log']->info("Found Dotb Search Engine: " . get_class($engineInstance));
                    return $engineInstance;
                }
            }
        }
        return false;
    }
}
