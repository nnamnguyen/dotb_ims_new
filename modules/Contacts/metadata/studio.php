<?php



$GLOBALS['studioDefs']['Contacts'] = array(
	'LBL_DETAILVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Contacts/DetailView.html',
				'php_file'=>'modules/Contacts/DetailView.php',
				'type'=>'DetailView',
				),
	'LBL_EDITVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Contacts/EditView.html',
				'php_file'=>'modules/Contacts/EditView.php',
				'type'=>'EditView',
				),
	'LBL_LISTVIEW'=>array(
				'template'=>'listview',
				'meta_file'=>'modules/Contacts/listviewdefs.php',
				'type'=>'ListView',
				),
	'LBL_SEARCHFORM'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Contacts/SearchForm.html',
				'php_file'=>'modules/Contacts/ListView.php',
				'type'=>'SearchForm',
				),

);
