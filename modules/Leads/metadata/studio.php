<?php



$GLOBALS['studioDefs']['Leads'] = array(
	'LBL_DETAILVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Leads/DetailView.html',
				'php_file'=>'modules/Leads/DetailView.php',
				'type'=>'DetailView',
				),
	'LBL_EDITVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Leads/EditView.html',
				'php_file'=>'modules/Leads/EditView.php',
				'type'=>'EditView',
				),
	'LBL_LISTVIEW'=>array(
				'template'=>'listview',
				'meta_file'=>'modules/Leads/listviewdefs.php',
				'type'=>'ListView',
				),
	'LBL_SEARCHFORM'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Leads/SearchForm.html',
				'php_file'=>'modules/Leads/ListView.php',
				'type'=>'SearchForm',
				),

);
