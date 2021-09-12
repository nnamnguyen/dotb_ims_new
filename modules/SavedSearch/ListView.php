<?php


global $app_strings, $app_list_strings, $current_language, $currentModule, $mod_strings;

echo getClassicModuleTitle('SavedSearch', array($mod_strings['LBL_MODULE_TITLE']), false);
echo get_form_header($mod_strings['LBL_SEARCH_FORM_TITLE'], '', false);

$search_form = new XTemplate ('modules/SavedSearch/SearchForm.html');
$search_form->assign('MOD', $mod_strings);
$search_form->assign('APP', $app_strings);
$search_form->assign('JAVASCRIPT', get_clear_form_js());

if (isset($_REQUEST['name'])) $search_form->assign('name', to_html($_REQUEST['name']));
if (isset($_REQUEST['search_module'])) $search_form->assign('search_module', to_html($_REQUEST['search_module']));

$search_form->parse('main');
$search_form->out('main');

if (!isset($where)) $where = "assigned_user_id = {$current_user->id}";


echo '<br />' .get_form_header($mod_strings['LBL_LIST_FORM_TITLE'], '', false);

$savedSearch = BeanFactory::newBean('SavedSearch');
$lv = new ListViewSmarty();
require DotbAutoLoader::loadWithMetafiles('SavedSearch', 'listviewdefs');

$lv->displayColumns = $listViewDefs['SavedSearch'];
$lv->setup($savedSearch, 'include/ListView/ListViewGeneric.tpl', $where);
$lv->display(true);
