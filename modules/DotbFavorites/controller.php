<?php


class DotbFavoritesController extends DotbController {
	public function __construct(){
	}
	public function loadBean(){
		if(empty($this->record))$this->record = DotbFavorites::generateGUID($_REQUEST['fav_module'], $_REQUEST['fav_id']);
		$this->bean = BeanFactory::newBean('DotbFavorites');
	}
	public function pre_save(){
	    global $current_user;

		if(!$this->bean->retrieve($this->record, true, false)){
			$this->bean->new_with_id = true;
		}
		$this->bean->id = $this->record;
		$this->bean->module = $_REQUEST['fav_module'];
		$this->bean->record_id = $_REQUEST['fav_id'];
		$this->bean->created_by = $current_user->id;
		$this->bean->assigned_user_id = $current_user->id;
		$this->bean->deleted = 0;
	}

	public function action_save(){
	    if(!empty($this->bean->fetched_row['deleted']) && empty($this->bean->deleted)) {
	        $this->bean->mark_undeleted($this->bean->id);
	    }
		$this->bean->save();

	}
	public function post_save(){
		echo $this->record;
	}
	public function action_delete(){
		$this->bean->mark_deleted($this->record);

	}
	public function post_delete(){
		echo $this->record;
	}
	public function action_tag(){
		return 'Favorite Tagged';

	}
}
?>