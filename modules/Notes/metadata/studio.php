<?php



$GLOBALS['studioDefs']['Notes'] = array(
	'LBL_DETAILVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Notes/DetailView.html',
				'php_file'=>'modules/Notes/DetailView.php',
				'type'=>'DetailView',
				),
	'LBL_EDITVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Notes/EditView.html',
				'php_file'=>'modules/Notes/EditView.php',
				'type'=>'EditView',
				),
	'LBL_LISTVIEW'=>array(
				'template'=>'listview',
				'meta_file'=>'modules/Notes/listviewdefs.php',
				'type'=>'ListView',
				),
	'LBL_SEARCHFORM'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Notes/SearchForm.html',
				'php_file'=>'modules/Notes/ListView.php',
				'type'=>'SearchForm',
				),

);
