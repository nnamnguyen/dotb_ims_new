<?php

require_once 'data/DotbACLStrategy.php';

/**
 * Class DotbACLOwnerWrite
 *
 * This ACL restricts the write access to record owners and Administrators only.
 */
class DotbACLOwnerWrite extends DotbACLStrategy
{
    /**
     * {@inheritDoc}
     *
     * Only allow edit access to model owners or module administrators.
     *
     * @param string $module
     * @param string $view
     * @param array $context
     */
    public function checkAccess($module, $view, $context)
    {
        // Allow all read access.
        if (!self::isWriteOperation($view, $context)) {
            return true;
        }

        // Some contexts may not have a bean. For example, the call to /me
        // which retrieves the user's metadata checks access for each module,
        // but there is no specific bean and therefore we do not need to
        // restrict access.
        if (!array_key_exists('bean', $context)) {
            return true;
        }

        $user = $this->getCurrentUser($context);
        $bean = $context['bean'];
        return $user->isAdminForModule($module) || $bean->isOwner($user->id);
    }
}
