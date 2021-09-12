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
 * Favorites handler
 *
 */
class FavoritesHandler extends AbstractHandler implements
    MappingHandlerInterface,
    ProcessDocumentHandlerInterface
{
    /**
     * Favorites field used in index
     */
    const FAVORITE_FIELD = 'user_favorites';

    /**
     * {@inheritdoc}
     */
    public function buildMapping(Mapping $mapping, $field, array $defs)
    {
        if ($defs['type'] !== 'favorites') {
            return;
        }

        // common field for denormalized ids
        $property = new MultiFieldProperty();
        $property->setType('keyword');
        $mapping->addCommonField(self::FAVORITE_FIELD, 'agg', $property);
    }

    /**
     * {@inheritdoc}
     */
    public function processDocumentPreIndex(Document $document, \DotbBean $bean)
    {
        if (isset($bean->my_favorite)) {
            $document->setDataField(self::FAVORITE_FIELD, $this->getFavorites($bean));
        }
    }

    /**
     *
     * @param \DotbBean $bean
     * @return array
     */
    protected function getFavorites(\DotbBean $bean)
    {
        if (isset($bean->fetchedFtsData['user_favorites'])) {
            return $bean->fetchedFtsData['user_favorites'];
        }
        return \DotbFavorites::getUserIdsForFavoriteRecordByModuleRecord($bean->module_dir, $bean->id);
    }
}
