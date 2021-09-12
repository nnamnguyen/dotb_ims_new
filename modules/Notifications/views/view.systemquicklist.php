<?php


class ViewSystemQuicklist extends ViewQuickList{
	function display()
	{
		$GLOBALS['system_notification_buffer'] = array();
		$GLOBALS['buffer_system_notifications'] = true;
		$GLOBALS['system_notification_count'] = 0;
		$sv = new DotbView();
		$sv->includeClassicFile('modules/Administration/DisplayWarnings.php');
	    
		echo $this->_formatNotificationsForQuickDisplay($GLOBALS['system_notification_buffer'], "modules/Notifications/tpls/systemQuickView.tpl");

        $this->clearFTSFlags();
	}
    /**
     * After the notification is displayed, clear the fts flags
     * @return null
     */
    protected function clearFTSFlags() {
        if (is_admin($GLOBALS['current_user']))
        {
            $admin = Administration::getSettings();
            if (!empty($settings->settings['info_fts_index_done']))
            {
                $admin->saveSetting('info', 'fts_index_done', 0);
            }
            // remove notification disabled notification
            $cfg = new Configurator();
            $cfg->config['fts_disable_notification'] = false;
            $cfg->handleOverride();
        }        
    }
}

