<?php



$GLOBALS['studioDefs']['Prospects'] = array(
	'LBL_DETAILVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Prospects/DetailView.html',
				'php_file'=>'modules/Prospects/DetailView.php',
				'type'=>'DetailView',
				),
	'LBL_EDITVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Prospects/EditView.html',
				'php_file'=>'modules/Prospects/EditView.php',
				'type'=>'EditView',
				),
	'LBL_LISTVIEW'=>array(
				'template'=>'listview',
				'meta_file'=>'modules/Prospects/listviewdefs.php',
				'type'=>'ListView',
				),
	'LBL_SEARCHFORM'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Prospects/SearchForm.html',
				'php_file'=>'modules/Prospects/ListView.php',
				'type'=>'SearchForm',
				),

);
