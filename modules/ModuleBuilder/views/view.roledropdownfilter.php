<?php



/**
 * Role based dropdown filter editor
 */
class ViewRoleDropdownFilter extends ViewDropdown
{
    protected $template = 'modules/ModuleBuilder/tpls/MBModule/roledropdownfilter.tpl';

    protected $defaultParams = array(
        'refreshTree' => false,
        'package_name' => 'studio',
        'view_package' => 'studio',
        'view_module' => '',
        'dropdown_lang' => '',
        'dropdown_name' => '',
        'dropdown_role' => 'default',
        'field' => '',
        'new' => false
    );

    /**
     * @param $params
     * @return Dotb_Smarty
     */
    public function generateSmarty($params)
    {
        $smarty = parent::generateSmarty($params);
        $smarty->assign('dropdown_role', $params['dropdown_role']);
        $smarty->assign('role_options', $this->getRoleOptions($params));
        return $smarty;
    }

    /**
     * @param $params
     * @return array
     */
    protected function getRoleOptions($params)
    {
        $manager = MetaDataManager::getManager();
        return $manager->getEditableDropdownFilter($params['dropdown_name'], $params['dropdown_role']);
    }
}
