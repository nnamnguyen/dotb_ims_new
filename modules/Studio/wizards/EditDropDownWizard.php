<?php



class EditDropDownWizard extends StudioWizard {
	var $wizard = 'EditDropDownWizard';
    function welcome(){
		return 'You can rename the global dropdown list here.';
	}
	function back(){
	    
	    ob_clean();
	     if(!empty($_SESSION['studio']['module'])){
	        header('Location: index.php?action=wizard&module=Studio&wizard=SelectModuleAction');
	        dotb_cleanup(true);
	     }
	     header('Location: index.php?action=wizard&module=Studio&wizard=StudioWizard');
	    dotb_cleanup(true);
	     
	    
	   
	}
	function options(){
//		return array('EditDropdown'=>$GLOBALS['mod_strings']['LBL_SW_EDIT_DROPDOWNS'], 'CreateDropdown'=>$GLOBALS['mod_strings']['LBL_ED_CREATE_DROPDOWN'] );
	}
	
	function process($option){
		switch($option){
		    case 'EditDropdown':
		        parent::process($option);
		        require_once('modules/Studio/DropDowns/EditView.php');
		        break;
		    case 'SaveDropDown':
		        DropDownHelper::saveDropDown($_REQUEST);
		        require_once('modules/Studio/DropDowns/EditView.php');
		        break;
		    default:
		         parent::process($option);
		}
	}

    /**
     * {@inheritDoc}
     *
     * @param string $error Ignored
     */
    public function display($error = '')
	{
	    // override the parent display - don't display any wizard stuff
	}
	
}
