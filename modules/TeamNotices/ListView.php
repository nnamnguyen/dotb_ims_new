<?php

/*********************************************************************************

 ********************************************************************************/
if (!$GLOBALS['current_user']->isAdminForModule('Users')) dotb_die($GLOBALS['app_strings']['ERR_NOT_ADMIN']);

global $mod_strings;
global $app_list_strings;
global $app_strings;
global $current_user;
$GLOBALS['displayListView'] = true; 
$header_text = '';
$focus = BeanFactory::newBean('TeamNotices');
//$is_edit = true;

$GLOBALS['log']->info("TeamNotice list view");

echo getClassicModuleTitle('TeamNotices', array($mod_strings['LBL_MODULE_NAME']), true);

$ListView = new ListView();
$ListView->initNewXTemplate( 'modules/TeamNotices/ListView.html',$mod_strings);
$ListView->xTemplateAssign("DELETE_INLINE_PNG",  DotbThemeRegistry::current()->getImage('delete_inline','align="absmiddle" border="0"',null,null,'.gif',$app_strings['LNK_DELETE']));
$ListView->setQuery('', "", "team_notices.name", "TEAMNOTICE");
$ListView->processListView($focus, "main", "TEAMNOTICE");