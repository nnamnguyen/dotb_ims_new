<?php


class TemplateParentType extends TemplateText{
    var $max_size = 25;
    var $type='parent_type';
    
    function get_field_def(){
		$def = parent::get_field_def();
		$def['dbType'] = 'varchar';
		$def['studio'] = 'hidden';
        // FIXME this is to match default flex relates vardefs. We need to document the rules.
        $def['group'] = 'parent_name';
		return $def;	
	}

}


?>
