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
class HtmlHandler extends AbstractHandler implements ProcessDocumentHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function processDocumentPreIndex(Document $document, \DotbBean $bean)
    {
        foreach ($this->getFtsHtmlFields($bean->module_name) as $field) {
            if (isset($bean->$field)) {
                //$bean->$field contains the encoded html entities, e.g., "&lt;p&gt;To connect
                //your device to the Internet, use any application that accesses the Internet. &lt;/p&gt;"
                $value = html_entity_decode($bean->$field);

                //Html fields are stored including Html tags in database, which will be stripped
                //before sending over to Elastic
                $value = strip_tags($value);
                $document->setDataField($field, $value);
            }
        }
    }

    /**
     * Get HTML fields for module.
     * @param string $module
     * @return array
     */
    protected function getFtsHtmlFields($module)
    {
        return $this->provider->getContainer()->metaDataHelper->getFtsHtmlFields($module);
    }
}
