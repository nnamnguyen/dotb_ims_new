<?php
require_once('modules/C_Comments/C_Comments.php');

class C_CommentsDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require('modules/C_Comments/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'C_Comments');

        $this->searchFields = $dashletData['C_CommentsDashlet']['searchFields'];
        $this->columns = $dashletData['C_CommentsDashlet']['columns'];

        $this->seedBean = new C_Comments();        
    }
}