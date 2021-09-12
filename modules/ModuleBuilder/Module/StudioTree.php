<?php

class StudioTree extends MBPackageTree{
    public function __construct()
    {
		$this->tree = new Tree('package_tree');
		$this->tree->id = 'package_tree';
		$this->mb = new StudioBrowser();
		$this->populateTree($this->mb->getNodes(), $this->tree);
	}
	
	function getName(){
		return translate('LBL_SECTION_MODULES');
	}
	
}
