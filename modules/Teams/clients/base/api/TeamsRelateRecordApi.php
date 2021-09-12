<?php


class TeamsRelateRecordApi extends RelateRecordApi
{
    public function registerApiRest() {
        return array(
            'createRelatedLink' => array(
                'reqType'   => 'POST',
                'path'      => array('Teams','?',     'link','?'        ,'?'),
                'pathVars'  => array('module',  'record','',    'link_name','remote_id'),
                'method'    => 'createRelatedLink',
                'shortHelp' => 'Relates an existing record to this module',
                'longHelp'  => 'include/api/help/module_record_link_link_name_remote_id_post_help.html',
            ),
            'createRelatedLinks' => array(
                'reqType' => 'POST',
                'path' => array('Teams', '?', 'link'),
                'pathVars' => array('module', 'record', ''),
                'method' => 'createRelatedLinks',
                'shortHelp' => 'Relates existing records to this module.',
                'longHelp' => 'include/api/help/module_record_link_post_help.html',
            ),
            'deleteRelatedLink' => array(
                'reqType'   => 'DELETE',
                'path'      => array('Teams','?'     ,'link','?'        ,'?'),
                'pathVars'  => array('module'  ,'record',''    ,'link_name','remote_id'),
                'method'    => 'deleteRelatedLink',
                'shortHelp' => 'Deletes a relationship between two records',
                'longHelp'  => 'include/api/help/module_record_link_link_name_remote_id_delete_help.html',
            ),
        );
    }

    protected function checkRelatedSecurity(
        ServiceBase $api,
        array $args,
        DotbBean $primaryBean,
        $securityTypeLocal = 'view',
        $securityTypeRemote = 'view'
    ) {
        global $current_user;

        if (!$current_user->isAdmin()) {
            throw new DotbApiExceptionNotAuthorized('No access to modify Teams');
        }

        return parent::checkRelatedSecurity($api, $args, $primaryBean, $securityTypeLocal, $securityTypeRemote);
    }
}
