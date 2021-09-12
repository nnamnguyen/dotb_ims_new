<?php



class TemplateCurrencyId extends TemplateId
{
    public $max_size = 25;
    public $type = 'currency_id';

    public function get_field_def()
    {
        $def = parent::get_field_def();
        $def['type'] = $this->type;
        $def['vname'] = 'LBL_CURRENCY_ID';
        $def['dbType'] = 'id';
        $def['studio'] = false;
        $def['function'] = 'getCurrencies';
        $def['function_bean'] = 'Currencies';
        return $def;
    }

    public function save($df)
    {
        if (!$df->fieldExists($this->name)) {
            parent::save($df);
        }
    }

    public function delete($df)
    {
        if (!$df->fieldExists(null, 'currency')) {
            parent::delete($df);
        }
    }
}
