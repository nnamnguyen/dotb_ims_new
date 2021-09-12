<?php



class AuditApi extends ModuleApi
{
    public function registerApiRest()
    {
        return array(
            'view_change_log' => array(
                'reqType' => 'GET',
                'path' => array('<module>','?', 'audit'),
                'pathVars' => array('module','record','audit'),
                'method' => 'viewChangeLog',
                'shortHelp' => 'View audit log in record view',
                'longHelp' => 'include/api/help/audit_get_help.html',
            ),
        );
    }

    public function viewChangeLog(ServiceBase $api, array $args)
    {
        global $focus, $current_user;

        $this->requireArgs($args,array('module', 'record'));

        $focus = BeanFactory::getBean($args['module'], $args['record']);

        if (!$focus->ACLAccess('view')) {
            throw new DotbApiExceptionNotAuthorized('no access to the bean');
        }

        $auditBean = BeanFactory::newBean('Audit');

        return array(
            'next_offset' => -1,
            'records' => $auditBean->getAuditLog($focus),
        );
    }
}
