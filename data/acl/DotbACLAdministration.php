<?php


/**
 * This class is used to enforce ACLs on modules that are restricted to admins only.
 */
class DotbACLAdministration extends DotbACLStrategy
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

        if($current_user->isAdmin()) {
            return true;
        }

        // if they are admin for ANY modules

        $adminForAny = $current_user->getAdminModules();

        if(!empty($adminForAny)) {
            return true;
        }

        return false;
    }

}
