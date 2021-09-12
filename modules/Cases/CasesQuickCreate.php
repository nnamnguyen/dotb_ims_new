<?php

 



class CasesQuickCreate extends QuickCreate {
    
    var $javascript;
    
    function process() {
        global $current_user, $timedate, $app_list_strings, $current_language, $mod_strings;
        $mod_strings = return_module_language($current_language, 'Cases');
        
        parent::process();
  
        $this->ss->assign("PRIORITY_OPTIONS", get_select_options_with_id($app_list_strings['case_priority_dom'], $app_list_strings['case_priority_default_key']));

        if($this->viaAJAX) { // override for ajax call
            $this->ss->assign('saveOnclick', "onclick='if(check_form(\"casesQuickCreate\")) return DOTB.subpanelUtils.inlineSave(this.form.id, \"cases\"); else return false;'");
            $this->ss->assign('cancelOnclick', "onclick='return DOTB.subpanelUtils.cancelCreate(\"subpanel_cases\")';");
        }
        
        $this->ss->assign('viaAJAX', $this->viaAJAX);

        $this->javascript = new javascript();
        $this->javascript->setFormName('casesQuickCreate');
        
        $focus = BeanFactory::newBean('Cases');
        $this->javascript->setDotbBean($focus);
        $this->javascript->addAllFields('');

		$this->ss->assign("STATUS_OPTIONS", get_select_options_with_id($app_list_strings['case_status_dom'], $focus->status));
        $this->ss->assign('additionalScripts', $this->javascript->getScript(false));
        
        $json = getJSONobj();
        
		$popup_request_data = array(
			'call_back_function' => 'set_return',
			'form_name' => 'casesQuickCreate',
			'field_to_name_array' => array(
				'id' => 'account_id',
				'name' => 'account_name',
			),
		);
	
		$encoded_popup_request_data = $json->encode($popup_request_data);
		$this->ss->assign('encoded_popup_request_data', $encoded_popup_request_data);        

		$popup_request_data = array(
			'call_back_function' => 'set_return',
			'form_name' => 'casesQuickCreate',
			'field_to_name_array' => array(
				'id' => 'team_id',
				'name' => 'team_name',
			),
		);
		$this->ss->assign('encoded_team_popup_request_data', $json->encode($popup_request_data));
        
    }   
}
?>