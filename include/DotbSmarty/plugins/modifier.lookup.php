<?php




function smarty_modifier_lookup($value='', $from=array()){
	$value = trim($value);
	if (array_key_exists($value, $from)) { 
		return $from[$value]; 
	} 
	return ''; 
} 
