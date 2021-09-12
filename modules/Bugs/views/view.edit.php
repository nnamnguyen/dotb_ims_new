<?php


class BugsViewEdit extends ViewEdit {
 	function display() {
        $admin = Administration::getSettings();
        if(isset($admin->settings['portal_on']) && $admin->settings['portal_on']) {
           $this->ev->ss->assign("PORTAL_ENABLED", true);
        }
 		parent::display();
 	}
}
