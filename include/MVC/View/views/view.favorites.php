<?php




class ViewFavorites extends DotbView
{
 	public function __construct()
 	{
 		$this->options['show_title'] = false;
		$this->options['show_header'] = false;
		$this->options['show_footer'] = false;
		$this->options['show_javascript'] = false;
		$this->options['show_subpanels'] = false;
		$this->options['show_search'] = false;
        parent::__construct();
 	}

 	public function display()
 	{

        $favorites_max_viewed = (!empty($GLOBALS['dotb_config']['favorites_max_viewed']))? $GLOBALS['dotb_config']['favorites_max_viewed'] : 10;
 		$results = DotbFavorites::getUserFavoritesByModule($this->module,$GLOBALS['current_user'], "dotbfavorites.date_modified DESC ", $favorites_max_viewed);
 		$items = array();
 		foreach ( $results as $key => $row ) {
 				 $items[$key]['label'] = $row->record_name;
 				 $items[$key]['record_id'] = $row->record_id;
 				 $items[$key]['module'] = $row->module;
 		}
 		$this->ss->assign('FAVORITES',$items);
 		$this->ss->display('include/MVC/View/tpls/favorites.tpl');
 	}
}
