<?php



class ConfiguratorViewHistoryContactsEmails extends DotbView
{
    public function preDisplay()
    {
        if (!is_admin($GLOBALS['current_user'])) {
            dotb_die($GLOBALS['app_strings']['ERR_NOT_ADMIN']);
        }
    }

    public function display()
    {
        $modules = array();
        foreach ($GLOBALS['beanList'] as $moduleName => $objectName) {
            $bean = BeanFactory::newBean($moduleName);

            if (!($bean instanceof DotbBean)) {
                continue;
            }
            if (empty($bean->field_defs)) {
                continue;
            }

            // these are the specific modules we care about
            if (!in_array($moduleName, array('Opportunities','Accounts','Cases'))) {
                continue;
            }

            $modules[$moduleName] = array(
                'module' => $moduleName,
                'label' => translate($moduleName),
                'enabled' => true,
                );
        }

        if (!empty($GLOBALS['dotb_config']['hide_history_contacts_emails'])) {
            foreach ($GLOBALS['dotb_config']['hide_history_contacts_emails'] as $moduleName => $flag) {
                $modules[$moduleName]['enabled'] = !$flag;
            }
        }

        $this->ss->assign('modules', $modules);
        $this->ss->display('modules/Configurator/tpls/historyContactsEmails.tpl');
    }
}
