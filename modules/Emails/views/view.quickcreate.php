<?php



class EmailsViewQuickcreate extends ViewQuickcreate 
{
    /**
     * @see ViewQuickcreate::display()
     */
    public function display()
    {
        $userPref = $GLOBALS['current_user']->getPreference('email_link_type');
		$defaultPref = $GLOBALS['dotb_config']['email_default_client'];
		if($userPref != '')
			$client = $userPref;
		else
			$client = $defaultPref;
		
        if ( $client == 'dotb' ) {
            $eUi = new EmailUI();
            if(!empty($this->bean->id) && !in_array($this->bean->object_name,array('EmailMan')) ) {
                $fullComposeUrl = "index.php?module=Emails&action=Compose&parent_id={$this->bean->id}&parent_type={$this->bean->module_dir}";
                $composeData = array('parent_id'=>$this->bean->id, 'parent_type' => $this->bean->module_dir);
            } else {
                $fullComposeUrl = "index.php?module=Emails&action=Compose";
                $composeData = array('parent_id'=>'', 'parent_type' => '');
            }
            
            $j_quickComposeOptions = $eUi->generateComposePackageForQuickCreate($composeData, $fullComposeUrl); 
            $json_obj = getJSONobj();
            $opts = $json_obj->decode($j_quickComposeOptions);
            $opts['menu_id'] = 'dccontent';
             
            $ss = new Dotb_Smarty();
            $ss->assign('json_output', $json_obj->encode($opts));
            $ss->display('modules/Emails/templates/dceMenuQuickCreate.tpl');
        }
        else {
            $emailAddress = '';
            if(!empty($this->bean->id) && !in_array($this->bean->object_name,array('EmailMan')) ) {
                $emailAddress = $this->bean->emailAddress->getPrimaryAddress($this->bean);
            }
            echo "<script>document.location.href='mailto:$emailAddress';lastLoadedMenu=undefined;DCMenu.closeOverlay();</script>";
            die();
        }
    } 
}
