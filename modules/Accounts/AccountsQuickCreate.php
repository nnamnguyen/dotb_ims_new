<?php

 



class AccountsQuickCreate extends QuickCreate {
    
    var $javascript;
    
    function process() {
        global $current_user, $timedate, $app_list_strings, $current_language, $mod_strings;
        $mod_strings = return_module_language($current_language, 'Accounts');
        
        parent::process();
  
        if($this->viaAJAX) { // override for ajax call
            $this->ss->assign('saveOnclick', "onclick='if(check_form(\"accountsQuickCreate\")) return DOTB.subpanelUtils.inlineSave(this.form.id, \"accounts\"); else return false;'");
            $this->ss->assign('cancelOnclick', "onclick='return DOTB.subpanelUtils.cancelCreate(\"subpanel_accounts\")';");
        }
        
        $this->ss->assign('viaAJAX', $this->viaAJAX);

        $this->javascript = new javascript();
        $this->javascript->setFormName('accountsQuickCreate');
        
        $focus = BeanFactory::newBean('Accounts');
        $this->javascript->setDotbBean($focus);
        $this->javascript->addAllFields('');

        $this->ss->assign('additionalScripts', $this->javascript->getScript(false));
    }   
}
?>