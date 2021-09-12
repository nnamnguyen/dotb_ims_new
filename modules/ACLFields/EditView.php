<?php


class ACLFieldsEditView{
    public static function getView($module, $role_id)
    {
        $options = array();
        $tbaConfigurator = new TeamBasedACLConfigurator();
        $tbaEnabled = $tbaConfigurator->isEnabledForModule($module);
        $tbaImplemented = $tbaConfigurator->implementsTBA($module);
        $tbaFieldKeys = array_values($tbaConfigurator->getFieldOptions());
		$fields = ACLField::getFields( $module, '', $role_id);
		$dotb_smarty = new Dotb_Smarty();
        $dotb_smarty->assign('LBL_MODULE', $module);

        $GLOBALS['mod_strings'] = return_module_language($GLOBALS['current_language'], 'ACLFields');
		$dotb_smarty->assign('MOD', $GLOBALS['mod_strings']);
		$dotb_smarty->assign('APP', $GLOBALS['app_strings']);
		$dotb_smarty->assign('FLC_MODULE', $module);
		$dotb_smarty->assign('APP_LIST', $GLOBALS['app_list_strings']);
		$dotb_smarty->assign('FIELDS', $fields);
        foreach ($GLOBALS['aclFieldOptions'] as $key => $option) {
            if ((!$tbaEnabled || !$tbaImplemented) && in_array($key, $tbaFieldKeys)) {
                continue;
            }
            $options[$key] = translate($option, 'ACLFields');
        }
        $dotb_smarty->assign('OPTIONS', $options);
        $req_options = $options;
		unset($req_options[-99]);
		$dotb_smarty->assign('OPTIONS_REQUIRED', $req_options);
		return  $dotb_smarty->fetch('modules/ACLFields/EditView.tpl');
	}
}
