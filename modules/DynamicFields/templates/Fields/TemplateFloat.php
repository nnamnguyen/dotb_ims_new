<?php


class TemplateFloat extends TemplateRange
{
    var $type = 'float';
    var $default = null;
    var $default_value = null;
    var $len = '18';
    var $precision = '8';

    public function __construct()
    {
        parent::__construct();
        $this->vardef_map['precision']='ext1';
        //$this->vardef_map['precision']='precision';
    }

    function get_field_def(){
        $def = parent::get_field_def();
        $def['precision'] = isset($this->ext1) && is_numeric($this->ext1) ? (int)$this->ext1 : $this->precision;
        return $def;
    }

    function get_db_type(){
        $precision = (!empty($this->precision))? $this->precision: 8;
        if(empty($this->len)) {
            return parent::get_db_type();
        }
        return " ".sprintf($GLOBALS['db']->getColumnType("decimal_tpl"), $this->len, $precision); 
    }

}
