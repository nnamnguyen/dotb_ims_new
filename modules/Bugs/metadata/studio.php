<?php



$GLOBALS['studioDefs']['Bugs'] = array(
	'LBL_DETAILVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Bugs/DetailView.html',
				'php_file'=>'modules/Bugs/DetailView.php',
				'type'=>'DetailView',
				),
	'LBL_EDITVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Bugs/EditView.html',
				'php_file'=>'modules/Bugs/EditView.php',
				'type'=>'EditView',
				),
	'LBL_LISTVIEW'=>array(
				'template'=>'listview',
				'meta_file'=>'modules/Bugs/listviewdefs.php',
				'type'=>'ListView',
				),
	'LBL_SEARCHFORM'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Bugs/SearchForm.html',
				'php_file'=>'modules/Bugs/ListView.php',
				'type'=>'SearchForm',
				),

);
