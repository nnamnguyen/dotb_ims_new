<?php


class CampaignsViewClassic extends DotbView
{
    public function __construct()
 	{
        parent::__construct();
 		$this->type = $this->action;
 	}

 	/**
	 * @see DotbView::display()
	 */
	public function display()
	{
 		// Call DotbController::getActionFilename to handle case sensitive file names
 		$file = DotbController::getActionFilename($this->action);
 		$classic = DotbAutoLoader::existingCustomOne('modules/' . $this->module . '/'. $file . '.php');
 		if($classic) {
 		    $this->includeClassicFile($classic);
 		    return true;
 		}
		return false;
 	}

    /**
	 * @see DotbView::_getModuleTitleParams()
	 */
	protected function _getModuleTitleParams($browserTitle = false)
	{
    	$params = array();
    	$params[] = $this->_getModuleTitleListParam($browserTitle);
    	if (isset($this->action)){
    		switch($_REQUEST['action']){
    				case 'WizardHome':
				    	if(!empty($this->bean->id))
				    	{
				    		$params[] = "<a href='index.php?module={$this->module}&action=DetailView&record={$this->bean->id}'>".$this->bean->name."</a>";
				    	}
				    	$params[] = $GLOBALS['mod_strings']['LBL_CAMPAIGN_WIZARD'];
				    	break;
				    case 'WebToLeadCreation':
    					$params[] = $GLOBALS['mod_strings']['LBL_LEAD_FORM_WIZARD'];
    					break;
    				case 'WizardNewsletter':

                        if (isset($_REQUEST['wizardtype']) && $_REQUEST['wizardtype'] == '2') {
                            if (!empty($this->bean->id)) {
                                $params[] = "<a href='index.php?module={$this->module}&action=DetailView&record={$this->bean->id}'>".$GLOBALS['mod_strings']['LBL_EMAIL_TITLE']."</a>";
                            }
                            $params[] = $GLOBALS['mod_strings']['LBL_CREATE_EMAIL'];
                        } else {
                            if (!empty($this->bean->id)) {
				    		    $params[] = "<a href='index.php?module={$this->module}&action=DetailView&record={$this->bean->id}'>".$GLOBALS['mod_strings']['LBL_NEWSLETTER_TITLE']."</a>";
				    	    }
                            $params[] = $GLOBALS['mod_strings']['LBL_CREATE_NEWSLETTER'];

                        }
				    	break;
    				case 'CampaignDiagnostic':
    					$params[] = $GLOBALS['mod_strings']['LBL_CAMPAIGN_DIAGNOSTICS'];
    					break;
    				case 'WizardEmailSetup':
    					$params[] = $GLOBALS['mod_strings']['LBL_EMAIL_SETUP_WIZARD_TITLE'];
    					break;
    				case 'TrackDetailView':
    					if(!empty($this->bean->id))
    					{
	    					$params[] = "<a href='index.php?module={$this->module}&action=DetailView&record={$this->bean->id}'>".$this->bean->name."</a>";
    					}
	    				$params[] = $GLOBALS['mod_strings']['LBL_LIST_TO_ACTIVITY'];
    					break;
    		}//switch
    	}//fi

    	return $params;
    }
}
