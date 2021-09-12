<?php



class ContactsViewDetail extends ViewDetail
{
 	/**
 	 * @see DotbView::display()
	 *
 	 * We are overridding the display method to manipulate the portal information.
 	 * If portal is not enabled then don't show the portal fields.
 	 */
 	public function display()
 	{
        $admin = Administration::getSettings();
        if(isset($admin->settings['portal_on']) && $admin->settings['portal_on']) {
           $this->ss->assign("PORTAL_ENABLED", true);
        }
 		parent::display();
 	}
}
