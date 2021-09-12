<?php




class DotbFieldReadonly extends DotbFieldBase {
    function getEditViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex) {
    	return $this->getDetailViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex);
    }
    
}
