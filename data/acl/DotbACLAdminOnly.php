<?php


/**
 * This class is used to enforce ACLs on modules that are restricted to admins only.
 */
class DotbACLAdminOnly extends DotbACLStrategy
{
    protected $allowUserRead = false;
    protected $adminFor = '';

    public function __construct($aclOptions)
    {
        if ( is_array($aclOptions) ) {
            if ( !empty($aclOptions['allowUserRead']) ) {
                $this->allowUserRead = true;
            }
            if ( !empty($aclOptions['adminFor']) ) {
                $this->adminFor = $aclOptions['adminFor'];
            }
        }
    }

    /**
     * Only allow access to users with the user admin setting
     * @param string $module
     * @param string $view
     * @param array $context
     * @return bool|void
     */
    public function checkAccess($module, $view, $context)
    {
        if ( $view == 'team_security' ) {
            // Let the other modules decide
            return true;
        }

        if ( !empty($this->adminFor) ) {
            $module = $this->adminFor;
        }
        
        $current_user = $this->getCurrentUser($context);
        if ( !$current_user ) {
            return false;
        }

        if($current_user->isAdminForModule($module)) {
            return true;
        } else {
            if ( $this->allowUserRead && !$this->isWriteOperation($view, $context) ) {
                return true;
            } else {
                return false;
            }
        }
    }

}
