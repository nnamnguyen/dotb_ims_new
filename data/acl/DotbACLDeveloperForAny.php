<?php


/**
 * This class is used to enforce ACLs on modules that are restricted to admins only.
 */
class DotbACLDeveloperForAny extends DotbACLStrategy
{

    /**
     * Only allow access to users with the user admin setting
     * @param string $module
     * @param string $view
     * @param array $context
     * @return bool|void
     */
    public function checkAccess($module, $view, $context)
    {
        $current_user = $this->getCurrentUser($context);
        if ( !$current_user ) {
            return false;
        }

        if ($view == 'team_security' || $view == 'field') {
            return true;
        }

        // if they are a developer for any module
        $devForAny = $current_user->isDeveloperForAnyModule();

        if(!empty($devForAny)) {
            return true;
        }

        return false;
    }

}
