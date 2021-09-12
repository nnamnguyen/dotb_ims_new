<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler\Implement;

use Dotbcrm\Dotbcrm\Elasticsearch\Adapter\Document;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Mapping;
use Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler\AbstractHandler;
use Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler\MappingHandlerInterface;
use Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler\ProcessDocumentHandlerInterface;
use Dotbcrm\Dotbcrm\Elasticsearch\Mapping\Property\MultiFieldProperty;

/**
 *
 * Tags handler
 *
 */
class TagsHandler extends AbstractHandler implements
    MappingHandlerInterface,
    ProcessDocumentHandlerInterface
{
    /**
     * Field name to use for tag Ids
     * @var string
     */
    const TAGS_FIELD = 'tags';

    /**
     * @var \Tag
     */
    protected $tagSeed;

    /**
     * {@inheritdoc}
     */
    public function processDocumentPreIndex(Document $document, \DotbBean $bean)
    {
        $document->setDataField(self::TAGS_FIELD, $this->retrieveTagIds($bean));
    }

    /**
     * Retrieve the value of a given field from the database.
     * @param string $beanId the id of the associated bean
     * @return array
     */
    protected function retrieveTagIds(\DotbBean $bean)
    {
        if (isset($bean->fetchedFtsData['tags'])) {
            // already retrieved tags
            return $bean->fetchedFtsData['tags'];
        }

        // setup seed bean once
        if (empty($this->tagSeed)) {
            $this->tagSeed = \BeanFactory::newBean("Tags");
        }

        return $this->tagSeed->getTagIdsByBean($bean);

    }

    /**
     * {@inheritdoc}
     */
    public function buildMapping(Mapping $mapping, $field, array $defs)
    {
        // We only handle 'tag' fields of 'tag' type
        if ($defs['name'] !== 'tag' || $defs['type'] !== 'tag') {
            return;
        }

        // we just need an not_analyzed field here
        $property = new MultiFieldProperty();
        $property->setType('keyword');
        $mapping->addCommonField(self::TAGS_FIELD, 'tags', $property);
    }
}
