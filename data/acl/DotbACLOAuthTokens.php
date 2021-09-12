<?php


class DotbACLOAuthTokens extends DotbACLStrategy
{
    public $create_only_fields = array(
            'secret' => true,
            'consumer' => true,
            'download_token' => true,
            'platform' => true,
            'callback_url' => true,
            'contact_id' => true,
            'assigned_user_id' => true,
        );

    /**
     * Check access a current user has on Users and Employees
     * @param string $module
     * @param string $view
     * @param array $context
     * @return bool|void
     */
    public function checkAccess($module, $view, $context) {
        if ( $view == 'team_security' ) {
            // Let the other modules decide
            return true;
        }

        // Let's make it a little easier on ourselves and fix up the actions nice and quickly
        $view = DotbACLStrategy::fixUpActionName($view);
        if ( $view == 'field' ) {
            $context['action'] = DotbACLStrategy::fixUpActionName($context['action']);
        }

        // Some fields can only be edited when you create a record.
        if ( (!empty($context['bean']) && !empty($context['bean']->id)) && $view == 'field' && $context['action'] == 'edit' && isset($this->create_only_fields[$context['field']]) ) {
            return false;
        }

        return true;
    }
}
