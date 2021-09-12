<?php


/**
 * Implementation by DotbCRM, not shipped by ZF.
 *
 */

/**
 * @see Zend_Gdata_Feed
 */
require_once 'vendor/Zend/Gdata/Feed.php';


class Zend_Gdata_Contacts_ListFeed extends Zend_Gdata_Feed
{

    /**
     * The classname for individual feed elements.
     *
     * @var string
     */
    protected $_entryClassName = 'Zend_Gdata_Contacts_ListEntry';

    /**
     * The classname for the feed.
     *
     * @var string
     */
    protected $_feedClassName = 'Zend_Gdata_Contacts_ListFeed';

    public function __construct($element = null)
    {
        $this->registerAllNamespaces(Zend_Gdata_Contacts::$namespaces);
        parent::__construct($element);
    }
}
