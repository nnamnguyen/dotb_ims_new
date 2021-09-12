<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/




global $mod_strings;
global $dictionary;

$focus = BeanFactory::getBean('ProspectLists', $_POST['record']);
if (isset($_POST['isDuplicate']) && $_POST['isDuplicate'] == true) {

	$focus->id='';
	$focus->name=$mod_strings['LBL_COPY_PREFIX'].' '.$focus->name;
	
	$focus->save();
	$return_id=$focus->id; 
	//duplicate the linked items.
    $query = 'SELECT related_id, related_type FROM prospect_lists_prospects WHERE prospect_list_id = '
        . $focus->db->quoted($_POST['record']);
	$result = $focus->db->query($query);
	if ($result != null) {
	
		while(($row = $focus->db->fetchByAssoc($result)) != null) {
            $focus->db->insertParams(
                'prospect_lists_prospects',
                $dictionary['prospect_lists_prospects']['fields'],
                array(
                    'id' => create_guid(),
                    'prospect_list_id' => $focus->id,
                    'related_id' => $row['related_id'],
                    'related_type' => $row['related_type'],
                    'date_modified' => TimeDate::getInstance()->nowDb(),
                )
            );
        }
	}
}

header("Location: index.php?action=DetailView&module=ProspectLists&record=$return_id");
