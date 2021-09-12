<?php





/**
 * Collection of beans from multiple modules
 */
class ModuleCollectionDefinition extends AbstractCollectionDefinition
{
    /**
     * The key in collection definition that identifies sources
     *
     * @var string
     */
    protected static $sourcesKey = 'modules';

    /** {@inheritDoc} */
    public function getSourceModuleName($source)
    {
        return $source;
    }

    /** {@inheritDoc} */
    protected function loadDefinition()
    {
        global $dictionary;

        self::loadDictionary();
        if (!isset($dictionary['collections'][$this->name]) || !is_array($dictionary['collections'][$this->name])) {
            throw new DotbApiExceptionNotFound('Collection not found');
        }

        return $dictionary['collections'][$this->name];
    }

    /**
     * Loads collection definitions into global dictionary
     */
    protected static function loadDictionary()
    {
        global $dictionary;
        static $loaded = false;

        if (!$loaded) {
            require 'modules/CollectionDictionary.php';
        }
    }
}
