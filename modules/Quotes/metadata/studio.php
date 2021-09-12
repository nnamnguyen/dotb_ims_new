<?php



$GLOBALS['studioDefs']['Quotes'] = array(
	'LBL_DETAILVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Quotes/DetailView.html',
				'php_file'=>'modules/Quotes/DetailView.php',
				'type'=>'DetailView',
				),
	'LBL_EDITVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Quotes/EditView.html',
				'php_file'=>'modules/Quotes/EditView.php',
				'type'=>'EditView',
				),
	'LBL_LISTVIEW'=>array(
				'template'=>'listview',
				'meta_file'=>'modules/Quotes/listviewdefs.php',
				'type'=>'ListView',
				),
	'LBL_SEARCHFORM'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Quotes/SearchForm.html',
				'php_file'=>'modules/Quotes/ListView.php',
				'type'=>'SearchForm',
				),

);
