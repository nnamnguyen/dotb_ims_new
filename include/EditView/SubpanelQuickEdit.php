<?php



require_once('include/EditView/EditView2.php');
/**
 * Quick edit form in the subpanel
 * @api
 */
class SubpanelQuickEdit{
	var $defaultProcess = true;

    public function __construct($module, $view = 'QuickEdit', $proccessOverride = false)
	{
        //treat quickedit and quickcreate views as the same
        if($view == 'QuickEdit') {$view = 'QuickCreate';}

		// locate the best viewdefs to use: 1. custom/module/quickcreatedefs.php 2. module/quickcreatedefs.php 3. custom/module/editviewdefs.php 4. module/editviewdefs.php
        $source = DotbAutoLoader::existingCustomOne("modules/{$module}/metadata/".strtolower($view) . 'defs.php');
        if(!$source) {
        	$source = DotbAutoLoader::loadWithMetafiles($module, "editviewdefs");
        	$view = 'EditView';
        }

		$this->ev = new EditView();
		$this->ev->view = $view;
		$this->ev->ss = new Dotb_Smarty();
		$_REQUEST['return_action'] = 'SubPanelViewer';



        //retrieve bean if id or record is passed in
        if (!empty($_REQUEST['record']) || !empty($_REQUEST['id'])){
            if (!empty($_REQUEST['record']) && empty($_REQUEST['id'])){
            	$_REQUEST['id'] = $_REQUEST['record'];
            }
            $this->ev->focus = BeanFactory::retrieveBean($module, $_REQUEST['id']);
            //call setup with focus passed in
		    $this->ev->setup($module, $this->ev->focus, $source);
        }else{
            //no id, call setup on new bean
		    $this->ev->setup($module, null, $source);
        }

	    $this->ev->defs['templateMeta']['form']['headerTpl'] = 'include/EditView/header.tpl';
		$this->ev->defs['templateMeta']['form']['footerTpl'] = 'include/EditView/footer.tpl';
		$this->ev->defs['templateMeta']['form']['buttons'] = array('SUBPANELSAVE', 'SUBPANELCANCEL', 'SUBPANELFULLFORM');
        $this->ev->defs['templateMeta']['form']['hideAudit'] = true;


        $viewEditSource = DotbAutoLoader::existingCustomOne('modules/'.$module.'/views/view.edit.php');

		if(!empty($viewEditSource) && !$proccessOverride) {
            include($viewEditSource);
            $c = $module . 'ViewEdit';

            $customClass = 'Custom' . $c;
            if(class_exists($customClass)) {
                $c = $customClass;
            }

            if(class_exists($c)) {
	            $view = new $c;
	            if($view->useForSubpanel) {
	            	$this->defaultProcess = false;

	            	//Check if we should use the module's QuickCreate.tpl file.
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
        $form_name = 'form_Subpanel'.$this->ev->view .'_'.$module;
        $this->ev->formName = $form_name;
        $this->ev->process(true, $form_name);
		echo $this->ev->display(false, true);
	}
}

