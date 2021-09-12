<?php


class DotbACLFilters extends DotbACLStrategy
{
    /**
     * Check access a current user has on Users and Employees
     * @param string $module
     * @param string $view
     * @param array $context
     * @return bool|void
     */
    public function checkAccess($module, $view, $context) {
        
        if($module != 'Filters') {
            // how'd you get here...
            return false;
        }


        $current_user = $this->getCurrentUser($context);

        $bean = self::loadBean($module, $context);

        // non-admin users cannot edit a default filter
        if(!is_admin($current_user)) {
            if(isset($bean) && $bean instanceof DotbBean && !empty($bean->id) && isset($bean->default_filter) && $bean->default_filter == 1){
                if($view == 'save') {
                    return false;
                }
            }
        }
        
        return true;
    }

    /**
     * Load bean from context
     * @static
     * @param string $module
     * @param array $context
     * @return DotbBean
     */
    protected static function loadBean($module, $context = array()) {
        if(isset($context['bean']) && $context['bean'] instanceof DotbBean && $context['bean']->module_dir == $module) {
            $bean = $context['bean'];
        } else {
            $bean = BeanFactory::newBean($module);
        }
        return $bean;
    }

}
