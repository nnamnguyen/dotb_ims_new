<?php




class DotbFieldHtml extends DotbFieldBase {
   
    function getDetailViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex){
        $vardef['value'] = $this->getVardefValue($vardef);
        
        $this->setup($parentFieldArray, $vardef, $displayParams, $tabindex);
        return $this->fetch($this->findTemplate('DetailView'));
    }
    
    function getEditViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex){
    	$vardef['value'] = $this->getVardefValue($vardef);
				
        $this->setup($parentFieldArray, $vardef, $displayParams, $tabindex);
        return $this->fetch($this->findTemplate('DetailView'));
    }
    
	function getSearchViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex) {
		$vardef['value'] = $this->getVardefValue($vardef);
				
        $this->setup($parentFieldArray, $vardef, $displayParams, $tabindex);
        return $this->fetch($this->findTemplate('DetailView'));    
    }
    
    function getVardefValue($vardef){
        if(empty($vardef['value'])){
            if(!empty($vardef['default']))
                return from_html($vardef['default']);
            elseif(!empty($vardef['default_value']))
                return from_html($vardef['default_value']);
        } else {
            return from_html($vardef['value']);
        }
    }

    /**
     * Normalizes a default value
     *
     * @param mixed $value The value to normalize
     * @return string
     */
    public function normalizeDefaultValue($value) {
        return htmlspecialchars_decode($value, ENT_QUOTES);
    }
}
