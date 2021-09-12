<?php



$GLOBALS['studioDefs']['Campaigns'] = array(
	'LBL_DETAILVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Campaigns/DetailView.html',
				'php_file'=>'modules/Campaigns/DetailView.php',
				'type'=>'DetailView',
				),
	'LBL_EDITVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Campaigns/EditView.html',
				'php_file'=>'modules/Campaigns/EditView.php',
				'type'=>'EditView',
				),
	'LBL_LISTVIEW'=>array(
				'template'=>'listview',
				'meta_file'=>'modules/Campaigns/listviewdefs.php',
				'type'=>'ListView',
				),
	'LBL_SEARCHFORM'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/Campaigns/SearchForm.html',
				'php_file'=>'modules/Campaigns/ListView.php',
				'type'=>'SearchForm',
				),

);
