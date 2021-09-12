<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler\Implement;

use Dotbcrm\Dotbcrm\DataPrivacy\Erasure\Repository;
use Dotbcrm\Dotbcrm\DependencyInjection\Container;
use Dotbcrm\Dotbcrm\Elasticsearch\Adapter\Document;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Mapping;
use Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\GlobalSearch;
use Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler\AbstractHandler;
use Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler\MappingHandlerInterface;
use Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler\ProcessDocumentHandlerInterface;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Property\MultiFieldProperty;

/**
 *
 * ErasedFields handler
 *
 */
class ErasedFieldsHandler extends AbstractHandler implements
    MappingHandlerInterface,
    ProcessDocumentHandlerInterface
{
    /**
     * Field name
     * @var string
     */
    const ERASEDFIELDS_FIELD = 'erased_fields';

    /**
     * {@inheritdoc}
     */
    public function processDocumentPreIndex(Document $document, \DotbBean $bean)
    {
        $document->setDataField(self::ERASEDFIELDS_FIELD, $this->retrieveErasedFields($bean));
    }

    /**
     * Retrieve the value of a given field from the database.
     * @param \DotbBean $bean, associated bean
     * @return array
     */
    protected function retrieveErasedFields(\DotbBean $bean)
    {
        if (isset($bean->erased_fields)) {
            return json_encode($bean->erased_fields);
        } else {
            return json_encode($this->getErasedFieldsRepository()->getBeanFields($bean->table_name, $bean->id));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function buildMapping(Mapping $mapping, $field, array $defs)
    {
        // create a new field named as 'erased_fields' for this module
        if (!$mapping->hasProperty(self::ERASEDFIELDS_FIELD)) {
            $property = new MultiFieldProperty();
            $property->setType('keyword');
            $mapping->addCommonField(self::ERASEDFIELDS_FIELD, self::ERASEDFIELDS_FIELD, $property);
        }
    }

    /**
     *
     * @return Repository
     */
    protected function getErasedFieldsRepository()
    {
        return Container::getInstance()->get(Repository::class);
    }
}
