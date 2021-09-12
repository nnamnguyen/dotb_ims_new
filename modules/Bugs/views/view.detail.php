<?php


class BugsViewDetail extends ViewDetail {
 	function display() {
        $admin = Administration::getSettings();
        if(isset($admin->settings['portal_on']) && $admin->settings['portal_on']) {
           $this->ss->assign("PORTAL_ENABLED", true);
        }
 		parent::display();
 	}
}
