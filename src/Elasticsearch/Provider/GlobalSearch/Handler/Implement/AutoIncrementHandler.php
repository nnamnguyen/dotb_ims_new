<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler\Implement;

use Dotbcrm\Dotbcrm\Elasticsearch\Adapter\Document;
use Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler\AbstractHandler;
use Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler\ProcessDocumentHandlerInterface;

/**
 *
 * Auto increment field handler
 *
 */
class AutoIncrementHandler extends AbstractHandler implements ProcessDocumentHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function processDocumentPreIndex(Document $document, \DotbBean $bean)
    {
        foreach ($this->getFtsAutoIncrementFields($bean->module_name) as $field) {
            if (!isset($bean->$field)) {
                $value = $this->retrieveFieldByQuery($bean, $field);
                if (!empty($value)) {
                    $document->setDataField($field, $value);
                }
            }
        }
    }

    /**
     * Retrieve the value of a given field from the database.
     * @param \DotbBean $bean
     * @param $fieldName The name of the field
     * @return $string
     */
    protected function retrieveFieldByQuery(\DotbBean $bean, $fieldName)
    {
        $sq = new \DotbQuery();
        $sq->select(array($fieldName));
        $sq->from($bean, array('team_security' => false));
        $sq->where()->equals("id", $bean->id);
        $result = $sq->execute();

        // expect only one record
        if (!empty($result)) {
            return $result[0][$fieldName];
        } else {
            return null;
        }
    }

    /**
     * Get auto increment fields for module.
     * @param string $module
     * @return array
     */
    protected function getFtsAutoIncrementFields($module)
    {
        return $this->provider->getContainer()->metaDataHelper->getFtsAutoIncrementFields($module);
    }
}
