<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
$prospectForm = new ProspectFormBase();
if (!isset($_REQUEST['return_module'])) $_REQUEST['return_module']='Prospects';
if (!isset($_REQUEST['return_action'])) $_REQUEST['return_action']='index';

$prospectForm->handleSave('', true, false);

?>
