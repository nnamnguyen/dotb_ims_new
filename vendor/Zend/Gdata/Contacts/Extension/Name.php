<?php



require_once 'vendor/Zend/Gdata/Extension.php';


class Zend_Gdata_Contacts_Extension_Name extends Zend_Gdata_Extension
{

    protected $_rootNamespace = 'gd';
    protected $_rootElement = 'name';
    protected $_names = array('first_name' => '', 'last_name' => '', 'full_name' => '');
    /**
     * Constructs a new Zend_Gdata_Contacts_Extension_Name object.
     * @param string $value (optional) The text content of the element.
     */
    public function __construct($value = null)
    {
        $this->registerAllNamespaces(Zend_Gdata_Contacts::$namespaces);
        parent::__construct();
    }

    protected function takeChildFromDOM($child)
    {
        $absoluteNodeName = $child->namespaceURI . ':' . $child->localName;
        switch ($absoluteNodeName)
        {
            case $this->lookupNamespace('gd') . ':' . 'fullName';
                $entry = new Zend_Gdata_Entry();
                $entry->transferFromDOM($child);
                $this->_names['full_name'] = $entry->getText();
                break;

            case $this->lookupNamespace('gd') . ':' . 'givenName';
                $entry = new Zend_Gdata_Entry();
                $entry->transferFromDOM($child);
                $this->_names['first_name'] = $entry->getText();
                break;

             case $this->lookupNamespace('gd') . ':' . 'familyName';
                $entry = new Zend_Gdata_Entry();
                $entry->transferFromDOM($child);
                $this->_names['last_name'] = $entry->getText();
                break;
            default:
                parent::takeChildFromDOM($child);
                break;
        }
    }

    public function toArray()
    {
        return $this->_names;
    }
}
 
