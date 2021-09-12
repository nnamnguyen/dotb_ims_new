<?php

class TemplateIFrame extends TemplateURL{
	var $type='iframe';
	
function get_html_edit(){
        $this->prepare();
        return "<input type='text' name='". $this->name. "' id='".$this->name."' size='".$this->size."' title='{" . strtoupper($this->name) ."_HELP}' value='{". strtoupper($this->name). "}'>";
    }
	
	function get_html_label() {
		return "LALALALA";
	}
	
	function get_xtpl_detail(){
        $value = parent::get_xtpl_detail();
        $value .= "BLAH BLAH";
        return $value;
    }
    
	function get_field_def(){
		$def = parent::get_field_def();
		$def['height'] = !empty($this->height) ? $this->height : $this->ext4;
		return $def;	
	} 

}
?>
