<?php




/**
 * View iterator
 */
class ViewIterator
{
    /**
     * @var string The name of the module whose view is expected to be iterated over
     */
    protected $module;

    /**
     * @var array Field definitions of the module
     */
    protected $fieldDefs = array();

    /**
     * Constructor
     *
     * @param string $module Module name
     * @param array $fieldDefs Field definitions
     */
    public function __construct($module, array $fieldDefs)
    {
        $this->module = $module;
        $this->fieldDefs = $fieldDefs;
    }

    /**
     * Applies the given callback to every field of the view
     *
     * @param array $fieldSet Field set definition
     * @param callable $callback Callback to be applied
     */
    public function apply(array $fieldSet, /* callable */ $callback)
    {
        foreach ($fieldSet as $field) {
            if (is_string($field)) {
                $field = array('name' => $field);
            }

            if (is_array($field)) {
                $type = 'base';
                if (isset($field['name'])) {
                    if (isset($this->fieldDefs[$field['name']]['type'])) {
                        $type = $this->fieldDefs[$field['name']]['type'];
                    }
                }
                $this->getDotbField($type)->iterateViewField($this, $field, $callback);
            }
        }
    }

    /**
     * Returns implementation of Dotb Field for the given type
     *
     * @param string $type Field type
     * @return DotbFieldBase
     */
    protected function getDotbField($type)
    {
        $sf = DotbFieldHandler::getDotbField($type);
        $sf->setModule($this->module);

        return $sf;
    }
}
