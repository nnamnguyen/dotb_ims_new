<?php




use Dotbcrm\Dotbcrm\ProcessManager;

class pmse_Business_RulesDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require('modules/pmse_Business_Rules/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'pmse_Business_Rules');

        $this->searchFields = $dashletData['pmse_Business_RulesDashlet']['searchFields'];
        $this->columns = $dashletData['pmse_Business_RulesDashlet']['columns'];

        $this->seedBean = ProcessManager\Factory::getPMSEObject('pmse_Business_Rules');
    }
}

