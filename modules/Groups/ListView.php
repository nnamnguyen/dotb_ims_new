<?php



global $mod_strings;
global $current_language;

$focus = BeanFactory::newBean('Groups');
$where = ' users.users.is_group = 1 ';

$current_module_strings = return_module_language($current_language, 'Users');

$ListView = new ListView();
$ListView->initNewXTemplate('modules/Groups/ListView.html',$current_module_strings);
$ListView->setHeaderTitle($mod_strings['LBL_LIST_TITLE']);
$ListView->setQuery($where, "", "last_name, first_name", "USER");
$ListView->show_mass_update=false;
$ListView->processListView($focus, "main", "USER");
?>