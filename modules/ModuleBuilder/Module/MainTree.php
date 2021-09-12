<?php

class MainTree extends MBPackageTree{
    public function __construct()
    {
		$this->tree = new Tree('package_tree');
		$this->tree->id = 'package_tree';
		$this->mb = new StudioBrowser();
		$this->populateTree(array(), $this->tree);
	}
	
}
