<?php


class TemplateCurrencyBaseRate extends TemplateDecimal
{
    public $len = 26;
    public $precision = 6;

    /**
     * return the field defs
     *
     * @return array
     */
    public function get_field_def()
    {
        $def = parent::get_field_def();
        $def['type'] = $this->type;
        $def['vname'] = 'LBL_CURRENCY_RATE';
        $def['label'] = 'LBL_CURRENCY_RATE';
        $def['studio'] = false;
        return $def;
    }

    /**
     * Save the field if one doesn't already exist
     *
     * @param DynamicField $df
     */
    public function save($df)
    {
        if (!$df->fieldExists($this->name)) {
            parent::save($df);
        }
    }

    /**
     * Delete the field is a currency field is no loner on the module
     *
     * @param DynamicField $df
     */
    public function delete($df)
    {
        if (!$df->fieldExists(null, 'currency')) {
            parent::delete($df);
        }
    }
}
