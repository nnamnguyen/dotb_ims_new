<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Provider\GlobalSearch\Handler;

use Dotbcrm\Dotbcrm\Elasticsearch\Adapter\Document;

/**
 *
 * Process Document Handler Interface
 *
 */
interface ProcessDocumentHandlerInterface extends HandlerInterface
{
    /**
     * Process document before indexing
     * @param Document $document
     * @param \DotbBean $bean
     */
    public function processDocumentPreIndex(Document $document, \DotbBean $bean);
}
