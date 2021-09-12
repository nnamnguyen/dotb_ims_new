<?php
if (!defined('dotbEntry') || !dotbEntry) {
    die('Not A Valid Entry Point');
}

class DownloadApi extends DotbApi
{
    public function registerApiRest() {
        return array(
            'download' => array(
                'reqType' => 'GET',
                'path' => array('ops_Backups', '?', 'file', '?'),
                'pathVars' => array('', 'record', '', 'field'),
                'method' => 'download',
                'shortHelp' => 'Retrieves the URL to download the specified backup record',
                'longHelp' => '',
            )
        );
    }

    function download(ServiceBase $api, array $args) {
        global $current_user;
        if ($current_user->is_admin != 1) {
          throw new DotbApiExceptionNotAuthorized();
        }

        $backup_id = '';
        if (array_key_exists('record', $args)) {
          $backup_id = preg_replace('/[^a-z0-9-]/', '', $args['record']);
        } else {
          throw new DotbApiExceptionInvalidParameter('No backup record was provided');
        }

        $bean = BeanFactory::getBean('ops_Backups',$backup_id);

        if (empty($bean->id)) {
          throw new DotbApiExceptionNotFound();
        }

        $GLOBALS['log']->fatal(sprintf("User %s [%s] downloaded backup ID %s",
          $current_user->user_name,
          $current_user->id,
          $backup_id
        ));

        $trackerManager = TrackerManager::getInstance();
        if ($monitor = $trackerManager->getMonitor('tracker')){
          $monitor->setValue('team_id', $current_user->getPrivateTeamID());
          $monitor->setValue('date_modified', $GLOBALS['timedate']->nowDb());
          $monitor->setValue('user_id', $current_user->id);
          $monitor->setValue('module_name', $bean->module_dir);
          $monitor->setValue('action', 'download');
          $monitor->setValue('item_id', $backup_id);
          $monitor->setValue('item_summary', sprintf(translate('LBL_RETRIEVED_BACKUP_URL', 'ops_Backups'), $current_user->user_name, $current_user->id, $bean->date_entered, $backup_id));
          $monitor->setValue('visible', 1);
          $trackerManager->saveMonitor($monitor);
        }

        return($bean->download_url);
    }
}
