<?php






/**
 * Form layout manager
 * @api
 */
class LayoutManager
{
	var $defs = array();
	var $widget_prefix = 'DotbWidget';
	var $default_widget_name = 'Field';
	var $DBHelper;

    public function __construct()
	{
		// set a sane default for context
		$this->defs['context'] = 'Detail';
		$this->DBHelper = $GLOBALS['db'];
	}

	function setAttribute($key,$value)
	{
		$this->defs[$key] = $value;
	}

	function setAttributePtr($key,&$value)
	{
		$this->defs[$key] = $value;
	}

	function getAttribute($key)
	{
		if ( isset($this->defs[$key]))
		{
			return $this->defs[$key];
		} else {
			return null;
		}
	}

	// Take the class name from the widget definition and use the class to look it up
	// $use_default will default classes to DotbWidgetFieldxxxxx
	function getClassFromWidgetDef($widget_def, $use_default = false)
	{
		static $class_map = array(
			'DotbWidgetSubPanelTopCreateButton' => array(
				'widget_class'=>'DotbWidgetSubPanelTopButton',
				'title'=>'LBL_NEW_BUTTON_TITLE',
				'access_key'=>'LBL_NEW_BUTTON_KEY',
				'form_value'=>'LBL_NEW_BUTTON_LABEL',
				'ACL'=>'edit',
			),
            'DotbWidgetSubPanelTopButtonQuickCreate' => array(
                'widget_class'=>'DotbWidgetSubPanelTopButtonQuickCreate',
                'title'=>'LBL_NEW_BUTTON_TITLE',
                'access_key'=>'LBL_NEW_BUTTON_KEY',
                'form_value'=>'LBL_NEW_BUTTON_LABEL',
                'ACL'=>'edit',
            ),
            'DotbWidgetSubPanelTopCreateLeadNameButton' => array(
                'widget_class'=>'DotbWidgetSubPanelTopCreateLeadNameButton',
                'title'=>'LBL_NEW_BUTTON_TITLE',
                'access_key'=>'LBL_NEW_BUTTON_KEY',
                'form_value'=>'LBL_NEW_BUTTON_LABEL',
                'ACL'=>'edit',
            ),
			'DotbWidgetSubPanelTopScheduleMeetingButton' => array(
				'widget_class'=>'DotbWidgetSubPanelTopScheduleMeetingButton',
				'module'=>'Meetings',
				'title'=>'LBL_NEW_BUTTON_TITLE',
				'access_key'=>'LBL_NEW_BUTTON_KEY',
				'form_value'=>'LNK_NEW_MEETING',
				'ACL'=>'edit',
			),
			'DotbWidgetSubPanelTopScheduleCallButton' => array(
				'widget_class'=>'DotbWidgetSubPanelTopScheduleCallButton',
				'module'=>'Calls',
				'title'=>'LBL_NEW_BUTTON_TITLE',
				'access_key'=>'LBL_NEW_BUTTON_KEY',
				'form_value'=>'LNK_NEW_CALL',
				'ACL'=>'edit',
			),
			'DotbWidgetSubPanelTopCreateTaskButton' => array(
				'widget_class'=>'DotbWidgetSubPanelTopCreateTaskButton',
				'module'=>'Tasks',
				'title'=>'LBL_NEW_BUTTON_TITLE',
				'access_key'=>'LBL_NEW_BUTTON_KEY',
				'form_value'=>'LNK_NEW_TASK',
				'ACL'=>'edit',
			),
			'DotbWidgetSubPanelTopCreateNoteButton' => array(
				'widget_class'=>'DotbWidgetSubPanelTopCreateNoteButton',
				'module'=>'Notes',
				'title'=>'LBL_NEW_BUTTON_TITLE',
				'access_key'=>'LBL_NEW_BUTTON_KEY',
				'form_value'=>'LNK_NEW_NOTE',
				'ACL'=>'edit',
			),
			'DotbWidgetSubPanelTopCreateContactAccountButton' => array(
				'widget_class'=>'DotbWidgetSubPanelTopButton',
				'module'=>'Contacts',
				'title'=>'LBL_NEW_BUTTON_TITLE',
				'access_key'=>'LBL_NEW_BUTTON_KEY',
				'form_value'=>'LBL_NEW_BUTTON_LABEL',
        		'additional_form_fields' => array(
        			'primary_address_street' => 'shipping_address_street',
					'primary_address_city' => 'shipping_address_city',
					'primary_address_state' => 'shipping_address_state',
					'primary_address_country' => 'shipping_address_country',
					'primary_address_postalcode' => 'shipping_address_postalcode',
					'to_email_addrs' => 'email1'
					),
				'ACL'=>'edit',
			),
			'DotbWidgetSubPanelTopCreateContact' => array(
				'widget_class'=>'DotbWidgetSubPanelTopButton',
				'module'=>'Contacts',
				'title'=>'LBL_NEW_BUTTON_TITLE',
				'access_key'=>'LBL_NEW_BUTTON_KEY',
				'form_value'=>'LBL_NEW_BUTTON_LABEL',
        		'additional_form_fields' => array(
        			'account_id' => 'account_id',
					'account_name' => 'account_name',
				),
				'ACL'=>'edit',
			),
			'DotbWidgetSubPanelTopCreateRevisionButton'=> array(
				'widget_class'=>'DotbWidgetSubPanelTopButton',
				'module'=>'DocumentRevisions',
				'title'=>'LBL_NEW_BUTTON_TITLE',
				'access_key'=>'LBL_NEW_BUTTON_KEY',
				'form_value'=>'LBL_NEW_BUTTON_LABEL',
        		'additional_form_fields' => array(
        			'parent_name'=>'document_name',
					'document_name' => 'document_name',
					'document_revision' => 'latest_revision',
					'document_filename' => 'filename',
        			'document_revision_id' => 'document_revision_id',
				),
				'ACL'=>'edit',
			),

			'DotbWidgetSubPanelTopCreateDirectReport' => array(
				'widget_class'=>'DotbWidgetSubPanelTopButton',
				'module'=>'Contacts',
				'title'=>'LBL_NEW_BUTTON_TITLE',
				'access_key'=>'LBL_NEW_BUTTON_KEY',
				'form_value'=>'LBL_NEW_BUTTON_LABEL',
        		'additional_form_fields' => array(
        			'reports_to_name' => 'name',
					'reports_to_id' => 'id',
				),
				'ACL'=>'edit',
			),
			'DotbWidgetSubPanelTopSelectFromReportButton' => array(
				'widget_class'=>'DotbWidgetSubPanelTopSelectReportsButton',
				'module'=>'Reports',
				'title'=>'LBL_SELECT_REPORTS_BUTTON_LABEL',
				'access_key'=>'LBL_SELECT_BUTTON_KEY',
				'form_value'=>'LBL_SELECT_REPORTS_BUTTON_LABEL',
				'ACL'=>'edit',
				'add_to_passthru_data'=>array (
					'return_type'=>'report',
				)
			),
			 'DotbWidgetSubPanelTopCreateAccountNameButton' => array(
                'widget_class'=>'DotbWidgetSubPanelTopCreateAccountNameButton',
                'module'=>'Contacts',
                'title'=>'LBL_NEW_BUTTON_TITLE',
                'access_key'=>'LBL_NEW_BUTTON_KEY',
                'form_value'=>'LBL_NEW_BUTTON_LABEL',
                'ACL'=>'edit',
            ),
			'DotbWidgetSubPanelAddToProspectListButton' => array(
				'widget_class'=>'DotbWidgetSubPanelTopSelectButton',
				'module'=>'ProspectLists',
				'title'=>'LBL_ADD_TO_PROSPECT_LIST_BUTTON_LABEL',
				'access_key'=>'LBL_ADD_TO_PROSPECT_LIST_BUTTON_KEY',
				'form_value'=>'LBL_ADD_TO_PROSPECT_LIST_BUTTON_LABEL',
				'ACL'=>'edit',
				'add_to_passthru_data'=>array (
					'return_type'=>'addtoprospectlist',
					'parent_module'=>'ProspectLists',
					'parent_type'=>'ProspectList',
					'child_id'=>'target_id',
					'link_attribute'=>'target_type',
					'link_type'=>'polymorphic',	 //polymorphic or default
				)
			),
		);

		$fieldDef = $this->getFieldDef($widget_def);
		if(!empty($fieldDef) &&  !empty($fieldDef['type']) && strtolower(trim($fieldDef['type'])) == 'multienum'){
				$widget_def['widget_class'] = 'Fieldmultienum';
		}
		if(!empty($fieldDef) &&  !empty($fieldDef['type']) && strtolower(trim($fieldDef['type'])) == 'bool'){
				$widget_def['widget_class'] = 'Fieldbool';
		}

        if($use_default) {
            switch($widget_def['name']) {
                case 'assigned_user_id':
                //bug 39170 - begin
                case 'created_by':
                case 'modified_user_id':
                case 'performed_user_id':
                //bug 39170 - end
                    $widget_def['widget_class'] = 'Fielduser_name';
                break;
                case 'team_id':
                    $widget_def['widget_class'] = 'Fieldteam_name';
                break;
                default:
                    if ( isset($widget_def['type']) ) {
                        $widget_def['widget_class'] = 'Field' . $widget_def['type'];
                    } else {
                        $widget_def['widget_class'] = 'Field' . $this->DBHelper->getFieldType($widget_def);
                    }
            }
        }

		if(!empty($widget_def['name']) && $widget_def['name'] == 'team_set_id'){
			$widget_def['widget_class'] = 'Fieldteam_set_id';
		}

		if(empty($widget_def['widget_class']))
		{
			// Default the class to DotbWidgetField
			$class_name = $this->widget_prefix.$this->default_widget_name;
		}
		else
		{
			$class_name = $this->widget_prefix.$widget_def['widget_class'];
		}

		// Check to see if this is one of the known class mappings.
		if(!empty($class_map[$class_name]))
		{
			if (empty($class_map[$class_name]['widget_class'])) {
				$widget = new DotbWidgetSubPanelTopButton($class_map[$class_name]);
			}  else {

				if (!class_exists($class_map[$class_name]['widget_class'])) {
					require_once('include/generic/DotbWidgets/'.$class_map[$class_name]['widget_class'].'.php');
				}

				$widget = new $class_map[$class_name]['widget_class']($class_map[$class_name]);
			}


			return $widget;
		}

		// At this point, we have a class name and we do not have a valid class defined.
		if(!class_exists($class_name))
		{
            DotbAutoLoader::requireWithCustom("include/generic/DotbWidgets/{$class_name}.php");
			if(!class_exists($class_name))
			{
				// If we still do not have a class, oops....
				die("LayoutManager: Class not found:".$class_name);
			}
		}

        $parent_bean = null;

        if (isset($widget_def['parent_bean']))
        {
            $parent_bean = $widget_def['parent_bean'];
        }
        elseif (isset($widget_def['focus']))
        {
            $parent_bean = $widget_def['focus'];
        }

		$widget = new $class_name($this); // cache disabled $this->getClassFromCache($class_name);
        $widget->setParentBean($parent_bean);
		return $widget;
	}

	// 27426
	function getFieldDef($widget_def){
        static $beanCache;
		if(!empty($widget_def['module']) &&!empty($GLOBALS['beanList'][$widget_def['module']]) && !empty($GLOBALS['beanFiles'][$GLOBALS['beanList'][$widget_def['module']]])){
            if (!isset($beanCache[$widget_def['module']])){
                $beanCache[$widget_def['module']] = BeanFactory::newBean($widget_def['module']);
            }
            $bean = $beanCache[$widget_def['module']];
            if (!empty($widget_def['name'])
                && !empty($bean->field_defs)
                && !empty($bean->field_defs[$widget_def['name']])) {
                return $bean->field_defs[$widget_def['name']];
			}
		}

		return null;
	}

	function widgetDisplay($widget_def, $use_default = false, $grabName = false, $grabId = false)
	{
		$theclass = $this->getClassFromWidgetDef($widget_def, $use_default);
 		$label = isset($widget_def['module']) ? $widget_def['module'] : '';
	    if ($theclass instanceof DotbWidgetSubPanelTopButton) {
            $label = $theclass->get_subpanel_relationship_name($widget_def);
	    }
		$theclass->setWidgetId($label);

		//#27426
		$fieldDef = $this->getFieldDef($widget_def);
		if(!empty($fieldDef) &&  !empty($fieldDef['type']) && strtolower(trim($fieldDef['type'])) == 'multienum'){
				$widget_def['fields']  = dotbArrayMerge($widget_def['fields'] , $fieldDef);
				$widget_def['fields']['module']  = $label;
		}
		//end

        if ($grabName) {
            return $theclass->getDisplayName();
        }
        if ($grabId) {
            return $theclass->getWidgetId();
        }

		return $theclass->display($widget_def, null, null);
	}

	function widgetQuery($widget_def, $use_default = false)
	{
		$theclass = $this->getClassFromWidgetDef($widget_def, $use_default);
//				_pp($theclass);
		return $theclass->query($widget_def);
	}

	// display an input field
	// module is the parent module of the def
	function widgetDisplayInput($widget_def, $use_default = false)
	{
		$theclass = $this->getClassFromWidgetDef($widget_def, $use_default);
		return $theclass->displayInput($widget_def);
	}

}

