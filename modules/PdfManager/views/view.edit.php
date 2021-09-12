<?php




class PdfManagerViewEdit extends ViewEdit
{
    public function display()
    {
    
        // Disable VCR Control
        $this->ev->showVCRControl = false;

        // Default Team as Global
        if ((empty($this->bean->id))  && !$this->ev->isDuplicate) {
            $this->bean->team_id = 1;
            $this->bean->team_set_id = 1;
        }
    
        // Load TinyMCE
        $tiny = new DotbTinyMCE();
        $tiny->defaultConfig['apply_source_formatting']=true;
        $tiny->defaultConfig['cleanup_on_startup']=true;
        $tiny->defaultConfig['relative_urls']=false;
        $tiny->defaultConfig['convert_urls']=false;
        $ed = $tiny->getInstance('body_html');
        $this->ss->assign('tiny_script', $ed);

        // Load Fields for main module
        if (empty($this->bean->base_module)) {
            $modulesList = PdfManagerHelper::getAvailableModules();
            $this->bean->base_module = key($modulesList);
        }
        $fieldsForSelectedModule = PdfManagerHelper::getFields($this->bean->base_module, true);

        $this->ss->assign('fieldsForSelectedModule', $fieldsForSelectedModule);

        parent::display();
    }
}
