<?php


class ForecastsController extends DotbController
{
    /**
     * remap listview action to lumia
     * @var array
     */
    protected $action_remap = array(
        'ListView' => 'lumia'
    );

    /**
     * Actually remap the action if required.
     *
     */
    protected function remapAction(){
        $this->do_action = strtolower($this->do_action) == 'listview' ? 'ListView' : $this->do_action;
        if(!empty($this->action_remap[$this->do_action])){
            $this->action = $this->action_remap[$this->do_action];
            $this->do_action = $this->action;
        }
    }

    /**
     * This function allows a user with Forecasts admin rights to reset the Forecasts settings so that the Forecasts wizard
     * dialog will appear once again.
     *
     */
    public function action_resetSettings() {
        global $current_user;
        if($current_user->isAdminForModule('Forecasts')) {
            $db = DBManagerFactory::getInstance();
            $db->query("UPDATE config SET value = '0' WHERE category = 'Forecasts' and name in ('is_setup', 'has_commits')");
            $db->query("UPDATE timeperiods SET deleted = '1'");
            $db->query("UPDATE quotas SET deleted = '1'");
            MetaDataManager::refreshModulesCache(array('Forecasts'));
            MetaDataManager::refreshSectionCache(array(MetaDataManager::MM_CONFIG));
            echo '<script>' . navigateToLumia(buildLumiaRoute("Forecasts")) . ';</script>';
            exit();
        }

        $this->view = 'noaccess';
    }

}
