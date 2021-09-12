<?php


class TemplateEncrypt extends TemplateField
{
	var $type='encrypt';

    /**
     * {@inheritDoc}
     */
    public $len = 255;

	function save($df){
		$this->type = 'encrypt';
		$this->ext3 = 'varchar';
		parent::save($df);

	}

	function get_field_def(){
		$vardef = parent::get_field_def();
		$vardef['dbType'] = $this->ext3;
		return $vardef;
	}
}
