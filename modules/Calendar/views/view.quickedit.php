<?php

require_once('include/EditView/EditView2.php');


class CalendarViewQuickEdit extends DotbView
{
	public $ev;
	protected $editable;
	
	public function preDisplay()
	{
		$this->bean = $this->view_object_map['currentBean'];

		if ($this->bean->ACLAccess('Save')) {
			$this->editable = 1;
		} else {
			$this->editable = 0;
		}
	}

	public function display()
	{

		$module = $this->view_object_map['currentModule'];

		$_REQUEST['module'] = $module;

		$base = 'modules/' . $module . '/metadata/';
		$source = DotbAutoLoader::existingCustomOne($base . 'editviewdefs.php', $base.'quickcreatedefs.php');

		$GLOBALS['mod_strings'] = return_module_language($GLOBALS['current_language'], $module);
        $tpl = DotbAutoLoader::existingCustomOne('include/EditView/EditView.tpl');

		$this->ev = new EditView();
		$this->ev->view = "QuickCreate";
		$this->ev->ss = new Dotb_Smarty();
		$this->ev->formName = "CalendarEditView";
		$this->ev->setup($module,$this->bean,$source,$tpl);
		$this->ev->defs['templateMeta']['form']['headerTpl'] = "modules/Calendar/tpls/editHeader.tpl";
		$this->ev->defs['templateMeta']['form']['footerTpl'] = "modules/Calendar/tpls/empty.tpl";
		$this->ev->process(false, "CalendarEditView");
		
		if (!empty($this->bean->id)) {
		    require_once('include/json_config.php');
		    $jsonConfig = new json_config();
		    $grJavascript = $jsonConfig->getFocusData($module, $this->bean->id);
        } else {
            $grJavascript = "";
        }	
	
		$jsonArr = array(
				'access' => 'yes',
				'module_name' => $this->bean->module_dir,
				'record' => $this->bean->id,
				'edit' => $this->editable,
				'html'=> $this->ev->display(false, true),
				'gr' => $grJavascript,
                'acl' => array(
                    'delete' => $this->bean->aclAccess('delete'),
                ),
		);
		
		if (!empty($this->view_object_map['repeatData'])) {
			$jsonArr = array_merge($jsonArr, array("repeat" => $this->view_object_map['repeatData']));
		}
			
		ob_clean();
		echo json_encode($jsonArr);
	}
}

?>
