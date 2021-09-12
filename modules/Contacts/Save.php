<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
$contactForm = new ContactFormBase();
$prefix = empty($_REQUEST['dup_checked']) ? '' : 'Contacts';
$contactForm->handleSave($prefix, true, false);

?>