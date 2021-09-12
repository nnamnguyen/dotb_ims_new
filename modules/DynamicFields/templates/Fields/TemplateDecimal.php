<?php


class TemplateDecimal extends TemplateFloat{
	var $type = 'decimal';
	var $default = null;
	var $default_value = null;
	
    public function __construct()
    {
    	parent::__construct();
	}

    function get_db_type()
	{
		if(empty($this->len)) {
			return parent::get_db_type();
		}
		$precision = (!empty($this->precision)) ? $this->precision : 6;
		return " ".sprintf($GLOBALS['db']->getColumnType("decimal_tpl"), $this->len, $precision); 
	}
}

