<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/





// Contact is used to store customer information.
class ContactQuoteRelationship extends DotbBean {
	// Stored fields
	var $id;
	var $contact_id;
	var $contact_role;
	var $quote_id;

	// Related fields
	var $contact_name;
	var $quote_name;

	var $table_name = "quotes_contacts";
	var $object_name = "ContactQuoteRelationship";
    var $module_name = "ContactQuoteRelationship";
	var $column_fields = Array("id"
		,"contact_id"
		,"quote_id"
		,"contact_role"
		);

	var $new_schema = true;

	var $additional_column_fields = Array();


	public function __construct() {
		parent::__construct();
		$this->disable_row_level_security =true;
	}

	function fill_in_additional_detail_fields()
	{
	    global $locale;
	    
		if(isset($this->contact_id) && $this->contact_id != "")
		{
            $query = sprintf(
                'SELECT first_name, last_name FROM contacts WHERE id = %s AND deleted = 0',
                $this->db->qouted($this->contact_id)
            );
			$result =$this->db->query($query,true," Error filling in additional detail fields: ");
			// Get the id and the name.
			$row = $this->db->fetchByAssoc($result);

			if($row != null)
			{
                $this->contact_name = $locale->formatName('Contacts', $row);
			}
		}

		if(isset($this->quote_id) && $this->quote_id != "")
		{
            $query = sprintf(
                'SELECT name FROM quotes WHERE id = %s AND deleted = 0',
                $this->db->quoted($this->quote_id)
            );
			$result =$this->db->query($query,true," Error filling in additional detail fields: ");
			// Get the id and the name.
			$row = $this->db->fetchByAssoc($result);

			if($row != null)
			{
				$this->quote_name = $row['name'];
			}
		}

	}
}



?>
