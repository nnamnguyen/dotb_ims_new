<?php

 



class OpportunitiesQuickCreate extends QuickCreate {
    
    var $javascript;
    
    function process() {
        global $current_user, $timedate, $app_list_strings, $current_language, $mod_strings;
        $mod_strings = return_module_language($current_language, 'Opportunities');
        
        $json = getJSONobj();
        
        parent::process();
        
        list($num_grp_sep, $dec_sep) = get_number_seperators();
        $this->ss->assign('NUM_GRP_SEP', $num_grp_sep);
        $this->ss->assign('DEC_SEP', $dec_sep);
        $this->ss->assign('CURRENCY_ID', $current_user->getPreference('currency'));
  
        $this->ss->assign("SALES_STAGE_OPTIONS", get_select_options_with_id($app_list_strings['sales_stage_dom'], ''));
        $this->ss->assign("LEAD_SOURCE_OPTIONS", get_select_options_with_id($app_list_strings['lead_source_dom'], ''));
        $this->ss->assign('prob_array', $json->encode($app_list_strings['sales_probability_dom']));        
        
        if($this->viaAJAX) { // override for ajax call
            $this->ss->assign('saveOnclick', "onclick='if(check_form(\"opportunitiesQuickCreate\")) return DOTB.subpanelUtils.inlineSave(this.form.id, \"opportunities\"); else return false;'");
            $this->ss->assign('cancelOnclick', "onclick='return DOTB.subpanelUtils.cancelCreate(\"subpanel_opportunities\")';");
        }
        
        $this->ss->assign('viaAJAX', $this->viaAJAX);

        $this->javascript = new javascript();
        $this->javascript->setFormName('opportunitiesQuickCreate');
        
        $focus = BeanFactory::newBean('Opportunities');
        $this->javascript->setDotbBean($focus);
        $this->javascript->addAllFields('');

        $this->ss->assign('additionalScripts', $this->javascript->getScript(false));
    }   
}
?>