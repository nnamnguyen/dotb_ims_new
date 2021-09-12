<?php


use Dotbcrm\Dotbcrm\ProcessManager;

/**
 * Class PMSEImporterFactory
 */
class PMSEImporterFactory
{
    /**
     * Get an instance of a PMSE Importer
     *
     * @param $type
     * @return \PMSEImporter
     */
    public static function getImporter(string $type = 'PMSEImporter')
    {
        if ($type === 'PMSEImporter') {
            return ProcessManager\Factory::getPMSEObject('PMSEImporter');
        }

        $type = self::formatImporterName($type);
        return ProcessManager\Factory::getPMSEObject($type . 'Importer');
    }

    /**
     * Convert from snake case to camel case
     *
     * @param string $name
     * @return string
     */
    private static function formatImporterName(string $name)
    {
        return str_replace('_', '', ucwords($name, '_'));
    }
}
