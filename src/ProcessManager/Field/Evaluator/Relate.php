<?php


namespace Dotbcrm\Dotbcrm\ProcessManager\Field\Evaluator;

/**
 * Relate field evaluator object.
 * @package ProcessManager
 */
class Relate extends Base implements EvaluatorInterface
{
    /**
     * The actual field on the bean and in the data that contains the values we
     * are evaluating
     * @var string
     */
    protected $namedField;

    /**
     * The key in the field def for this field that will map to the proper field
     * that contains the data we are looking for.
     * @var string
     */
    protected $namedFieldKey = 'id_name';

    /**
     * @inheritDoc
     */
    public function init(\DotbBean $bean, $name, array $data)
    {
        parent::init($bean, $name, $data);

        // For relate fields, we need to set some other stuff
        if (isset($bean->field_defs[$name][$this->namedFieldKey])) {
            $this->namedField = $bean->field_defs[$name][$this->namedFieldKey];
        }
    }

    /**
     * @inheritDoc
     */
    public function hasChanged()
    {
        if ($this->isCheckable()) {
            // Relate fields are set up a little different, in that the relate
            // field defs have an id_name property that maps to the field that
            // contains the actual data of the relate field. This comparison is
            // done on THAT field.
            return $this->data[$this->namedField] !== $this->bean->{$this->namedField};
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    protected function isCheckable()
    {
        return isset($this->data[$this->namedField]) && isset($this->bean->{$this->namedField});
    }
}
