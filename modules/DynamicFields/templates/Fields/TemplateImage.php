<?php

class TemplateImage extends TemplateText{
	var $type = 'image';	
		
	function get_field_def(){
		$def = parent::get_field_def();
		$def['studio'] = 'visible';		
		$def['type'] = 'image';
		$def['dbType'] = 'varchar';
		$def['len']= 255;
		
		if(	isset($this->ext1)	)	$def[ 'border' ] 	= $this->ext1 ;            
		if(	isset($this->ext2)	)	$def[ 'width' ] 	= $this->ext2 ;
		if(	isset($this->ext3)	)	$def[ 'height' ] 	= $this->ext3 ;
		if(	isset($this->border))	$def[ 'border' ] 	= $this->border ;          
	    if(	isset($this->width)	)	$def[ 'width' ] 	= $this->width ;
        if(	isset($this->height))	$def[ 'height' ] 	= $this->height ;
        
		return $def;	
	}
	
	public function __construct()
	{
		$this->vardef_map['border'] = 'ext1';
		$this->vardef_map['width'] = 'ext2';
		$this->vardef_map['height'] = 'ext3';		
	}
	
	function set($values){
	   parent::set($values);
	   if(!empty($this->ext1)){
	       $this->border = $this->ext1;
	   }
	   if(!empty($this->ext2)){
	       $this->width = $this->ext2;
	   }
	   if(!empty($this->ext3)){
	       $this->height = $this->ext3;
	   }
	   
	}
	
		
}


?>
