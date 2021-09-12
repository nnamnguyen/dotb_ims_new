<?php


    class DropDownBrowser
    {
        // Restrict the full dropdown list to remove some options that shouldn't be edited by the end users
        //TODO: this list needs to be kept in sync with $restrictedDropdowns in UpgradeDropdownsHelper::getDropdowns
        public static $restrictedDropdowns = array(
            'eapm_list',
            'eapm_list_documents',
            'eapm_list_import',
            'extapi_meeting_password',
            'Elastic_boost_options',
            'commit_stage_dom',
            'commit_stage_custom_dom',
            'commit_stage_binary_dom',
            'forecasts_config_ranges_options_dom',
            'forecasts_timeperiod_types_dom',
            'forecasts_chart_options_group',
            'forecasts_config_worksheet_layout_forecast_by_options_dom',
            'forecasts_timeperiod_options_dom',
            'generic_timeperiod_options',
            'moduleList', // We may want to put this in at a later date
            'moduleListSingular', // Same with this
            'sweetspot_theme_options',
        );

        //Add Education List Module - By Lap Nguyen
        public static $showKeywords = array(
            'band',
            'year_list',
            '_source_list',
            'bank',
            'utm',
            'gradebook',
            'h_w',
            '_of_course_list',
            'level',
            '_program_list',
            'oyalty',
        );


        function getNodes()
        {
            global $mod_strings, $app_list_strings;
            $nodes = array();
            //      $nodes[$mod_strings['LBL_EDIT_DROPDOWNS']] = array( 'name'=>$mod_strings['LBL_EDIT_DROPDOWNS'], 'action' =>'module=ModuleBuilder&action=globaldropdown&view_package=studio', 'imageTitle' => 'SPUploadCSS', 'help' => 'editDropDownBtn');
            //     $nodes[$mod_strings['LBL_ADD_DROPDOWN']] = array( 'name'=>$mod_strings['LBL_ADD_DROPDOWN'], 'action'=>'module=ModuleBuilder&action=globaldropdown&view_package=studio','imageTitle' => 'SPSync', 'help' => 'addDropDownBtn');

            $my_list_strings = $app_list_strings;
            foreach($my_list_strings as $key=>$value){
                if (!is_array($value) || array_filter($value, 'is_array')) {
                    unset($my_list_strings[$key]);
                }
            }

            foreach ( self::$restrictedDropdowns as $restrictedDropdown ) {
                unset($my_list_strings[$restrictedDropdown]);
            }

            $dropdowns = array_keys($my_list_strings);
            asort($dropdowns);

            //Add Education List Module - By Lap Nguyen
            foreach($dropdowns as $key=>$value){

                $res = self::strposa($value,self::$showKeywords, 1);
                if ($res === false) {
                    unset($dropdowns[$key]);
                }
            }


            foreach($dropdowns as $dd)
            {
                if (!empty($dd))
                {
                    $nodes[$dd] = array( 'name'=>$dd, 'action'=>"module=ModuleBuilder&action=dropdown&view_package=studio&dropdown_name=$dd",'imageTitle' => 'SPSync', 'help' => 'editDropDownBtn');
                }
            }
            return $nodes;
        }

        function strposa($haystack, $needles=array(), $offset=0) {
            $chr = array();
            foreach($needles as $needle) {
                $res = strpos($haystack, $needle, $offset);
                if ($res !== false) $chr[$needle] = $res;
            }
            if(empty($chr)) return false;
            return min($chr);
        }

    }
?>
