<?php

/*********************************************************************************

 * Description:  Deletes an Account record and then redirects the browser to the 
 * defined return URL.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/




global $mod_strings;



if(!isset($_REQUEST['record']))
	dotb_die($mod_strings['ERR_DELETE_RECORD']);
$focus = BeanFactory::getBean('Documents', $_REQUEST['record']);
if(!$focus->ACLAccess('Delete')){
	ACLController::displayNoAccess(true);
	dotb_cleanup(true);
}
if (isset($_REQUEST['object']) && $_REQUEST['object']="documentrevision") {
	//delete document revision.
	$focus = BeanFactory::newBean('DocumentRevisions');
	UploadFile::unlink_file($_REQUEST['revision_id'],$_REQUEST['filename']);
} else {
	//delete document and its revisions.
	$focus = BeanFactory::getBean('Documents', $_REQUEST['record']);

	$focus->load_relationships('revisions');	
	$revisions= $focus->get_linked_beans('revisions','DocumentRevision');

	if (!empty($revisions) && is_array($revisions)) {
		foreach($revisions as $key=>$thisversion) {
			UploadFile::unlink_file($thisversion->id,$thisversion->filename);
			//mark the version deleted.
			$thisversion->mark_deleted($thisversion->id);
		}				
	}

    //Remove the contracts relationships
    $focus->load_relationship('contracts');
    if(!empty($focus->contracts))
    {
        $focus->contracts->delete($focus->id);
    }

}

$focus->mark_deleted($_REQUEST['record']);
header("Location: index.php?module=".$_REQUEST['return_module']."&action=".$_REQUEST['return_action']."&record=".$_REQUEST['return_id']);
?>
