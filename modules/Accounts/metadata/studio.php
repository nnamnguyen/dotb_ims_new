<?php



$GLOBALS['studioDefs']['Accounts'] = array(
	'LBL_DETAILVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Accounts/DetailView.html',
				'php_file'=>'modules/Accounts/DetailView.php',
				'type'=>'DetailView',
				),
	'LBL_EDITVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Accounts/EditView.html',
				'php_file'=>'modules/Accounts/EditView.php',
				'type'=>'EditView',
				),
	'LBL_LISTVIEW'=>array(
				'template'=>'listview',
				'meta_file'=>'modules/Accounts/listviewdefs.php',
				'type'=>'ListView',
				),
	'LBL_SEARCHFORM'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Accounts/SearchForm.html',
				'php_file'=>'modules/Accounts/ListView.php',
				'type'=>'SearchForm',
				),

);
