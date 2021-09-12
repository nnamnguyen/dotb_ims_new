<?php



$GLOBALS['studioDefs']['Meetings'] = array(
	'LBL_DETAILVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Meetings/DetailView.html',
				'php_file'=>'modules/Meetings/DetailView.php',
				'type'=>'DetailView',
				),
	'LBL_EDITVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Meetings/EditView.html',
				'php_file'=>'modules/Meetings/EditView.php',
				'type'=>'EditView',
				),
	'LBL_LISTVIEW'=>array(
				'template'=>'listview',
				'meta_file'=>'modules/Meetings/listviewdefs.php',
				'type'=>'ListView',
				),
	'LBL_SEARCHFORM'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Meetings/SearchForm.html',
				'php_file'=>'modules/Meetings/ListView.php',
				'type'=>'SearchForm',
				),

);
