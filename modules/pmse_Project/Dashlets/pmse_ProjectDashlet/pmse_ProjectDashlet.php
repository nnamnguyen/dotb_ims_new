<?php



use Dotbcrm\Dotbcrm\ProcessManager;

class pmse_ProjectDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require('modules/pmse_Project/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'pmse_Project');

        $this->searchFields = $dashletData['pmse_ProjectDashlet']['searchFields'];
        $this->columns = $dashletData['pmse_ProjectDashlet']['columns'];

        $this->seedBean = ProcessManager\Factory::getPMSEObject('pmse_Project');
    }
}
