<?php
$a = new Dotb_Smarty();
global $db, $mod_strings;

$admin = new Administration();
$admin->retrieveSettings();
$callcenter_config = $admin->settings['default_callcenter_config'];
if($callcenter_config == "null") $callcenter_config = [];

$qSelectUser = "SELECT id, user_name 
                FROM users
                WHERE deleted=0";
$resSelectUser = $db->query($qSelectUser);
while ($row = $db->fetchByAssoc($resSelectUser))
{
    $arrayUser[$row['id']] = $row['user_name'];
}

$a->assign('mod', $mod_strings);
$a->assign('user', $arrayUser);
$a->assign('callcenter_config', $callcenter_config);
$html = $a->fetch("custom/modules/C_AdminConfig/tpls/ext_callcenter_config.tpl");
echo $html;

?>