<?php







global $app_strings;
global $app_list_strings;
global $current_language;
$current_module_strings = return_module_language($current_language, 'Leads');

$ListView = new ListView();
$seedLeads = BeanFactory::newBean('Leads');
$header_text = '';
if(is_admin($current_user) && $_REQUEST['module'] != 'DynamicLayout' && !empty($_SESSION['editinplace'])){	
		$header_text = "&nbsp;<a href='index.php?action=index&module=DynamicLayout&from_action=MyLeads&from_module=Leads'>".DotbThemeRegistry::current()->getImage("EditLayout","border='0' alt='Edit Layout' align='bottom'",null,null,'.gif',$mod_strings['LBL_EDITLAYOUT'])."</a>";
}
$where = "assigned_user_id='". $current_user->id ."' and (leads.status is NULL or (leads.status!='Converted' and leads.status!='Dead' and leads.status!='recycled')) ";
$ListView->initNewXTemplate( 'modules/Leads/MyLeads.html',$current_module_strings);
$ListView->setHeaderTitle($current_module_strings['LBL_LIST_MY_LEADS'] . $header_text);
$ListView->setQuery($where, "", "leads.date_entered desc", "LEAD");
$ListView->processListView($seedLeads, "main", "LEAD");
?>