<?php


class TemplateText extends TemplateField
{
	var $type='varchar';

    /**
     * {@inheritDoc}
     */
    public $len = 255;

    var $supports_unified_search = true;

	function get_xtpl_edit(){
		$name = $this->name;
		$returnXTPL = array();
	
		if(!empty($this->help)){
		    $returnXTPL[strtoupper($this->name . '_help')] = translate($this->help, $this->bean->module_dir);
		}
	
		if(isset($this->bean->$name)){
		    $returnXTPL[$this->name] = $this->bean->$name;
		}else{
			if(empty($this->bean->id)){
				 $returnXTPL[$this->name] =  $this->default_value;	
			}	
		}
		return $returnXTPL;
	}

	function get_xtpl_search(){
		if(!empty($_REQUEST[$this->name])){
			return $_REQUEST[$this->name];
		}	
	}

	function get_xtpl_detail(){
		$name = $this->name;
		if(isset($this->bean->$name)){
			return $this->bean->$name;	
		}
		return '';
		
	}
}
