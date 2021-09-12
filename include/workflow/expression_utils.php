<?php



function get_expression($express_type, $first, $second){
	
	if($express_type=="+"){
		return express_add($first, $second);
	}	
	if($express_type=="-"){
		return express_subtract($first, $second);
	}		
	if($express_type=="*"){
		return express_multiple($first, $second);
	}		
	if($express_type=="/"){
		return express_divide($first, $second);
	}			
//end function get_expression
}

function express_add($first, $second){
	return $first + $second;
}	

function express_subtract($first, $second){
	return $first - $second;
}

function express_multiple($first, $second){
	return $first * $second;
}

function express_divide($first, $second){
	return $first / $second;
}



?>
