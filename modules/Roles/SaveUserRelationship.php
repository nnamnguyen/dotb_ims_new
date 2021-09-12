<?php


use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;




$focus = BeanFactory::getBean('Roles', $_REQUEST['record']);

$focus->set_user_relationship($focus->id, $_REQUEST['mass']);

$record = InputValidation::getService()->getValidInputRequest('record', 'Assert\Guid', '');
$header_URL = $dotb_config["site_url"] . "/index.php?action=PopupUsers&form=UsersForm&module=Users&record={$record}";
$GLOBALS['log']->debug("about to post header URL of: $header_URL");

echo "<script language=javascript>\n";
echo "<!-- //\n";
echo "  window.opener.location.reload();\n";
echo "	window.location=\"{$header_URL}\";\n";
echo "// -->\n";
echo "</script>";

?>