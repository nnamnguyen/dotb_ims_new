<?php

 



class ProjectTaskQuickCreate extends QuickCreate {
    
    var $javascript;
    
    function process() {
        global $current_user, $timedate, $app_list_strings, $current_language, $mod_strings;
        $mod_strings = return_module_language($current_language, 'ProjectTask');
        
        parent::process();
        
        if($this->viaAJAX) { // override for ajax call
            $this->ss->assign('saveOnclick', "onclick='if(check_form(\"projectTaskQuickCreate\")) return DOTB.subpanelUtils.inlineSave(this.form.id, \"projecttask\"); else return false;'");
            $this->ss->assign('cancelOnclick', "onclick='return DOTB.subpanelUtils.cancelCreate(\"subpanel_projecttask\")';");
        }
        
        $this->ss->assign('viaAJAX', $this->viaAJAX);

        $this->javascript = new javascript();
        $this->javascript->setFormName('projectTaskQuickCreate');
        
        $focus = BeanFactory::newBean('ProjectTask');
        $this->javascript->setDotbBean($focus);
        $this->javascript->addAllFields('');

        $this->ss->assign('additionalScripts', $this->javascript->getScript(false));

        $json = getJSONobj();
        
///////////////////////////////////////
///
/// SETUP PARENT POPUP

	$popup_request_data = array(
		'call_back_function' => 'set_return',
		'form_name' => 'projectTypeQuickCreate',
		'field_to_name_array' => array(
			'id' => 'parent_id',
			'name' => 'parent_name',
			),
		);

	$encoded_parent_popup_request_data = $json->encode($popup_request_data);
	$this->ss->assign('encoded_parent_popup_request_data', $encoded_parent_popup_request_data);        
        
		$popup_request_data = array(
			'call_back_function' => 'set_return',
			'form_name' => 'projectTaskQuickCreate',
			'field_to_name_array' => array(
				'id' => 'account_id',
				'name' => 'account_name',
			),
		);
	
		$encoded_popup_request_data = $json->encode($popup_request_data);
		$this->ss->assign('encoded_popup_request_data', $encoded_popup_request_data);        

		$popup_request_data = array(
			'call_back_function' => 'set_return',
			'form_name' => 'projectTaskQuickCreate',
			'field_to_name_array' => array(
				'id' => 'team_id',
				'name' => 'team_name',
			),
		);
		$this->ss->assign('encoded_team_popup_request_data', $json->encode($popup_request_data));
        
    }   
}
?>