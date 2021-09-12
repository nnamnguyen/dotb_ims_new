<?php


class TemplatePricingFormula extends TemplateText{
    public $type = 'pricing-formula';
    public $ext1 = 'pricing_formula_dom';
    public $default_value = '';

    function get_field_def()
    {
        $def = parent::get_field_def();
        $def['options'] = !empty($this->options) ? $this->options : $this->ext1;
        $def['default'] = !empty($this->default) ? $this->default : $this->default_value;

        return $def;
    }
}
