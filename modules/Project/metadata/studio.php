<?php



$GLOBALS['studioDefs']['Project'] = array(
	'LBL_DETAILVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Project/DetailView.html',
				'php_file'=>'modules/Project/DetailView.php',
				'type'=>'DetailView',
				),
	'LBL_EDITVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Project/EditView.html',
				'php_file'=>'modules/Project/EditView.php',
				'type'=>'EditView',
				),
	'LBL_LISTVIEW'=>array(
				'template'=>'listview',
				'meta_file'=>'modules/Project/listviewdefs.php',
				'type'=>'ListView',
				),
	'LBL_SEARCHFORM'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Project/SearchForm.html',
				'php_file'=>'modules/Project/ListView.php',
				'type'=>'SearchForm',
				),

);
