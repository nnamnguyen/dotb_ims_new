<?php



class pmse_InboxDashlet extends DashletGeneric {
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require 'modules/pmse_Inbox/metadata/dashletviewdefs.php';

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'pmse_Inbox');

        $this->searchFields = $dashletData['pmse_InboxDashlet']['searchFields'];
        $this->columns = $dashletData['pmse_InboxDashlet']['columns'];

        $this->seedBean = array();//new pmse_Inbox();
    }
}
