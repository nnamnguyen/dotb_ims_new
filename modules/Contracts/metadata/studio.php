<?php



$GLOBALS['studioDefs']['Contracts'] = array(
	'LBL_DETAILVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Contracts/DetailView.html',
				'php_file'=>'modules/Contracts/DetailView.php',
				'type'=>'DetailView',
				),
	'LBL_EDITVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Contracts/EditView.html',
				'php_file'=>'modules/Contracts/EditView.php',
				'type'=>'EditView',
				),
	'LBL_LISTVIEW'=>array(
				'template'=>'listview',
				'meta_file'=>'modules/Contracts/listviewdefs.php',
				'type'=>'ListView',
				),
	'LBL_SEARCHFORM'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Contracts/SearchForm.html',
				'php_file'=>'modules/Contracts/ListView.php',
				'type'=>'SearchForm',
				),

);
