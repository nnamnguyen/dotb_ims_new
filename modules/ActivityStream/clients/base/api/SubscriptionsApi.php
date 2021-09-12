<?php



class SubscriptionsApi extends DotbApi
{

    public function registerApiRest()
    {
        return array(
            'subscribeToRecord' => array(
                'reqType' => 'POST',
                'path' => array('<module>','?', 'subscribe'),
                'pathVars' => array('module','record'),
                'method' => 'subscribeToRecord',
                'shortHelp' => 'This method subscribes the user to the current record, for activity stream updates.',
                'longHelp' => 'modules/ActivityStream/clients/base/api/help/recordSubscribe.html',
            ),
            'unsubscribeFromRecord' => array(
                'reqType' => 'DELETE',
                'path' => array('<module>','?', 'unsubscribe'),
                'pathVars' => array('module','record'),
                'method' => 'unsubscribeFromRecord',
                'shortHelp' => 'This method unsubscribes the user from the current record, for activity stream updates.',
                'longHelp' => 'modules/ActivityStream/clients/base/api/help/recordUnsubscribe.html',
            )
        );
    }

    public function subscribeToRecord(ServiceBase $api, array $args)
    {
        $this->requireArgs($args, array('module', 'record'));
        $this->requireActivityStreams($args['module']);
        $bean = BeanFactory::retrieveBean($args['module'], $args['record']);

        if (empty($bean)) {
            throw new DotbApiExceptionNotFound('Could not find parent record '.$args['record'].' in module '.$args['module']);
        }

        if (!$bean->ACLAccess('view')) {
            $moduleName = null;
            if (isset($args['module'])) {
                $failed_module_strings = return_module_language($GLOBALS['current_language'], $args['module']);
                $moduleName = $failed_module_strings['LBL_MODULE_NAME'];
            }
            $args = null;
            if (!empty($moduleName)) {
                $args = array('moduleName' => $moduleName);
            }
            throw new DotbApiExceptionNotAuthorized('EXCEPTION_SUBSCRIBE_MODULE_NOT_AUTHORIZED', $args);
        }

        return Subscription::subscribeUserToRecord($api->user, $bean);
    }

    public function unsubscribeFromRecord(ServiceBase $api, array $args)
    {
        $this->requireArgs($args, array('module', 'record'));
        $this->requireActivityStreams($args['module']);
        $bean = BeanFactory::retrieveBean($args['module'], $args['record']);

        if (empty($bean)) {
            throw new DotbApiExceptionNotFound('Could not find parent record '.$args['record'].' in module '.$args['module']);
        }

        if (!$bean->ACLAccess('view')){
            $moduleName = null;
            if (isset($args['module'])) {
                $failed_module_strings = return_module_language($GLOBALS['current_language'], $args['module']);
                $moduleName = $failed_module_strings['LBL_MODULE_NAME'];
            }
            $args = null;
            if (!empty($moduleName)) {
                $args = array('moduleName' => $moduleName);
            }
            throw new DotbApiExceptionNotAuthorized('EXCEPTION_SUBSCRIBE_MODULE_NOT_AUTHORIZED', $args);
        }

        return Subscription::unsubscribeUserFromRecord($api->user, $bean);
    }

    /**
     * Checks to see if Activity Streams is disabled
     *
     * @param string $moduleName
     * @throws DotbApiExceptionNotAuthorized
     */
    private function requireActivityStreams($moduleName)
    {
        if (!Activity::isEnabled()) {
            throw new DotbApiExceptionNotAuthorized(translate('EXCEPTION_ACTIVITY_STREAM_DISABLED', $moduleName));
        }
    }
}
