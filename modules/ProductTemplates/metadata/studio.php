<?php



$GLOBALS['studioDefs']['ProductTemplates'] = array(
	'LBL_DETAILVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/ProductTemplates/DetailView.html',
				'php_file'=>'modules/ProductTemplates/DetailView.php',
				'type'=>'DetailView',
				),
	'LBL_EDITVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/ProductTemplates/EditView.html',
				'php_file'=>'modules/ProductTemplates/EditView.php',
				'type'=>'EditView',
				),
	'LBL_LISTVIEW'=>array(
				'template'=>'listview',
				'meta_file'=>'modules/ProductTemplates/listviewdefs.php',
				'type'=>'ListView',
				),
	'LBL_SEARCHFORM'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/ProductTemplates/SearchForm.html',
				'php_file'=>'modules/ProductTemplates/ListView.php',
				'type'=>'SearchForm',
				),

);
