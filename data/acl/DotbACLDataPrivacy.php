<?php


/**
 * This class is used to enforce ACLs on modules that are restricted to DPO (Data Privacy Officer) only.
 */
class DotbACLDataPrivacy extends DotbACLStrategy
{
    /**
     * don't allow change field 'fields_to_erase' for non-admin of 'DataPrivacy'
     * @param string $module
     * @param string $view
     * @param array $context
     * @return bool
     */
    public function checkAccess($module, $view, $context)
    {
        $user = $this->getCurrentUser($context);
        if (!$user) {
            return false;
        }

        if (!empty($context['action'])
            && $context['action'] === 'save'
            && $module === 'DataPrivacy'
            && !$user->isAdminForModule($module)
        ){
            $lockedFields = ['fields_to_erase'];
            if (isset($context['field']) && in_array($context['field'], $lockedFields)) {
                return false;
            }
        }
        return true;
    }
}
