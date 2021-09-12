<?php



use Dotbcrm\Dotbcrm\ProcessManager;

class pmse_Emails_TemplatesDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require('modules/pmse_Emails_Templates/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'pmse_Emails_Templates');

        $this->searchFields = $dashletData['pmse_Emails_TemplatesDashlet']['searchFields'];
        $this->columns = $dashletData['pmse_Emails_TemplatesDashlet']['columns'];

        $this->seedBean = ProcessManager\Factory::getPMSEObject('pmse_Emails_Templates');
    }
}

