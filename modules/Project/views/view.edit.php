<?php



class ProjectViewEdit extends ViewEdit {
 	function display() {
        $this->bean->is_template = 0;
        if (!empty($this->ev->ss)){
            $this->ev->ss->assign("is_template", 0);
        }
 		parent::display();
 	}
}
