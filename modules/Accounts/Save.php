<?php

/*********************************************************************************

 * Description:  Saves an Account record and then redirects the browser to the
 * defined return URL.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
$accountForm = new AccountFormBase();
$prefix = empty($_REQUEST['dup_checked']) ? '' : 'Accounts';
$accountForm->handleSave($prefix, true, false);

?>