<?php



$GLOBALS['studioDefs']['ProjectTask'] = array(
	'LBL_DETAILVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/ProjectTask/DetailView.html',
				'php_file'=>'modules/ProjectTask/DetailView.php',
				'type'=>'DetailView',
				),
	'LBL_EDITVIEW'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/ProjectTask/EditView.html',
				'php_file'=>'modules/ProjectTask/EditView.php',
				'type'=>'EditView',
				),
	'LBL_LISTVIEW'=>array(
				'template'=>'listview',
				'meta_file'=>'modules/ProjectTask/listviewdefs.php',
				'type'=>'ListView',
				),
	'LBL_SEARCHFORM'=>array(
				'template'=>'xtpl',
				'template_file'=>'modules/ProjectTask/SearchForm.html',
				'php_file'=>'modules/ProjectTask/ListView.php',
				'type'=>'SearchForm',
				),

);
