<?php

 



class LeadsQuickCreate extends QuickCreate {
    
    var $javascript;
    
    function process() {
        global $current_user, $timedate, $app_list_strings, $current_language, $mod_strings;
        $mod_strings = return_module_language($current_language, 'Leads');
        
        parent::process();
        
  
        $this->ss->assign("SALUTATION_OPTIONS", get_select_options_with_id($app_list_strings['salutation_dom'], ''));
        $this->ss->assign("STATUS_OPTIONS", get_select_options_with_id($app_list_strings['lead_status_dom'], ''));
        $this->ss->assign("LEAD_SOURCE_OPTIONS", get_select_options_with_id($app_list_strings['lead_source_dom'], ''));
        if($this->viaAJAX) { // override for ajax call
            $this->ss->assign('saveOnclick', "onclick='if(check_form(\"leadsQuickCreate\")) return DOTB.subpanelUtils.inlineSave(this.form.id, \"leads\"); else return false;'");
            $this->ss->assign('cancelOnclick', "onclick='return DOTB.subpanelUtils.cancelCreate(\"subpanel_leads\")';");
        }
        
        $this->ss->assign('viaAJAX', $this->viaAJAX);

        $this->javascript = new javascript();
        $this->javascript->setFormName('leadsQuickCreate');
        
        $focus = BeanFactory::newBean('Leads');
        $this->javascript->setDotbBean($focus);
        $this->javascript->addAllFields('');

        $this->ss->assign('additionalScripts', $this->javascript->getScript(false));
    }   
}
?>