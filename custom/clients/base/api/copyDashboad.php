<?php

class copyDashboad extends DotbApi
{
    function registerApiRest()
    {
        return array(
            'copy_dashboard' => array(
                'reqType' => 'POST',
                'path' => array('copy_dashboard'),
                'pathVars' => array(''),
                'method' => 'copyUser',
                'shortHelp' => '',
                'longHelp' => '',
            ),
            'set_dashboard_id' => array(
                'reqType' => 'POST',
                'path' => array('set_dashboard_id'),
                'pathVars' => array(''),
                'method' => 'setDashboardId',
                'shortHelp' => '',
                'longHelp' => '',
            ),
            'check_dashboard' => array(
                'reqType' => 'POST',
                'path' => array('check_dashboard'),
                'pathVars' => array(''),
                'method' => 'checkDashboard',
                'shortHelp' => '',
                'longHelp' => '',
            ),

        );
    }

    function copyUser(ServiceBase $api, array $args)
    {
        global $db;
        $listUserId = [];
        if ($args['moduleName'] == "Teams") {
            $bean = BeanFactory::retrieveBean($args['moduleName'], $args['model']['id']);
            $users = $bean->get_team_members();
            foreach ($users as $user) {
                if ($user->id) {
                    $listUserId[] = $user->id;
                }
            }
        } elseif ($args['moduleName'] == "ACLRoles") {
            $stringId = '';
            foreach ($args['model'] as $role) {
                $stringId .= "'" . $role['id'] . "', ";
            }
            $sql = "Select user_id from acl_roles_users where role_id in(" . $stringId . "'') and deleted = 0";
            $result = $db->fetchArray($sql);
            foreach ($result as $user) {
                $listUserId[] = $user['user_id'];
            }
        } else {
            foreach ($args['model'] as $user) {
                $listUserId[] = $user['id'];
            }
        }
        if (!empty($listUserId)) {
            foreach($listUserId as $userId){
                $user = BeanFactory::retrieveBean('Users', $userId);
                $user->setPreference('dashboard_id', $args['idDashboard'], $nosession = 0, $category = 'global');
                $user->savePreferencesToDB();
            }
        }
    }
    function setDashboardId(ServiceBase $api, array $args){
        $user = BeanFactory::retrieveBean('Users', $args['idUser']);
        $user->setPreference('dashboard_id', $args['idDashboard'], $nosession = 0, $category = 'global');
        $user->savePreferencesToDB();
    }



}