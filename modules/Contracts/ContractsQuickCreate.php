<?php

 



class ContractsQuickCreate extends QuickCreate {
    
    var $javascript;
    
    function process() {
        global $current_user, $timedate, $app_list_strings, $current_language, $mod_strings;
        $mod_strings = return_module_language($current_language, 'Contracts');
        
        parent::process();
  
        if($this->viaAJAX) { // override for ajax call
            $this->ss->assign('saveOnclick', "onclick='if(check_form(\"contractsQuickCreate\")) return DOTB.subpanelUtils.inlineSave(this.form.id, \"contracts\"); else return false;'");
            $this->ss->assign('cancelOnclick', "onclick='return DOTB.subpanelUtils.cancelCreate(\"subpanel_contracts\")';");
        }
        
        $this->ss->assign('viaAJAX', $this->viaAJAX);

        $this->javascript = new javascript();
        $this->javascript->setFormName('contractsQuickCreate');
        
        $focus = BeanFactory::newBean('Contracts');
        $this->javascript->setDotbBean($focus);
        $this->javascript->addAllFields('');

		$status_options = isset ($focus->status) ?
			get_select_options_with_id($app_list_strings['contract_status_dom'], $focus->status) :
			get_select_options_with_id($app_list_strings['contract_status_dom'], '');
		$this->ss->assign('STATUS_OPTIONS', $status_options);
		
        $json = getJSONobj();
        
		$popup_request_data = array(
			'call_back_function' => 'set_return',
			'form_name' => 'contractsQuickCreate',
			'field_to_name_array' => array(
				'id' => 'account_id',
				'name' => 'account_name',
			),
		);
	
		$encoded_popup_request_data = $json->encode($popup_request_data);
		$this->ss->assign('encoded_popup_request_data', $encoded_popup_request_data);     
		
		$popup_request_data = array(
			'call_back_function' => 'set_return',
			'form_name' => 'contractsQuickCreate',
			'field_to_name_array' => array(
				'id' => 'team_id',
				'name' => 'team_name',
			),
		);
		$this->ss->assign('encoded_team_popup_request_data', $json->encode($popup_request_data));

        $this->ss->assign('additionalScripts', $this->javascript->getScript(false));
    }   
}
?>