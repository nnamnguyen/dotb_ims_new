<?php
require_once('modules/<module_name>/<object_name>.php');

class <module_name>Dashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require('modules/<module_name>/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', '<module_name>');

        $this->searchFields = $dashletData['<module_name>Dashlet']['searchFields'];
        $this->columns = $dashletData['<module_name>Dashlet']['columns'];

        $this->seedBean = new <object_name>();        
    }
}