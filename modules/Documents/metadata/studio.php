<?php



$GLOBALS['studioDefs']['Documents'] = array(
	'LBL_DETAILVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Documents/DetailView.html',
				'php_file'=>'modules/Documents/DetailView.php',
				'type'=>'DetailView',
				),
	'LBL_EDITVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Documents/EditView.html',
				'php_file'=>'modules/Documents/EditView.php',
				'type'=>'EditView',
				),
	'LBL_LISTVIEW'=>array(
				'template'=>'listview',
				'meta_file'=>'modules/Documents/listviewdefs.php',
				'type'=>'ListView',
				),
	'LBL_SEARCHFORM'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Documents/SearchForm.html',
				'php_file'=>'modules/Documents/ListView.php',
				'type'=>'SearchForm',
				),

);
