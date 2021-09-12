<?php

require_once('include/EditView/EditView2.php');
/**
 * Quick create form in the subpanel
 * @api
 */
class SubpanelQuickCreate{
    public $defaultProcess = true;

    /**
     * The view type to use
     *
     * @var string
     */
    public $viewType = 'QuickCreate';

    public function __construct($module, $view = 'QuickCreate', $proccessOverride = false)
    {
        $this->viewType = $view;

        //treat quickedit and quickcreate views as the same
        if($this->viewType == 'QuickEdit') {
            $this->viewType = 'QuickCreate';
        }

		// locate the best viewdefs to use: 1. custom/module/quickcreatedefs.php 2. module/quickcreatedefs.php 3. editviewdefs as in metafile
		$source = DotbAutoLoader::existingCustomOne("modules/{$module}/metadata/quickcreatedefs.php");
		if(!$source) {
            $source = DotbAutoLoader::loadWithMetafiles($module, "editviewdefs");
            $this->viewType = 'EditView';
        }
        $this->ev = $this->getEditView();
		$this->ev->view = $this->viewType;
		$this->ev->ss = new Dotb_Smarty();

		$bean = BeanFactory::newBean($module);
        if($bean && !empty($_REQUEST['record'])) {
            $bean->retrieve($_REQUEST['record']);
        }
		$this->ev->setup($module, $bean, $source);
		unset($bean);


		// Bug 49219 - Check empty before set defaults, or the settings from viewdefs above will be overridden.
        if (!isset($this->ev->defs['templateMeta']['form']['headerTpl']))
        {
            $this->ev->defs['templateMeta']['form']['headerTpl'] = 'include/EditView/header.tpl';
        }

		if (!isset($this->ev->defs['templateMeta']['form']['footerTpl']))
        {
            $this->ev->defs['templateMeta']['form']['footerTpl'] = 'include/EditView/footer.tpl';
        }
		// Comment below, breaks many out of the box viewdefs
		$this->ev->defs['templateMeta']['form']['buttons'] = array('SUBPANELSAVE', 'SUBPANELCANCEL', 'SUBPANELFULLFORM');

        //Load the parent view class if it exists.  Check for custom file first
        loadParentView('edit');

		$viewEditSource = DotbAutoLoader::existingCustomOne('modules/'.$module.'/views/view.edit.php');

		if(!empty($viewEditSource) && !$proccessOverride) {
            require_once $viewEditSource;
            $c = DotbAutoLoader::customClass($module . 'ViewEdit');

            if(class_exists($c)) {
	            $view = new $c;
	            if($view->useForSubpanel) {
	            	$this->defaultProcess = false;

	            	// Check if we should use the module's QuickCreate.tpl file.
                    if ($view->useModuleQuickCreateTemplate
                        && file_exists('modules/'.$module.'/tpls/QuickCreate.tpl')
                    ) {
	            	   $this->ev->defs['templateMeta']['form']['headerTpl'] = 'modules/'.$module.'/tpls/QuickCreate.tpl';
	            	}

		            $view->ev = $this->ev;
		            $view->ss = $this->ev->ss;
		            $view->bean = BeanFactory::newBean($module);
					$this->ev->formName = 'form_Subpanel'.$this->ev->view .'_'.$module;
					$view->showTitle = false; // Do not show title since this is for subpanel
		            $view->display();
	            }
            }
		} //if

		if($this->defaultProcess && !$proccessOverride) {
		   $this->process($module);
		}
	}

	function process($module){
        if($_REQUEST['target_action'] == 'QuickCreate'){
            $this->ev->view = 'QuickCreate';
        }
        $form_name = 'form_Subpanel'.$this->ev->view .'_'.$module;
        $this->ev->formName = $form_name;
        $this->ev->process(true, $form_name);
		echo $this->ev->display(false, true);
	}

    /**
     * Get EditView object
     * @return EditView
     */
    protected function getEditView()
    {
        return new EditView();
    }


    /**
     * Finds and returns the best viewdefs to use:
     *  1. custom/module/quickcreatedefs.php
     *  2. module/quickcreatedefs.php
     *  3. custom/module/editviewdefs.php
     *  4. module/editviewdefs.php
     *
     * @param $module
     * @param $view
     * @return string The path to the viewdefs file to use
     */
    public function getModuleViewDefsSourceFile($module, $view)
    {
    	$source = DotbAutoLoader::existingCustomOne("modules/{$module}/metadata/".strtolower($view)."defs.php");
		if(!$source) {
            $source = DotbAutoLoader::loadWithMetafiles($module, "editviewdefs");
            $this->viewType = 'EditView';
        }

        return $source;
    }
}
