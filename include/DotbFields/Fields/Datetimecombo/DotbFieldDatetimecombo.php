<?php




class DotbFieldDatetimecombo extends DotbFieldBase {

    function getEditViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex) {
        // Create Smarty variables for the Calendar picker widget
        if(!isset($displayParams['showMinutesDropdown'])) {
           $displayParams['showMinutesDropdown'] = false;
        }

        if(!isset($displayParams['showHoursDropdown'])) {
           $displayParams['showHoursDropdown'] = false;
        }

        if(!isset($displayParams['showNoneCheckbox'])) {
           $displayParams['showNoneCheckbox'] = false;
        }

        if(!isset($displayParams['showFormats'])) {
           $displayParams['showFormats'] = false;
        }

        global $timedate;
        $displayParams['dateFormat'] = $timedate->get_cal_date_format();

        $displayParams['timeFormat'] = $timedate->get_user_time_format();
        $this->setup($parentFieldArray, $vardef, $displayParams, $tabindex);
        return $this->fetch($this->findTemplate('EditView'));
    }

    function getImportViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex)
    {
        $displayParams['showFormats'] = true;
        return $this->getEditViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex);
    }

    function getSearchViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex) {

    	 if($this->isRangeSearchView($vardef)) {
           $displayParams['showMinutesDropdown'] = false;
           $displayParams['showHoursDropdown'] = false;
           $displayParams['showNoneCheckbox'] = false;
           $displayParams['showFormats'] = false;
	       global $timedate, $current_language;
	       $displayParams['dateFormat'] = $timedate->get_cal_date_format();
	       $displayParams['timeFormat'] = $timedate->get_user_time_format();

           $this->setup($parentFieldArray, $vardef, $displayParams, $tabindex);
           $id = isset($displayParams['idName']) ? $displayParams['idName'] : $vardef['name'];
           $this->ss->assign('original_id', "{$id}");
           $this->ss->assign('id_range', "range_{$id}");
           $this->ss->assign('id_range_start', "start_range_{$id}");
           $this->ss->assign('id_range_end', "end_range_{$id}");
           $this->ss->assign('id_range_choice', "{$id}_range_choice");
           return $this->fetch('include/DotbFields/Fields/Datetimecombo/RangeSearchForm.tpl');
        }

    	// Create Smarty variables for the Calendar picker widget
        if(!isset($displayParams['showMinutesDropdown'])) {
           $displayParams['showMinutesDropdown'] = false;
        }

        if(!isset($displayParams['showHoursDropdown'])) {
           $displayParams['showHoursDropdown'] = false;
        }

        if(!isset($displayParams['showNoneCheckbox'])) {
           $displayParams['showNoneCheckbox'] = false;
        }

        if(!isset($displayParams['showFormats'])) {
           $displayParams['showFormats'] = false;
        }

        global $timedate;
        $displayParams['dateFormat'] = $timedate->get_cal_date_format();

        $displayParams['timeFormat'] = $timedate->get_user_time_format();
        $this->setup($parentFieldArray, $vardef, $displayParams, $tabindex);
        return $this->fetch($this->findTemplate('SearchView'));
    }


    function getWirelessEditViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex) {
    	global $timedate;
    	$datetime_prefs = $GLOBALS['current_user']->getUserDateTimePreferences();
    	$datetime = explode(' ', $vardef['value']);

		// format date and time to db format
		$date_start = $timedate->swap_formats($datetime[0], $datetime_prefs['date'], $timedate->dbDayFormat);
    	$time_start = $timedate->swap_formats($datetime[1], $datetime_prefs['time'], $timedate->dbTimeFormat);

    	// pass date parameters to smarty
    	if ($datetime_prefs['date'] == 'Y-m-d' || $datetime_prefs['date'] == 'Y/m/d' || $datetime_prefs['date'] == 'Y.m.d'){
    		$this->ss->assign('field_order', 'YMD');
    	}
    	else if ($datetime_prefs['date'] == 'd-m-Y' || $datetime_prefs['date'] == 'd/m/Y' || $datetime_prefs['date'] == 'd.m.Y'){
    		$this->ss->assign('field_order', 'DMY');
    	}
    	else{
    		$this->ss->assign('field_order', 'MDY');
    	}
    	$this->ss->assign('date_start', $date_start);
    	// pass time parameters to smarty
    	$use_24_hours = stripos($datetime_prefs['time'], 'a') ? false : true;
    	$this->ss->assign('time_start', $time_start);
    	$this->ss->assign('use_meridian', $use_24_hours);

    	$this->setup($parentFieldArray, $vardef, $displayParams, $tabindex, false);
    	return $this->fetch($this->findTemplate('WirelessEditView'));
    }

	public function getEmailTemplateValue($inputField, $vardef, $context = null, $tabindex = 0){
        // This does not return a smarty section, instead it returns a direct value
        if(isset($context['notify_user'])) {
            $user = $context['notify_user'];
        } else {
            $user = $GLOBALS['current_user'];
        }
        return TimeDate::getInstance()->to_display_date_time($inputField, true, true, $user);
    }

    public function save($bean, $inputData, $field, $def, $prefix = '')
    {
        global $timedate;
        if ( !isset($inputData[$prefix.$field]) ) {
            //$bean->$field = '';
            return;
        }

        if(strpos($inputData[$prefix.$field], ' ') > 0) {
            if ($timedate->check_matching_format($inputData[$prefix.$field], TimeDate::DB_DATETIME_FORMAT)) {
	            $bean->$field = $inputData[$prefix.$field];
            } else {
                $bean->$field = $timedate->to_db($inputData[$prefix.$field]);
            }
        } else {
        	$GLOBALS['log']->error('Field ' . $prefix.$field . ' expecting datetime format, but got value: ' . $inputData[$prefix.$field]);
	        //Default to assume date format value
        	if ($timedate->check_matching_format($inputData[$prefix.$field], TimeDate::DB_DATE_FORMAT)) {
                $bean->$field = $inputData[$prefix.$field];
            } else {
                $bean->$field = $timedate->to_db_date($inputData[$prefix.$field]);
            }
        }
    }

    /**
     * @see DotbFieldBase::importSanitize()
     */
    public function importSanitize(
        $value,
        $vardef,
        $focus,
        ImportFieldSanitize $settings
        )
    {
        global $timedate;

        $format = $timedate->merge_date_time($settings->dateformat, $settings->timeformat);

        if ( !$timedate->check_matching_format($value, $format) ) {
            $parts = $timedate->split_date_time($value);
            if(empty($parts[0])) {
               $datepart = $timedate->getNow()->format($settings->dateformat);
            }
            else {
               $datepart = $parts[0];
            }
            if(empty($parts[1])) {
                $timepart = $timedate->fromTimestamp(0)->format($settings->timeformat);
            } else {
                $timepart = $parts[1];
                // see if we can get by stripping the seconds
                if(strpos($settings->timeformat, 's') === false) {
                    $sep = $timedate->timeSeparatorFormat($settings->timeformat);
                    // We are assuming here seconds are the last component, which
                    // is kind of reasonable - no sane time format puts seconds first
                    $timeparts = explode($sep, $timepart);
                    if(!empty($timeparts[2])) {
                        $timepart = join($sep, array($timeparts[0], $timeparts[1]));
                    }
                }
            }

            $value = $timedate->merge_date_time($datepart, $timepart);
            if ( !$timedate->check_matching_format($value, $format) ) {
                return false;
            }
        }

        try {
            $date = DotbDateTime::createFromFormat($format, $value, new DateTimeZone($settings->timezone));
            if ((int) $date->year < 100) {
                return false;
            }
        } catch(Exception $e) {
            return false;
        }
        return $date->asDb();
    }


    /**
     * Handles export field sanitizing for field type
     *
     * @param $value string value to be sanitized
     * @param $vardef array representing the vardef definition
     * @param $focus DotbBean object
     * @param $row Array of a row of data to be exported
     *
     * @return string sanitized value
     */
    public function exportSanitize($value, $vardef, $focus, $row=array())
    {
        $timedate =  TimeDate::getInstance();
        $db = DBManagerFactory::getInstance();
        //If it's in ISO format, convert it to db format
        if(preg_match('/(\d{4})\-?(\d{2})\-?(\d{2})T(\d{2}):?(\d{2}):?(\d{2})\.?\d*([Z+-]?)(\d{0,2}):?(\d{0,2})/i', $value)) {
           $value = $timedate->fromIso($value)->asDb();
        }
        $value = $timedate->to_display_date_time($db->fromConvert($value, 'datetime'));
        return preg_replace('/([pm|PM|am|AM]+)/', ' \1', $value);
    }

    /**
     * {@inheritDoc}
     */
    public function apiFormatField(
        array &$data,
        DotbBean $bean,
        array $args,
        $fieldName,
        $properties,
        array $fieldList = null,
        ServiceBase $service = null
    ) {
        global $timedate;
        $this->ensureApiFormatFieldArguments($fieldList, $service);

        if(empty($bean->$fieldName)) {
            $data[$fieldName] = '';
            return;
        }


        $date = $timedate->fromDb($bean->$fieldName);
        if ( $date == null ) {
            // The bean's date is not in db format, let's try user format
            $date = $timedate->fromUser($bean->$fieldName);
            if ( $date == null ) {
                // Can't parse this date..
                return;
            }
        }
        $data[$fieldName] = $timedate->asIso($date);
    }

    /**
     * @see DotbFieldBase::apiSave
     */
    public function apiSave(DotbBean $bean, array $params, $field, $properties) {
        global $timedate;

        if ( empty($params[$field]) ) {
            $bean->$field = '';
            return;
        }

        $date = $timedate->fromIso($params[$field]);
        if ( !$date ) {
            throw new DotbApiExceptionInvalidParameter("Did not recognize $field as a date/time, it looked like {$params[$field]}");
        }
        $bean->$field = $date->asDb();
    }


    /**
     * Unformat a value from an API Format
     * @param $value - the value that needs unformatted
     * @return string - the unformatted value
     */
    public function apiUnformatField($value)
    {
        $dotbField = DotbFieldHandler::getDotbField('datetime');
        return $dotbField->apiUnformatField($value);
    }

    /**
     * {@inheritdoc}
     */
    public function fixForFilter(&$value, $columnName, DotbBean $bean, DotbQuery $q, DotbQuery_Builder_Where $where, $op)
    {
        $dotbField = DotbFieldHandler::getDotbField('datetime');
        return $dotbField->fixForFilter($value, $columnName, $bean, $q, $where, $op);
    }
}
