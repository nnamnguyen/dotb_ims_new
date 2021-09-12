<?php




class DotbFieldDownload extends DotbFieldBase {
   
	function getDetailViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex) {
      
        $vardef['value'] = urlencode(basename($vardef['value']));
        $this->setup($parentFieldArray, $vardef, $displayParams, $tabindex);
        return $this->fetch($this->findTemplate('DetailView.tpl'));
    }
}
