<?php



$GLOBALS['studioDefs']['Products'] = array(
	'LBL_DETAILVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Products/DetailView.html',
				'php_file'=>'modules/Products/DetailView.php',
				'type'=>'DetailView',
				),
	'LBL_EDITVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Products/EditView.html',
				'php_file'=>'modules/Products/EditView.php',
				'type'=>'EditView',
				),
	'LBL_LISTVIEW'=>array(
				'template'=>'listview',
				'meta_file'=>'modules/Products/listviewdefs.php',
				'type'=>'ListView',
				),
	'LBL_SEARCHFORM'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Products/SearchForm.html',
				'php_file'=>'modules/Products/ListView.php',
				'type'=>'SearchForm',
				),

);
