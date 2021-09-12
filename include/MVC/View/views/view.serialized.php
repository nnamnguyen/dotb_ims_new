<?php



class ViewSerialized extends DotbView{
	var $type ='detail';

	function display(){
		ob_clean();
		echo serialize($this->bean->toArray());
		dotb_cleanup(true);
 	}
}

