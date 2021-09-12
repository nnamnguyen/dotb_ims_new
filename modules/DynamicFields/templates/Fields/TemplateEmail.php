<?php


class TemplateEmail extends TemplateText{
	var $massupdate = 1;
	function get_html_detail(){
		return '<a href="mailto:{'. strtoupper($this->name).'}">{'. strtoupper($this->name).'}</a>';	
	}
	
}


?>
