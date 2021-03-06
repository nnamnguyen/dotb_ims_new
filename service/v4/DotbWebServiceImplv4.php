<?php
if(!defined('dotbEntry'))define('dotbEntry', true);


/**
 * This class is an implemenatation class for all the rest services
 */
require_once('service/v3_1/DotbWebServiceImplv3_1.php');
require_once('DotbWebServiceUtilv4.php');

use  Dotbcrm\Dotbcrm\Util\Arrays\ArrayFunctions\ArrayFunctions;

class DotbWebServiceImplv4 extends DotbWebServiceImplv3_1 {

    public function __construct()
    {
        self::$helperObject = new DotbWebServiceUtilv4();
    }

        /**
     * Log the user into the application
     *
     * @param UserAuth array $user_auth -- Set user_name and password (password needs to be
     *      in the right encoding for the type of authentication the user is setup for.  For Base
     *      dotb validation, password is the MD5 sum of the plain text password.
     * @param String $application -- The name of the application you are logging in from.  (Currently unused).
     * @param array $name_value_list -- Array of name value pair of extra parameters. As of today only 'language' and 'notifyonsave' is supported
     * @return Array - id - String id is the session_id of the session that was created.
     * 				 - module_name - String - module name of user
     * 				 - name_value_list - Array - The name value pair of user_id, user_name, user_language, user_currency_id, user_currency_name,
     *                                         - user_default_team_id, user_is_admin, user_default_dateformat, user_default_timeformat
     * @exception 'SoapFault' -- The SOAP error, if any
     */
    public function login($user_auth, $application, $name_value_list = array()){
        $GLOBALS['log']->info("Begin: DotbWebServiceImpl->login({$user_auth['user_name']}, $application, ". print_r($name_value_list, true) .")");
        global $dotb_config;
        $error = new SoapError();
        $user = BeanFactory::newBean('Users');
        $success = false;
        $authController = AuthenticationController::getInstance();

        if (!empty($user_auth['encryption']) && $user_auth['encryption'] === 'PLAIN' &&
            !$authController->authController instanceof IdMLDAPAuthenticate &&
            !$authController->authController instanceof OAuth2Authenticate) {
            $user_auth['password'] = md5($user_auth['password']);
        }
        $isLoginSuccess = (bool) $authController->login(
            $user_auth['user_name'],
            $user_auth['password'],
            ['passwordEncrypted' => true]
        );
        $usr_id=$user->retrieve_user_id($user_auth['user_name']);
        if($usr_id)
            $user->retrieve($usr_id);

        if ($isLoginSuccess)
        {
            if ($_SESSION['hasExpiredPassword'] =='1')
            {
                $error->set_error('password_expired');
                $GLOBALS['log']->fatal('password expired for user ' . $user_auth['user_name']);
                LogicHook::initialize();
                $GLOBALS['logic_hook']->call_custom_logic('Users', 'login_failed');
                self::$helperObject->setFaultObject($error);
                return;
            }
            if(!empty($user) && !empty($user->id) && !$user->is_group)
            {
                $success = true;
                global $current_user;
                $current_user = $user;
            }
        }
        else if($usr_id && isset($user->user_name) && ($user->getPreference('lockout') == '1'))
        {
            $error->set_error('lockout_reached');
            $GLOBALS['log']->fatal('Lockout reached for user ' . $user_auth['user_name']);
            LogicHook::initialize();
            $GLOBALS['logic_hook']->call_custom_logic('Users', 'login_failed');
            self::$helperObject->setFaultObject($error);
            return;
        } elseif (extension_loaded('mcrypt')
            && $authController->authController instanceof IdMLDAPAuthenticate
            && (empty($user_auth['encryption']) || $user_auth['encryption'] !== 'PLAIN')
        ) {
            $password = self::$helperObject->decrypt_string($user_auth['password']);
            $authController->loggedIn = false; // reset login attempt to try again with decrypted password
            if($authController->login($user_auth['user_name'], $password) && isset($_SESSION['authenticated_user_id']))
                $success = true;
        } elseif ($authController->authController instanceof IdMLDAPAuthenticate
            && (empty($user_auth['encryption']) || $user_auth['encryption'] == 'PLAIN')
        ) {
        	$authController->loggedIn = false; // reset login attempt to try again with md5 password
        	if($authController->login($user_auth['user_name'], md5($user_auth['password']), array('passwordEncrypted' => true))
        		&& isset($_SESSION['authenticated_user_id']))
        	{
        		$success = true;
        	}
        	else
        	{

	            $error->set_error('ldap_error');
	            LogicHook::initialize();
	            $GLOBALS['logic_hook']->call_custom_logic('Users', 'login_failed');
	            self::$helperObject->setFaultObject($error);
	            return;
        	}
        }


        if($success)
        {
            session_start();
            global $current_user;
            //$current_user = $user;
            self::$helperObject->login_success($name_value_list);
            $current_user->loadPreferences();
            $_SESSION['is_valid_session']= true;
            $_SESSION['ip_address'] = query_client_ip();
            $_SESSION['user_id'] = $current_user->id;
            $_SESSION['type'] = 'user';
            $_SESSION['avail_modules']= self::$helperObject->get_user_module_list($current_user);
            $_SESSION['authenticated_user_id'] = $current_user->id;
            $_SESSION['unique_key'] = $dotb_config['unique_key'];
            $GLOBALS['log']->info('End: DotbWebServiceImpl->login - successful login');
            $current_user->call_custom_logic('after_login');
            $nameValueArray = array();
            global $current_language;
            $nameValueArray['user_id'] = self::$helperObject->get_name_value('user_id', $current_user->id);
            $nameValueArray['user_name'] = self::$helperObject->get_name_value('user_name', $current_user->user_name);
            $nameValueArray['user_language'] = self::$helperObject->get_name_value('user_language', $current_language);
            $cur_id = $current_user->getPreference('currency');
            $nameValueArray['user_currency_id'] = self::$helperObject->get_name_value('user_currency_id', $cur_id);
            $nameValueArray['user_is_admin'] = self::$helperObject->get_name_value('user_is_admin', is_admin($current_user));
            $nameValueArray['user_default_team_id'] = self::$helperObject->get_name_value('user_default_team_id', $current_user->default_team );
            $nameValueArray['user_default_dateformat'] = self::$helperObject->get_name_value('user_default_dateformat', $current_user->getPreference('datef') );
            $nameValueArray['user_default_timeformat'] = self::$helperObject->get_name_value('user_default_timeformat', $current_user->getPreference('timef') );

            $num_grp_sep = $current_user->getPreference('num_grp_sep');
            $dec_sep = $current_user->getPreference('dec_sep');
            $nameValueArray['user_number_seperator'] = self::$helperObject->get_name_value('user_number_seperator', empty($num_grp_sep) ? $dotb_config['default_number_grouping_seperator'] : $num_grp_sep);
            $nameValueArray['user_decimal_seperator'] = self::$helperObject->get_name_value('user_decimal_seperator', empty($dec_sep) ? $dotb_config['default_decimal_seperator'] : $dec_sep);

            $nameValueArray['mobile_max_list_entries'] = self::$helperObject->get_name_value('mobile_max_list_entries', $dotb_config['wl_list_max_entries_per_page'] );
            $nameValueArray['mobile_max_subpanel_entries'] = self::$helperObject->get_name_value('mobile_max_subpanel_entries', $dotb_config['wl_list_max_entries_per_subpanel'] );

            if($application == 'mobile')
            {
                $availModules = ArrayFunctions::array_access_keys($_SESSION['avail_modules']); //ACL check already performed.
                $modules = self::$helperObject->get_visible_mobile_modules($availModules);
                $nameValueArray['available_modules'] = $modules;
                //Get the vardefs md5
                foreach($modules as $mod_def)
                    $availModuleNames[] = $mod_def['module_key'];

                $nameValueArray['vardefs_md5'] = self::get_module_fields_md5(session_id(), $availModuleNames);

                self::$helperObject->get_mobile_login_data($nameValueArray);
            }

            $currencyObject = BeanFactory::getBean('Currencies', $cur_id);
            $nameValueArray['user_currency_name'] = self::$helperObject->get_name_value('user_currency_name', $currencyObject->name);
            $_SESSION['user_language'] = $current_language;
            return array('id'=>session_id(), 'module_name'=>'Users', 'name_value_list'=>$nameValueArray);
        }
        LogicHook::initialize();
        $GLOBALS['logic_hook']->call_custom_logic('Users', 'login_failed');
        $error->set_error('invalid_login');
        self::$helperObject->setFaultObject($error);
        $GLOBALS['log']->error('End: DotbWebServiceImpl->login - failed login');
    }


	/**
	 * Retrieve a list of DotbBean's based on provided IDs. This API will not wotk with report module
	 *
	 * @param String $session -- Session ID returned by a previous call to login.
	 * @param String $module_name -- The name of the module to return records from.  This name should be the name the module was developed under (changing a tab name is studio does not affect the name that should be passed into this method)..
	 * @param Array $ids -- An array of DotbBean IDs.
	 * @param Array $select_fields -- A list of the fields to be included in the results. This optional parameter allows for only needed fields to be retrieved.
	 * @param Array $link_name_to_fields_array -- A list of link_names and for each link_name, what fields value to be returned. For ex.'link_name_to_fields_array' => array(array('name' =>  'email_addresses', 'value' => array('id', 'email_address', 'opt_out', 'primary_address')))
     * @param bool $trackView -- Should we track the record accessed.
	 * @return Array
	 *        'entry_list' -- Array - The records name value pair for the simple data types excluding link field data.
	 *	     'relationship_list' -- Array - The records link field data. The example is if asked about accounts email address then return data would look like Array ( [0] => Array ( [name] => email_addresses [records] => Array ( [0] => Array ( [0] => Array ( [name] => id [value] => 3fb16797-8d90-0a94-ac12-490b63a6be67 ) [1] => Array ( [name] => email_address [value] => hr.kid.qa@example.com ) [2] => Array ( [name] => opt_out [value] => 0 ) [3] => Array ( [name] => primary_address [value] => 1 ) ) [1] => Array ( [0] => Array ( [name] => id [value] => 403f8da1-214b-6a88-9cef-490b63d43566 ) [1] => Array ( [name] => email_address [value] => kid.hr@example.name ) [2] => Array ( [name] => opt_out [value] => 0 ) [3] => Array ( [name] => primary_address [value] => 0 ) ) ) ) )
	 * @exception 'SoapFault' -- The SOAP error, if any
	 */
    public function get_entries(
        $session,
        $module_name,
        $ids,
        $select_fields,
        $link_name_to_fields_array,
        $track_view = false
    ) {
	    $result = parent::get_entries($session, $module_name, $ids, $select_fields, $link_name_to_fields_array);
		$relationshipList = $result['relationship_list'];
		$returnRelationshipList = array();
		foreach($relationshipList as $rel){
			$link_output = array();
			foreach($rel as $row){
				$rowArray = array();
				foreach($row['records'] as $record){
					$rowArray[]['link_value'] = $record;
				}
				$link_output[] = array('name' => $row['name'], 'records' => $rowArray);
			}
			$returnRelationshipList[]['link_list'] = $link_output;
		}

		$result['relationship_list'] = $returnRelationshipList;
		return $result;
	}

	    /**
     * Retrieve a list of beans.  This is the primary method for getting list of DotbBeans from Dotb using the SOAP API.
     *
     * @param String $session -- Session ID returned by a previous call to login.
     * @param String $module_name -- The name of the module to return records from.  This name should be the name the module was developed under (changing a tab name is studio does not affect the name that should be passed into this method)..
     * @param String $query -- SQL where clause without the word 'where'
     * @param String $order_by -- SQL order by clause without the phrase 'order by'
     * @param integer $offset -- The record offset to start from.
     * @param Array  $select_fields -- A list of the fields to be included in the results. This optional parameter allows for only needed fields to be retrieved.
     * @param Array $link_name_to_fields_array -- A list of link_names and for each link_name, what fields value to be returned. For ex.'link_name_to_fields_array' => array(array('name' =>  'email_addresses', 'value' => array('id', 'email_address', 'opt_out', 'primary_address')))
    * @param integer $max_results -- The maximum number of records to return.  The default is the dotb configuration value for 'list_max_entries_per_page'
     * @param integer $deleted -- false if deleted records should not be include, true if deleted records should be included.
     * @return Array 'result_count' -- integer - The number of records returned
     *               'next_offset' -- integer - The start of the next page (This will always be the previous offset plus the number of rows returned.  It does not indicate if there is additional data unless you calculate that the next_offset happens to be closer than it should be.
     *               'entry_list' -- Array - The records that were retrieved
     *	     		 'relationship_list' -- Array - The records link field data. The example is if asked about accounts email address then return data would look like Array ( [0] => Array ( [name] => email_addresses [records] => Array ( [0] => Array ( [0] => Array ( [name] => id [value] => 3fb16797-8d90-0a94-ac12-490b63a6be67 ) [1] => Array ( [name] => email_address [value] => hr.kid.qa@example.com ) [2] => Array ( [name] => opt_out [value] => 0 ) [3] => Array ( [name] => primary_address [value] => 1 ) ) [1] => Array ( [0] => Array ( [name] => id [value] => 403f8da1-214b-6a88-9cef-490b63d43566 ) [1] => Array ( [name] => email_address [value] => kid.hr@example.name ) [2] => Array ( [name] => opt_out [value] => 0 ) [3] => Array ( [name] => primary_address [value] => 0 ) ) ) ) )
    * @exception 'SoapFault' -- The SOAP error, if any
    */
    public function get_entry_list(
        $session,
        $module_name,
        $query,
        $order_by,
        $offset,
        $select_fields,
        $link_name_to_fields_array,
        $max_results,
        $deleted = 0,
        $favorites = false
    ) {
        $GLOBALS['log']->info('Begin: DotbWebServiceImpl->get_entry_list');
        global  $beanList, $beanFiles;
        $error = new SoapError();
        $using_cp = false;
        if($module_name == 'CampaignProspects'){
            $module_name = 'Prospects';
            $using_cp = true;
        }
        if (!self::$helperObject->checkSessionAndModuleAccess($session, 'invalid_session', $module_name, 'read', 'no_access', $error)) {
            $GLOBALS['log']->error('End: DotbWebServiceImpl->get_entry_list - FAILED on checkSessionAndModuleAccess');
            return;
        } // if

        if (!self::$helperObject->checkQuery($error, $query, $order_by)) {
    		$GLOBALS['log']->info('End: DotbWebServiceImpl->get_entry_list');
        	return;
        } // if

        // If the maximum number of entries per page was specified, override the configuration value.
        if($max_results > 0){
            global $dotb_config;
            $dotb_config['list_max_entries_per_page'] = $max_results;
        } // if

        $seed = BeanFactory::newBean($module_name);

        if (!self::$helperObject->checkACLAccess($seed, 'list', $error, 'no_access')) {
            $GLOBALS['log']->error('End: DotbWebServiceImpl->get_entry_list - FAILED on checkACLAccess');
            return;
        } // if

        if($query == ''){
            $where = '';
        } // if
        if($offset == '' || $offset == -1){
            $offset = 0;
        } // if
        if($deleted){
            $deleted = -1;
        }
        if($using_cp){
            $response = $seed->retrieveTargetList($query, $select_fields, $offset,-1,-1,$deleted);
        }else
        {
            $response = self::$helperObject->get_data_list(
                $seed,
                $order_by,
                $query,
                $offset,
                -1,
                -1,
                $deleted,
                $favorites,
                false,
                $select_fields
            );
        } // else
        $list = $response['list'];

        $output_list = array();
        $linkoutput_list = array();

        foreach($list as $value) {
            if(isset($value->emailAddress)){
                $value->emailAddress->handleLegacyRetrieve($value);
            } // if
            $value->fill_in_additional_detail_fields();

            $output_list[] = self::$helperObject->get_return_value_for_fields($value, $module_name, $select_fields);
            if(!empty($link_name_to_fields_array)){
                $linkoutput_list[] = self::$helperObject->get_return_value_for_link_fields($value, $module_name, $link_name_to_fields_array);
            }
        } // foreach

        // Calculate the offset for the start of the next page
        $next_offset = $offset + sizeof($output_list);

		$returnRelationshipList = array();
		foreach($linkoutput_list as $rel){
			$link_output = array();
			foreach($rel as $row){
				$rowArray = array();
				foreach($row['records'] as $record){
					$rowArray[]['link_value'] = $record;
				}
				$link_output[] = array('name' => $row['name'], 'records' => $rowArray);
			}
			$returnRelationshipList[]['link_list'] = $link_output;
		}

		$totalRecordCount = $response['row_count'];
        if( !empty($dotb_config['disable_count_query']) )
            $totalRecordCount = -1;

        $GLOBALS['log']->info('End: DotbWebServiceImpl->get_entry_list - SUCCESS');
        return array('result_count'=>sizeof($output_list), 'total_count' => $totalRecordCount, 'next_offset'=>$next_offset, 'entry_list'=>$output_list, 'relationship_list' => $returnRelationshipList);
    } // fn

	/**
     * Retrieve the layout metadata for a given module given a specific type and view.
     *
     * @param String $session -- Session ID returned by a previous call to login.
     * @param array $module_name(s) -- The name of the module(s) to return records from.  This name should be the name the module was developed under (changing a tab name is studio does not affect the name that should be passed into this method)..
     * @return array $type The type(s) of views requested.  Current supported types are 'default' (for application) and 'wireless'
     * @return array $view The view(s) requested.  Current supported types are edit, detail, list, and subpanel.
     * @exception 'SoapFault' -- The SOAP error, if any
     */
    function get_module_layout($session, $a_module_names, $a_type, $a_view,$acl_check = TRUE, $md5 = FALSE){
    	$GLOBALS['log']->info('Begin: DotbWebServiceImpl->get_module_layout');

    	global  $beanList, $beanFiles;
    	$error = new SoapError();
        $results = array();
        foreach ($a_module_names as $module_name)
        {
            if (!self::$helperObject->checkSessionAndModuleAccess($session, 'invalid_session', $module_name, 'read', 'no_access', $error))
            {
                $GLOBALS['log']->error("End: DotbWebServiceImpl->get_module_layout for $module_name - FAILED on checkSessionAndModuleAccess");
                continue;
            }

            if( empty($module_name) )
                continue;

            $seed = BeanFactory::newBean($module_name);
            if( empty($seed) )
            	continue;

            foreach ($a_view as $view)
            {
                $aclViewCheck = (strtolower($view) == 'subpanel') ? 'DetailView' : ucfirst(strtolower($view)) . 'View';
                if(!$acl_check || $seed->ACLAccess($aclViewCheck, true) )
                {
                    foreach ($a_type as $type)
                    {
                        $a_vardefs = self::$helperObject->get_module_view_defs($module_name, $type, $view);
                        if($md5)
                            $results[$module_name][$type][$view] = md5(serialize($a_vardefs));
                        else
                            $results[$module_name][$type][$view] = $a_vardefs;
                    }
                }
            }
        }

        $GLOBALS['log']->info('End: DotbWebServiceImpl->get_module_layout ->> '.print_r($results,true) );

        return $results;
    }


	/**
     * Given a list of modules to search and a search string, return the id, module_name, along with the fields
     * We will support Accounts, Bug Tracker, Cases, Contacts, Leads, Opportunities, Project, ProjectTask, Quotes
     *
     * @param string $session			- Session ID returned by a previous call to login.
     * @param string $search_string 	- string to search
     * @param string[] $modules			- array of modules to query
     * @param int $offset				- a specified offset in the query
     * @param int $max_results			- max number of records to return
     * @param string $assigned_user_id	- a user id to filter all records by, leave empty to exclude the filter
     * @param string[] $select_fields   - An array of fields to return.  If empty the default return fields will be from the active list view defs.
     * @param bool $unified_search_only - A boolean indicating if we should only search against those modules participating in the unified search.
     * @param bool $favorites           - A boolean indicating if we should only search against records marked as favorites.
     * @return Array return_search_result 	- Array('Accounts' => array(array('name' => 'first_name', 'value' => 'John', 'name' => 'last_name', 'value' => 'Do')))
     * @exception 'SoapFault' -- The SOAP error, if any
     */
    function search_by_module($session, $search_string, $modules, $offset, $max_results,$assigned_user_id = '', $select_fields = array(), $unified_search_only = TRUE, $favorites = FALSE){
    	$GLOBALS['log']->info('Begin: DotbWebServiceImpl->search_by_module');
    	global  $beanList, $beanFiles;
    	global $dotb_config,$current_language;

    	$error = new SoapError();
    	$output_list = array();
    	if (!self::$helperObject->checkSessionAndModuleAccess($session, 'invalid_session', '', '', '', $error)) {
    		$error->set_error('invalid_login');
    		$GLOBALS['log']->error('End: DotbWebServiceImpl->search_by_module - FAILED on checkSessionAndModuleAccess');
    		return;
    	}
    	global $current_user;
    	if($max_results > 0){
    		$dotb_config['list_max_entries_per_page'] = $max_results;
    	}

    	require_once 'include/utils.php';
    	$usa = new UnifiedSearchAdvanced();
        if(!file_exists($cachefile = dotb_cached('modules/unified_search_modules.php'))) {
            $usa->buildCache();
        }

    	include $cachefile;
    	$modules_to_search = array();
    	$unified_search_modules['Users'] =   array('fields' => array());

    	$unified_search_modules['ProjectTask'] =   array('fields' => array());

        //If we are ignoring the unified search flag within the vardef we need to re-create the search fields.  This allows us to search
        //against a specific module even though it is not enabled for the unified search within the application.
        if( !$unified_search_only )
        {
            foreach ($modules as $singleModule)
            {
                if( !isset($unified_search_modules[$singleModule]) )
                {
                    $newSearchFields = array('fields' => self::$helperObject->generateUnifiedSearchFields($singleModule) );
                    $unified_search_modules[$singleModule] = $newSearchFields;
                }
            }
        }


        foreach($unified_search_modules as $module=>$data) {
        	if (in_array($module, $modules)) {
            	$modules_to_search[$module] = $beanList[$module];
        	} // if
        } // foreach

        $GLOBALS['log']->info('DotbWebServiceImpl->search_by_module - search string = ' . $search_string);

    	if(!empty($search_string) && isset($search_string)) {
    		$search_string = trim($GLOBALS['db']->quote(securexss(from_html(clean_string($search_string, 'UNIFIED_SEARCH')))));
        	foreach($modules_to_search as $name => $beanName) {
        		$where_clauses_array = array();
    			$unifiedSearchFields = array () ;
    			foreach ($unified_search_modules[$name]['fields'] as $field=>$def ) {
    				$unifiedSearchFields[$name] [ $field ] = $def ;
    				$unifiedSearchFields[$name] [ $field ]['value'] = $search_string;
    			}

    			$seed = BeanFactory::newBean($name);
    			require_once 'include/SearchForm/SearchForm2.php' ;
    			if ($beanName == "User"
    			    || $beanName == "ProjectTask"
    			    ) {
    				if(!self::$helperObject->check_modules_access($current_user, $seed->module_dir, 'read')){
    					continue;
    				} // if
    				if(!$seed->ACLAccess('ListView')) {
    					continue;
    				} // if
    			}

    			if ($beanName != "User"
    			    && $beanName != "ProjectTask"
    			    ) {
    				$searchForm = new SearchForm ($seed, $name ) ;

    				$searchForm->setup(array ($name => array()) ,$unifiedSearchFields , '' , 'saved_views' /* hack to avoid setup doing further unwanted processing */ ) ;
    				$where_clauses = $searchForm->generateSearchWhere() ;
    				require_once 'include/SearchForm/SearchForm2.php' ;
    				$searchForm = new SearchForm ($seed, $name ) ;

    				$searchForm->setup(array ($name => array()) ,$unifiedSearchFields , '' , 'saved_views' /* hack to avoid setup doing further unwanted processing */ ) ;
    				$where_clauses = $searchForm->generateSearchWhere() ;
    				$emailQuery = false;

    				$where = '';
    				if (count($where_clauses) > 0 ) {
    					$where = '('. implode(' ) OR ( ', $where_clauses) . ')';
    				}

    				$mod_strings = return_module_language($current_language, $seed->module_dir);

    				if(count($select_fields) > 0)
    				    $filterFields = $select_fields;
    				else {
    				    require DotbAutoLoader::loadWithMetafiles($seed->module_dir, 'listviewdefs');

        				$filterFields = array();
        				foreach($listViewDefs[$seed->module_dir] as $colName => $param) {
        	                if(!empty($param['default']) && $param['default'] == true)
        	                    $filterFields[] = strtolower($colName);
        	            }
        	            if (!in_array('id', $filterFields))
        	            	$filterFields[] = 'id';
    				}

    				//Pull in any db fields used for the unified search query so the correct joins will be added
    				$selectOnlyQueryFields = array();
    				foreach ($unifiedSearchFields[$name] as $field => $def){
    				    if( isset($def['db_field']) && !in_array($field,$filterFields) ){
    				        $filterFields[] = $field;
    				        $selectOnlyQueryFields[] = $field;
    				    }
    				}

    	            //Add the assigned user filter if applicable
    	            if (!empty($assigned_user_id) && isset( $seed->field_defs['assigned_user_id']) ) {
    	               $ownerWhere = $seed->getOwnerWhere($assigned_user_id);
    	               $where = "($where) AND $ownerWhere";
    	            }

    	            if( $beanName == "Employee" )
    	            {
    	                $where = "($where) AND users.deleted = 0 AND users.is_group = 0 AND users.employee_status = 'Active'";
    	            }

    	            $list_params = array();
    	            if( $seed->isFavoritesEnabled() && $favorites === TRUE )
    	            {
    	                $list_params['favorites'] = 2;
    	            }

                    $filterFields = self::$helperObject->checkFieldAccess($filterFields, $seed);
    				$ret_array = $seed->create_new_list_query('', $where, $filterFields, $list_params, 0, '', true, $seed, true);
    		        if(empty($params) or !is_array($params)) $params = array();
    		        if(!isset($params['custom_select'])) $params['custom_select'] = '';
    		        if(!isset($params['custom_from'])) $params['custom_from'] = '';
    		        if(!isset($params['custom_where'])) $params['custom_where'] = '';
    		        if(!isset($params['custom_order_by'])) $params['custom_order_by'] = '';
    				$main_query = $ret_array['select'] . $params['custom_select'] . $ret_array['from'] . $params['custom_from'] . $ret_array['where'] . $params['custom_where'] . $ret_array['order_by'] . $params['custom_order_by'];
    			} else {
    				if ($beanName == "User") {
    					$filterFields = array('id', 'user_name', 'first_name', 'last_name', 'email_address');
                        $filterFields = self::$helperObject->checkFieldAccess($filterFields, $seed);
    					$main_query = "select users.id, ea.email_address, users.user_name, first_name, last_name from users ";
    					$main_query = $main_query . " LEFT JOIN email_addr_bean_rel eabl ON eabl.bean_module = '{$seed->module_dir}'
    LEFT JOIN email_addresses ea ON (ea.id = eabl.email_address_id) ";
    					$main_query = $main_query . "where ((users.first_name like '{$search_string}') or (users.last_name like '{$search_string}') or (users.user_name like '{$search_string}') or (ea.email_address like '{$search_string}')) and users.deleted = 0 and users.is_group = 0 and users.employee_status = 'Active'";
    				} // if
    				if ($beanName == "ProjectTask") {
    					$filterFields = array('id', 'name', 'project_id', 'project_name');
                        $filterFields = self::$helperObject->checkFieldAccess($filterFields, $seed);
    					$main_query = "select {$seed->table_name}.project_task_id id,{$seed->table_name}.project_id, {$seed->table_name}.name, project.name project_name from {$seed->table_name} ";
    					$seed->add_team_security_where_clause($main_query);
    					$main_query .= "LEFT JOIN teams ON $seed->table_name.team_id=teams.id AND (teams.deleted=0) ";
    		            $main_query .= "LEFT JOIN project ON $seed->table_name.project_id = project.id ";
    		            $main_query .= "where {$seed->table_name}.name like '{$search_string}%'";
    				} // if
    			} // else

    			$GLOBALS['log']->info('DotbWebServiceImpl->search_by_module - query = ' . $main_query);
    	   		if($max_results < -1) {
    				$result = $seed->db->query($main_query);
    			}
    			else {
    				if($max_results == -1) {
    					$limit = $dotb_config['list_max_entries_per_page'];
    	            } else {
    	            	$limit = $max_results;
    	            }
    	            $result = $seed->db->limitQuery($main_query, $offset, $limit + 1);
    			}

    			$rowArray = array();
    			while($row = $seed->db->fetchByAssoc($result)) {
    				$nameValueArray = array();
    				foreach ($filterFields as $field) {
    				    if(in_array($field, $selectOnlyQueryFields))
    				        continue;
    					$nameValue = array();
    					if (isset($row[$field])) {
    						$nameValueArray[$field] = self::$helperObject->get_name_value($field, $row[$field]);
    					} // if
    				} // foreach
    				$rowArray[] = $nameValueArray;
    			} // while
    			$output_list[] = array('name' => $name, 'records' => $rowArray);
        	} // foreach

    	$GLOBALS['log']->info('End: DotbWebServiceImpl->search_by_module');
    	return array('entry_list'=>$output_list);
    	} // if
    	return array('entry_list'=>$output_list);
    } // fn


    /**
     * Get the base64 contents of a quote pdf.
     *
     * @param string $session   - Session ID returned by a previous call to login.
     * @param string $quote_id
     * @param string $pdf_format Either Standard or Invoice
     */
    function get_quotes_pdf($session, $quote_id, $pdf_format = 'Standard')
    {
        $GLOBALS['log']->info('Begin: DotbWebServiceImpl->get_quotes_pdf');
        global  $beanList, $beanFiles;
        global $dotb_config,$current_language;
        $GLOBALS['mod_strings'] = return_module_language($current_language, 'Quotes');

        $error = new SoapError();
        $output_list = array();
        if (!self::$helperObject->checkSessionAndModuleAccess($session, 'invalid_session', '', '', '', $error))
        {
            $error->set_error('invalid_login');
            $GLOBALS['log']->info('End: DotbWebServiceImpl->get_report_pdf');
            return;
        }

        $GLOBALS['disable_date_format'] = FALSE;
        $bean = BeanFactory::getBean('Quotes', $quote_id);
        $dotbpdfBean = DotbpdfFactory::loadDotbpdf($pdf_format, 'Quotes', $bean, array() );
        $dotbpdfBean->process();

        $pdfContents = $dotbpdfBean->Output('','S');
        $pdfContents = base64_encode($pdfContents);

        return array('file_contents' => $pdfContents);
    }


    /**
     * For a particular report, generate the associated pdf report.  All caching should be done
     * on the client side.
     *
     * @param string $session   - Session ID returned by a previous call to login.
     * @param string $report_id - The id of the report bean.
     *
     * @return array - file_contents key with pdf base64 encoded.
     *
     */
    function get_report_pdf($session, $report_id)
    {
        $GLOBALS['log']->info('Begin: DotbWebServiceImpl->get_report_pdf');
    	global  $beanList, $beanFiles;
    	global $dotb_config,$current_language;

    	$error = new SoapError();
    	$output_list = array();
    	if (!self::$helperObject->checkSessionAndModuleAccess($session, 'invalid_session', '', '', '', $error))
    	{
    		$error->set_error('invalid_login');
    		$GLOBALS['log']->info('End: DotbWebServiceImpl->get_report_pdf');
    		return;
    	}

        $GLOBALS['disable_date_format'] = FALSE;
    	require_once('modules/Reports/templates/templates_pdf.php');

    	$saved_report = BeanFactory::getBean('Reports', $report_id);

    	$contents = '';
    	if($saved_report->id != null)
    	{
    	    $reporter = new Report(html_entity_decode($saved_report->content));
    	    $reporter->layout_manager->setAttribute("no_sort",1);
    	    //Translate pdf to correct language
    	    $module_for_lang = $reporter->module;
    	    $mod_strings = return_module_language($current_language, 'Reports');

    	    //Generate actual pdf
    	    $report_filename = template_handle_pdf($reporter, false);

    	    //Get file pdf file contents
    	    $contents = self::$helperObject->get_file_contents_base64($report_filename, TRUE);
    	}

    	return array('file_contents' => $contents);

        $GLOBALS['log']->info('End: DotbWebServiceImpl->get_report_pdf');
    }

    /**
     * Get OAuth reqtest token
     */
    public function oauth_request_token()
    {
        $GLOBALS['log']->info('Begin: DotbWebServiceImpl->oauth_request_token');
        try {
	        $oauth = new DotbOAuthServer(rtrim($GLOBALS['dotb_config']['site_url'],'/').'/service/v4/rest.php');
	        $result = $oauth->requestToken()."&oauth_callback_confirmed=true&authorize_url=".$oauth->authURL();
        } catch(OAuthException $e) {
            $GLOBALS['log']->debug("OAUTH Exception: $e");
            $errorObject = new SoapError();
            $errorObject->set_error('invalid_login');
			self::$helperObject->setFaultObject($errorObject);
            $result = null;
        }
        $GLOBALS['log']->info('End: DotbWebServiceImpl->oauth_request_token');
        return $result;
    }

    /**
     * Get OAuth access token
     */
    public function oauth_access_token()
    {
        $GLOBALS['log']->info('Begin: DotbWebServiceImpl->oauth_access_token');
        try {
	        $oauth = new DotbOAuthServer();
	        $result = $oauth->accessToken();
        } catch(OAuthException $e) {
            $GLOBALS['log']->debug("OAUTH Exception: $e");
            $errorObject = new SoapError();
            $errorObject->set_error('invalid_login');
			self::$helperObject->setFaultObject($errorObject);
            $result = null;
        }
        $GLOBALS['log']->info('End: DotbWebServiceImpl->oauth_access_token');
        return $result;
    }

    public function oauth_access($session='')
    {
        $GLOBALS['log']->info('Begin: DotbWebServiceImpl->oauth_access');
        $error = new SoapError();
    	$output_list = array();
    	if (!self::$helperObject->checkSessionAndModuleAccess($session, 'invalid_session', '', '', '', $error)) {
    		$error->set_error('invalid_login');
    		$GLOBALS['log']->info('End: DotbWebServiceImpl->oauth_access');
    		$result = $error;
    	} else {
            $result = array('id'=>session_id());
    	}
        $GLOBALS['log']->info('End: DotbWebServiceImpl->oauth_access');
        return $result;
    }

    /**
     * Import emails from the SNIP service.
     *
     * @param String $session -- Session ID returned by a previous call to login.
     * @exception 'SoapFault' -- The SOAP error, if any
     */
    public function snip_import_emails($session, $email)
    {
        $GLOBALS['log']->info('Begin: DotbWebServiceImpl->import_emails');
        $error = new SoapError();
        // TODO: permissions?
        if (! self::$helperObject->checkSessionAndModuleAccess($session, 'invalid_session', '', '', '',  $error)) {
            $GLOBALS['log']->info('End: DotbWebServiceImpl->snip_import_emails denied.');
            return;
        } // if
        $snip = DotbSNIP::getInstance();
        $snip->importEmail($email);
        $GLOBALS['log']->info('End: DotbWebServiceImpl->snip_import_emails');
        return array('results' => TRUE, 'count' => 1, 'message' => '');
    }

    /**
     * Return new contact emails since $timestamp for current user
     * @param string $session
     * @param int $timestamp
     */
    public function snip_update_contacts($session, $timestamp)
    {
        $GLOBALS['log']->info('Begin: DotbWebServiceImpl->snip_update_contacts');
        $error = new SoapError();
        if (! self::$helperObject->checkSessionAndModuleAccess($session, 'invalid_session', '', 'read', 'no_access',  $error)) {
            $GLOBALS['log']->info('End: DotbWebServiceImpl->snip_update_contacts denied.');
            return;
        } // if

        $query = "SELECT DISTINCT ea.email_address as email  FROM email_addresses ea
        JOIN email_addr_bean_rel eabr ON ea.id=eabr.email_address_id
        WHERE ea.deleted=0 AND eabr.deleted=0 AND eabr.bean_module <> 'Users' AND eabr.bean_module <> 'Employees'
        ";
        if($timestamp) {
            $dbdate = gmdate($GLOBALS['timedate']->get_db_date_time_format(), $timestamp);
            $query .= " AND ea.date_modified >= '$dbdate'";

        }

        $seed = BeanFactory::newBean('Users');
        $res = $seed->db->query($query);
        $emails = array();
        while($row = $seed->db->fetchByAssoc($res)) {
                $emails[] = $row['email'];
        }
        return array('results' => $emails, 'count' => count($emails), 'message' => '');
    }

    /**
     * Get next job from the queue
     * @param string $session
     * @param string $clientid
     */
    public function job_queue_next($session, $clientid)
    {
        $GLOBALS['log']->info('Begin: DotbWebServiceImpl->job_queue_next');
        $error = new SoapError();
        if (! self::$helperObject->checkSessionAndModuleAccess($session, 'invalid_session', '', 'read', 'no_access',  $error)) {
            $GLOBALS['log']->info('End: DotbWebServiceImpl->job_queue_next denied.');
            return;
        }
        $queue = new DotbJobQueue();
        $job = $queue->nextJob($clientid);
        if(!empty($job)) {
            $jobid = $job->id;
        } else {
            $jobid = null;
        }
        $GLOBALS['log']->info('End: DotbWebServiceImpl->job_queue_next');
        return array("results" => $jobid);
    }

    /**
     * Run cleanup and schedule
     * @param string $session
     * @param string $clientid
     */
    public function job_queue_cycle($session, $clientid)
    {
        $GLOBALS['log']->info('Begin: DotbWebServiceImpl->job_queue_cycle');
        $error = new SoapError();
        if (! self::$helperObject->checkSessionAndModuleAccess($session, 'invalid_session', '', 'read', 'no_access',  $error)) {
            $GLOBALS['log']->info('End: DotbWebServiceImpl->job_queue_cycle denied.');
            return;
        }
        $queue = new DotbJobQueue();
        $queue->cleanup();
        $queue->runSchedulers();
        $GLOBALS['log']->info('End: DotbWebServiceImpl->job_queue_cycle');
        return array("results" => "ok");
    }

    /**
     * Run job from queue
     * @param string $session
     * @param string $jobid
     * @param string $clientid
     */
    public function job_queue_run($session, $jobid, $clientid)
    {
        $GLOBALS['log']->info('Begin: DotbWebServiceImpl->job_queue_run');
        $error = new SoapError();
        if (! self::$helperObject->checkSessionAndModuleAccess($session, 'invalid_session', '', 'read', 'no_access',  $error)) {
            $GLOBALS['log']->info('End: DotbWebServiceImpl->job_queue_run denied.');
            return;
        }
        $GLOBALS['log']->debug('Starting job $jobid execution as $clientid');
        $result = SchedulersJob::runJobId($jobid, $clientid);
        $GLOBALS['log']->info('End: DotbWebServiceImpl->job_queue_run');
        if($result === true) {
            return array("results" => true);
        } else {
            return array("results" => false, "message" => $result);
        }
    }
}

DotbWebServiceImplv4::$helperObject = new DotbWebServiceUtilv4();
