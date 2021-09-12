<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Adapter;

use Elastica\Document as BaseDocument;

/**
 *
 * Adapter class for \Elastica\Document
 *
 */
class Document extends BaseDocument
{
    /**
     * Check whether the document has data
     * @return boolean
     */
    public function hasData()
    {
        return (!empty($this->_data));
    }

    /**
     * Set data field value
     * @param string $field Field name
     * @param mixed $value
     */
    public function setDataField($field, $value)
    {
        $this->_data[$field] = $value;
    }

    /**
     * Remove data field
     * @param string $field
     */
    public function removeDataField($field)
    {
        if (isset($this->_data[$field])) {
            unset($this->_data[$field]);
        }
    }
}
