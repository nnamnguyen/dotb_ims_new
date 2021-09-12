<?php



$GLOBALS['studioDefs']['Tasks'] = array(
	'LBL_DETAILVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Tasks/DetailView.html',
				'php_file'=>'modules/Tasks/DetailView.php',
				'type'=>'DetailView',
				),
	'LBL_EDITVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Tasks/EditView.html',
				'php_file'=>'modules/Tasks/EditView.php',
				'type'=>'EditView',
				),
	'LBL_LISTVIEW'=>array(
				'template'=>'listview',
				'meta_file'=>'modules/Tasks/listviewdefs.php',
				'type'=>'ListView',
				),
	'LBL_SEARCHFORM'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Tasks/SearchForm.html',
				'php_file'=>'modules/Tasks/ListView.php',
				'type'=>'SearchForm',
				),

);
