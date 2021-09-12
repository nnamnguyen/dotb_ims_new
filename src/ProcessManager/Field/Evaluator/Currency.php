<?php


namespace Dotbcrm\Dotbcrm\ProcessManager\Field\Evaluator;

/**
 * Currency evaluator object.
 * @package ProcessManager
 */
class Currency extends Base implements EvaluatorInterface
{
    /**
     * The currency ID field that is on the bean and in the data
     * @var string
     */
    protected $idField = 'currency_id';

    /**
     * @inheritDoc
     */
    public function hasChanged()
    {
        if ($this->isCheckable()) {
            // To check change on a Currency field we check both the values of
            // the bean and data AND the currency_id on the bean and in the data
            return $this->valueHasChanged() || $this->idHasChanged();
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    protected function isCheckable()
    {
        return parent::isCheckable()
               && isset($this->data[$this->idField]) && isset($this->bean->{$this->idField});
    }

    /**
     * Checks if the value of the currency field has changed
     * @return boolean
     */
    protected function valueHasChanged()
    {
        return $this->data[$this->name] !== $this->bean->{$this->name};
    }

    /**
     * Checks if the currency_id has changed
     * @return boolean
     */
    protected function idHasChanged()
    {
        return $this->data[$this->idField] !== $this->bean->{$this->idField};
    }
}
