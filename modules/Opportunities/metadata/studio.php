<?php



$GLOBALS['studioDefs']['Opportunities'] = array(
	'LBL_DETAILVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Opportunities/DetailView.html',
				'php_file'=>'modules/Opportunities/DetailView.php',
				'type'=>'DetailView',
				),
	'LBL_EDITVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Opportunities/EditView.html',
				'php_file'=>'modules/Opportunities/EditView.php',
				'type'=>'EditView',
				),
	'LBL_LISTVIEW'=>array(
				'template'=>'listview',
				'meta_file'=>'modules/Opportunities/listviewdefs.php',
				'type'=>'ListView',
				),
	'LBL_SEARCHFORM'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Opportunities/SearchForm.html',
				'php_file'=>'modules/Opportunities/ListView.php',
				'type'=>'SearchForm',
				),

);
