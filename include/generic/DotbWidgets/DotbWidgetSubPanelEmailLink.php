<?php





class DotbWidgetSubPanelEmailLink extends DotbWidgetField {

    public function displayList($layout_def)
    {
		global $current_user;
		global $beanList;
		global $focus;
		global $dotb_config;
		global $locale;

		if(isset($layout_def['varname'])) {
			$key = strtoupper($layout_def['varname']);
		} else {
			$key = $this->_get_column_alias($layout_def);
			$key = strtoupper($key);
		}
		$value = $layout_def['fields'][$key];



			if(isset($_REQUEST['action'])) $action = $_REQUEST['action'];
			else $action = '';

			if(isset($_REQUEST['module'])) $module = $_REQUEST['module'];
			else $module = '';

			if(isset($_REQUEST['record'])) $record = $_REQUEST['record'];
			else $record = '';

			if (!empty($focus->name)) {
				$name = $focus->name;
			} else {
				if( !empty($focus->first_name) && !empty($focus->last_name)) {
                    $name = $locale->formatName($focus);
					}
				if(empty($name)) {
					$name = '*';
				}
			}

			$userPref = $current_user->getPreference('email_link_type');
			$defaultPref = $dotb_config['email_default_client'];
			if($userPref != '') {
				$client = $userPref;
			} else {
				$client = $defaultPref;
			}

        if ($client === 'dotb' && ACLController::checkAccess('Emails', 'edit')) {
            $composeData = array(
                'load_id' => $layout_def['fields']['ID'],
                'load_module' => $this->layout_manager->defs['module_name'],
                'parent_type' => $this->layout_manager->defs['module_name'],
                'parent_id' => $layout_def['fields']['ID'],
                'return_module' => $module,
                'return_action' => $action,
                'return_id' => $record,
            );
            if (isset($layout_def['fields']['FULL_NAME'])) {
                $composeData['parent_name'] = $layout_def['fields']['FULL_NAME'];
                $composeData['to_email_addrs'] = sprintf(
                    '%s <%s>',
                    $layout_def['fields']['FULL_NAME'],
                    $layout_def['fields']['EMAIL']
                );
            } else {
                $composeData['to_email_addrs'] = $layout_def['fields']['EMAIL'];
            }
            $eUi = new EmailUI();
            $j_quickComposeOptions = $eUi->generateComposePackageForQuickCreate(
                $composeData,
                http_build_query($composeData),
                true
            );

            $link = "<a href='javascript:void(0);' onclick='DOTB.quickCompose.init($j_quickComposeOptions);'>";
        } else {
            $link = '<a href="mailto:' . $value . '" >';
        }

			return $link.$value.'</a>';

	}
} // end class def
