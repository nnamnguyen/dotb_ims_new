<?php




class StudioWizard{
    var $tplfile = 'modules/Studio/wizards/tpls/wizard.tpl';
    var $wizard = 'StudioWizard';
    var $status = '';
    var $assign = array();
    
    function welcome(){
        return $GLOBALS['mod_strings']['LBL_SW_WELCOME'];
    }

    function options(){
    	$options = array('SelectModuleWizard'=>$GLOBALS['mod_strings']['LBL_SW_EDIT_MODULE'], 
    	                 'EditDropDownWizard'=>$GLOBALS['mod_strings']['LBL_SW_EDIT_DROPDOWNS'],
    	                 'RenameTabs'=>$GLOBALS['mod_strings']['LBL_SW_RENAME_TABS'],
    	                 'ConfigureTabs'=>$GLOBALS['mod_strings']['LBL_SW_EDIT_TABS'],
    	                 'Portal'=>$GLOBALS['mod_strings']['LBL_SW_EDIT_PORTAL'],
				         'Workflow'=>$GLOBALS['mod_strings']['LBL_SW_EDIT_WORKFLOW'],
				         'RepairCustomFields'=>$GLOBALS['mod_strings']['LBL_SW_REPAIR_CUSTOMFIELDS'],
				         'MigrateCustomFields'=>$GLOBALS['mod_strings']['LBL_SW_MIGRATE_CUSTOMFIELDS'],

        
        );
    	if(!empty($GLOBALS['license']->settings['license_num_portal_users'])){
        	$options['DotbPortal']=$GLOBALS['mod_strings']['LBL_SW_DOTBPORTAL'];
        }
        return $options;
        
        
    }
    function back(){}
    function process($option){
        switch($option)
        {
            case 'SelectModuleWizard':
                require_once('modules/Studio/wizards/'. $option . '.php');
                $newWiz = new $option();
                $newWiz->display();
                break;
            case 'EditDropDownWizard':
                require_once('modules/Studio/wizards/'. $option . '.php');
                $newWiz = new $option();
                $newWiz->display();
                break;
            case 'RenameTabs':
                $newWiz = new RenameModules();
                $newWiz->process();
                break; 
            case 'ConfigureTabs':
                header('Location: index.php?module=Administration&action=ConfigureTabs');
                dotb_cleanup(true);
            case 'Workflow':
                header('Location: index.php?module=WorkFlow&action=ListView');
                dotb_cleanup(true);
            case 'Portal':
                header('Location: index.php?module=iFrames&action=index');
                dotb_cleanup(true);
            case 'RepairCustomFields':
            	header('Location: index.php?module=Administration&action=UpgradeFields');
            	dotb_cleanup(true);
            case 'MigrateCustomFields':
            	header('LOCATION: index.php?module=Administration&action=Development');
            	dotb_cleanup(true);
            case 'DotbPortal':
            	header('LOCATION: index.php?module=Studio&action=Portal');
            	dotb_cleanup(true);
            case 'Classic':
                header('Location: index.php?module=DynamicLayout&action=index');
                dotb_cleanup(true);
            default:
                $this->display();
        }
    }
    function display($error = ''){
       echo $this->fetch($error );
    }
    
    function fetch($error = ''){
    	 global $mod_strings;
        echo getClassicModuleTitle('StudioWizard', array($mod_strings['LBL_MODULE_TITLE']), false);
        $dotb_smarty = new Dotb_Smarty();
        $dotb_smarty->assign('welcome', $this->welcome());
        $dotb_smarty->assign('options', $this->options());
        $dotb_smarty->assign('MOD', $GLOBALS['mod_strings']);
        $dotb_smarty->assign('option', (!empty($_REQUEST['option'])?$_REQUEST['option']:''));
        $dotb_smarty->assign('wizard',$this->wizard);
         $dotb_smarty->assign('error',$error);
        $dotb_smarty->assign('status', $this->status);
        $dotb_smarty->assign('mod', $mod_strings);
        foreach($this->assign as $name=>$value){
            $dotb_smarty->assign($name, $value);
        }
       return  $dotb_smarty->fetch($this->tplfile);
    }

}
?>
