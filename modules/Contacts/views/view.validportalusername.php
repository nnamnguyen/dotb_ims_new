<?php


/**
 * ContactsViewValidPortalUsername.php
 * 
 * This class overrides DotbView and provides an implementation for the ValidPortalUsername
 * method used for checking whether or not an existing portal user_name has already been assigned.
 * We take advantage of the MVC framework to provide this action which is invoked from
 * a javascript AJAX request.
 * 
 * @author Collin Lee
 * */
 

class ContactsViewValidPortalUsername extends DotbView 
{
    /**
     * {@inheritDoc}
     *
     * @param array $params Ignored
     */
    public function process($params = array())
 	{
		$this->display();
 	}

 	/**
     * @see DotbView::display()
     */
    public function display()
    {
        if (!empty($_REQUEST['portal_name'])) {
            $portalUsername = $this->bean->db->quote($_REQUEST['portal_name']);
            $result = $this->bean->db->query("Select count(id) as total from contacts where portal_name = '$portalUsername' and deleted='0'");
            $total = 0;
            while($row = $this->bean->db->fetchByAssoc($result))
                $total = $row['total'];
            echo $total;
        }
        else
           echo '0';
 	}	
}
