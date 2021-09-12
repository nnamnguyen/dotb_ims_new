<?php

require_once 'data/DotbACLStrategy.php';

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
class DotbACLCustomerJourney extends DotbACLStrategy
{
    /**
     * Only allow access to users with the user admin setting
     *
     * @param string $module
     * @param string $view
     * @param array $context
     * @return bool
     */
    public function checkAccess($module, $view, $context)
    {
        try {
            // always allow to read data in all CJ modules
            if (in_array(strtolower($view), array('view', 'list', 'access'), true)) {
                return true;
            }

            // always allow to read data in all CJ modules
            if ($view === 'field' && in_array(strtolower($context['action']), array('list', 'detail', 'read', 'access'), true)) {
                return true;
            }

            require_once 'modules/DRI_Workflows/ConnectorHelper.php';
            $helper = new \DRI_Workflows\ConnectorHelper();

            // validate user access if the logic hooks regards to
            // DRI_SubWorkflow or any other action then read.
            $checkUser = $module === 'DRI_SubWorkflow'
                || $view !== 'field'
                || ($view === 'field' && $context['action'] === 'edit');

            $helper->validateLicense($checkUser);
        } catch (\DRI_Workflows\Exception\InvalidLicenseException $e) {
            return false;
        }

        return true;
    }
}
