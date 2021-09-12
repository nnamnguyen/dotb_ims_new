<?php



class DotbACLEmailAddress extends DotbACLStrategy
{
    /**
     * Check access to the email field
     * @param string $module
     * @param string $view
     * @param array $context
     * @return bool|void
     */
    public function checkAccess($module, $view, $context) {
        if ($view != 'field') {
            return true;
        }
        if ($context['field'] != 'email') {
            return true;
        }

        $bean = self::loadBean($module, $context);
        return $bean->ACLFieldAccess('email1',$context['action']);
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
