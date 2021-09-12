<?php



$GLOBALS['studioDefs']['Cases'] = array(
	'LBL_DETAILVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Cases/DetailView.html',
				'php_file'=>'modules/Cases/DetailView.php',
				'type'=>'DetailView',
				),
	'LBL_EDITVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Cases/EditView.html',
				'php_file'=>'modules/Cases/EditView.php',
				'type'=>'EditView',
				),
	'LBL_LISTVIEW'=>array(
				'template'=>'listview',
				'meta_file'=>'modules/Cases/listviewdefs.php',
				'type'=>'ListView',
				),
	'LBL_SEARCHFORM'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Cases/SearchForm.html',
				'php_file'=>'modules/Cases/ListView.php',
				'type'=>'SearchForm',
				),

);
