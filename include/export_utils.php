<?php


require_once 'modules/Teams/TeamSetManager.php';

use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;

/**
* gets the system default delimiter or an user-preference based override
* @return string the delimiter
*/
function getDelimiter()
{
    global $dotb_config;
    global $current_user;

    if (!empty($dotb_config['export_excel_compatible'])) {
        return "\t";
    }

    $delimiter = ','; // default to "comma"
    $userDelimiter = $current_user->getPreference('export_delimiter');
    $delimiter = empty($dotb_config['export_delimiter']) ? $delimiter : $dotb_config['export_delimiter'];
    $delimiter = empty($userDelimiter) ? $delimiter : $userDelimiter;

    return $delimiter;
}

/**
* builds up a delimited string for export
* @param string $type the bean-type to export
* @param array $records an array of records if coming directly from a query
* @param boolean $members
* @param boolean $sample return a sample of records for testing
* @return string delimited string for export
*/
function export($type, $records = null, $members = false, $sample = false)
{
    global $locale;
    global $beanList;
    global $beanFiles;
    global $current_user;
    global $app_strings;
    global $app_list_strings;
    global $timedate;
    global $mod_strings;
    global $current_language;
    $sampleRecordNum = 5;
    $fields_to_exclude = array();

    // Array of fields that should not be exported and are only used for logic
    $remove_from_members = array("ea_deleted", "ear_deleted", "primary_address");
    $focus = 0;

    $focus = BeanFactory::newBean($type);
    $searchFields = array();
    $db = DBManagerFactory::getInstance();

    if ($records) {
        $records = explode(',', $records);
        $records = "'" . implode("','", array_map(array($db,'quote'), $records)) . "'";
        $where = "{$focus->table_name}.id in ($records)";
    } elseif (isset($_REQUEST['all'])) {
        $where = '';
    } else {
        $current_post = InputValidation::getService()->getValidInputRequest(
            'current_post',
            array('Assert\PhpSerialized' => array('base64Encoded' => true))
        );

        if(!empty($current_post)) {
            $ret_array = generateSearchWhere($type, $current_post);
            $where = $ret_array['where'];
            $searchFields = $ret_array['searchFields'];
        } else {
            $where = '';
        }
    }

    if ($focus->bean_implements('ACL')) {
        if (!ACLController::checkAccess($focus->module_dir, 'export', true)) {
            ACLController::displayNoAccess();
            dotb_die('');
        }
        $tba = new TeamBasedACLConfigurator();
        $access = ACLAction::getUserAccessLevel($current_user->id, $focus->module_dir, 'export');
        if (ACLController::requireOwner($focus->module_dir, 'export')) {
            if (!empty($where)) {
                $where .= ' AND ';
            }
            $where .= $focus->getOwnerWhere($current_user->id);
        } elseif ($tba->isValidAccess($access)) {
            $focus->addVisibilityStrategy('TeamBasedACLVisibility');
        }
    }

    if ($focus->bean_implements('ACL')) {
        if (!ACLController::checkAccess($focus->module_dir, 'export', true)) {
            ACLController::displayNoAccess();
            dotb_die('');
        }
        $focus->addVisibilityWhere($where, array(
            'action' => 'list',
        ));
    }

    // Export entire list was broken because the where clause already has "where" in it
    // and when the query is built, it has a "where" as well, so the query was ill-formed.
    // Eliminating the "where" here so that the query can be constructed correctly.
    if ($members == true) {
        $query = $focus->create_export_members_query($records);
    } else {
        $beginWhere = substr(trim($where), 0, 5);
        if ($beginWhere == "where") {
            $where = substr(trim($where), 5, strlen($where));
        }

        // get the export query.  Note that $focus->fields_to_exclude is a temporary variable and is modified within
        // create_export_query(). $focus->fields_to_exclude will be used later by getExportContentFromResult() to
        // exclude fields from export.
        $focus->fields_to_exclude = array();
        $query = $focus->create_export_query('', $where);
    }

    $result = null;
    if ($sample) {
        $result = $db->limitQuery(
            $query,
            0,
            $sampleRecordNum,
            true,
            $app_strings['ERR_EXPORT_TYPE'] . $type . ": <BR>." . $query
        );
        $sample = $focus->_get_num_rows_in_query($query) < 1;
    } else {
        $result = $db->query($query, true, $app_strings['ERR_EXPORT_TYPE'] . $type . ": <BR>." . $query);
    }

    return getExportContentFromResult($focus, $result, $members, $remove_from_members, $sample);
}

/**
* to export sample records
* @param boolean args api argument
* @return string delimited string and description
*/
function exportSampleFromApi($args)
{
    global $app_strings;

    $args['all'] = true;

    //retrieve the export content
    $content = exportFromApi($args, true);

    //add details on removing the sample data
    return $content . $app_strings['LBL_IMPORT_SAMPLE_FILE_TEXT'];
}

/**
* builds up a delimited string for export
* @param boolean args api argument
* @param boolean sample whether it's sample export
* @return string delimited string for export
*/
function exportFromApi($args, $sample = false)
{
    global $current_user;
    global $app_strings;
    $sampleRecordNum = 5;

    $type = clean_string($args['module']);

    $recordList = RecordListFactory::getRecordList($args['record_list_id']);
    if (empty($recordList)) {
        throw new DotbApiExceptionNotFound();
    }
    $records = $recordList['records'];

    $members = isset($args['members']) ? $args['members'] : false;

    //Array of fields that should not be exported, and are only used for logic
    $remove_from_members = array("ea_deleted", "ear_deleted", "primary_address");

    $focus = BeanFactory::newBean($type);
    $searchFields = array();
    $db = DBManagerFactory::getInstance();

    if ($records) {
        // we take an array, but we'll make an exception for one record.
        if (!is_array($records)) {
            $records = array($records);
        }
        $records = "'" . implode("','", $records) . "'";
        $where = "{$focus->table_name}.id in ($records)";
    } elseif (isset($args['all'])) {
        $where = '';
    } else {
        // use filter to get data instead of building a sql
        if (!empty($args['filter'])) {
            $content = getExportContentFromFilter($args, $remove_from_members, $focus, $members);
            return $content;
        } else {
            $where = '';
        }
    }

    if ($focus->bean_implements('ACL')) {
        $tba = new TeamBasedACLConfigurator();
        $access = ACLAction::getUserAccessLevel($current_user->id, $focus->module_dir, 'export');
        if (ACLController::requireOwner($focus->module_dir, 'export')) {
            if (!empty($where)) {
                $where .= ' AND ';
            }
            $where .= $focus->getOwnerWhere($current_user->id);
        } elseif ($tba->isValidAccess($access)) {
            $focus->addVisibilityStrategy('TeamBasedACLVisibility');
        }
    }


    if ($focus->bean_implements('ACL')) {
        $focus->addVisibilityWhere($where, array(
            'action' => 'list',
        ));
    }

    // Export entire list was broken because the where clause already has "where" in it
    // and when the query is built, it has a "where" as well, so the query was ill-formed.
    // Eliminating the "where" here so that the query can be constructed correctly.
    if ($members == true) {
        $query = $focus->create_export_members_query($records);
    } else {
        $beginWhere = substr(trim($where), 0, 5);
        if ($beginWhere == "where") {
            $where = substr(trim($where), 5, strlen($where));
        }

        $query = $focus->create_export_query("", $where);
    }

    $result = null;
    if ($sample) {
        $result = $db->limitQuery(
            $query,
            0,
            $sampleRecordNum,
            true,
            $app_strings['ERR_EXPORT_TYPE'] . $type . ": <BR>." . $query
        );
        $sample = $focus->_get_num_rows_in_query($query) < 1;
    } else {
        $result = $db->query($query, true, $app_strings['ERR_EXPORT_TYPE'].$type.": <BR>.".$query);
    }

    $tagBean = BeanFactory::newBean("Tags");
    $relTags = $tagBean->getRelatedModuleRecords($focus, $records);
    if (isset($relTags)) {
        $options['relTags'] = $relTags;
    }

    $content = getExportContentFromResult($focus, $result, $members, $remove_from_members, $sample, $options);
    return $content;
}

/**
* This function uses filter to get the records to be exported.
*
* @param Mixed $args api arguments that include filter and module
* @param Mixed $remove_from_members member Array of header columns to filter out; empty by default
* @param DotbBean $focus dotb bean object
* @param bool $members used to indicate whether or not to apply filtering for header rows; false by default
* @return string
*/
function getExportContentFromFilter($args, $remove_from_members, $focus, $members = false)
{
    // call filter to get data
    $filterApi = new FilterApi();
    $api = new RestService();
    $nextOffset = 0;
    $records = array();
    $filterArgs = array('filter'=>$args['filter'], 'module'=>$args['module']);
    $filterArgs['max_num'] = 1000;
    while ($nextOffset != -1) {
        // still have records to be fetched
        $filterArgs['offset'] = $nextOffset;
        $data = $filterApi->filterList($api, $filterArgs);
        $records = array_merge($data['records'], $records);
        $nextOffset = $data['next_offset'];
    }

    foreach ($records as &$record) {
        foreach ($record as $name => $val) {
            if (is_array($record[$name])) {
                if ($name != 'team_name' && $name != 'email') {
                    // we do not need arrays like $record['_acl']
                    unset($record[$name]);
                }
            }
        }
    }

    if (is_array($records) && !empty($records)) {
        $fields_array = get_field_order_mapping($args['module'], array_keys($records[0]), true, true);
    } else {
        // no record found
        return '';
    }

    $delimiter = getDelimiter();

    //set up labels to be used for the header row
    $field_labels = array();
    foreach ($fields_array as $key => $dbName) {
        //Remove fields that are only used for logic
        if ($members && (in_array($dbName, $remove_from_members))) {
            continue;
        }
        //default to the db name of label does not exist
        $field_labels[$key] = translateForExport($dbName, $focus);
    }

    // set up the "header" line with proper delimiters
    $content = "\"".implode("\"". $delimiter ."\"", array_values($field_labels))."\"\r\n";

    foreach ($records as $record) {
        // team_name returned from filter is in array format, get team_id and team_name
        if (isset($record['team_name']) && is_array($record['team_name'])) {
            $firstTeam = true;
            $teamName = '';
            foreach ($record['team_name'] as $team) {
                if ($firstTeam) {
                    $teamName = $team['name'];
                    $firstTeam = false;
                } else {
                    $teamName .= ',' . $team['name'];
                }
                if ($team['primary']) {
                    $record['team_id'] = $team['id'];
                }
            }
            $record['team_name'] = $teamName;
        }
        // email returned from filter is in array format, get primary email address
        if (isset($record['email']) && is_array($record['email'])) {
            foreach ($record['email'] as $email) {
                if ($email['primary_address']) {
                    $record['email'] = $email['email_address'];
                    break;
                }
            }
        }

        $record = get_field_order_mapping($args['module'], $record, true, false);

        $new_arr = array();

        // replace user_name with full name if use_real_name preference setting is enabled
        // and this is a user name field
        $useRealNames = $GLOBALS['current_user']->getPreference('use_real_names');

        foreach ($record as $key => $value) {
            // getting content values depending on their types
            $fieldNameMapKey = $fields_array[$key];

            if (isset($focus->field_defs[$fieldNameMapKey])  && $focus->field_defs[$fieldNameMapKey]['type']) {
                $sfh = DotbFieldHandler::getDotbField($focus->field_defs[$fieldNameMapKey]['type']);
                $value = $sfh->exportSanitize($value, $focus->field_defs[$key], $focus);
            }

            if ($useRealNames) {
                $value = formatRealNameField($focus, $fields_array, $key, $value);
            }

            array_push($new_arr, preg_replace("/\"/", "\"\"", $value));
        } //foreach

        $line = implode("\"". $delimiter ."\"", $new_arr);
        $line = "\"" .$line;
        $line .= "\"\r\n";
        $content .= $line;
    }
    return $content;
}

/**
* getExportContentsFromResult
*
* This is a function to handle the processing of generating the export contents.
*
* @param Mixed $focus DotbBean instance we are retrieving export results for
* @param Mixed $result database result resource from the export SQL
* @param bool $members used to indicate whether or not to apply filtering for header rows; false by default
* @param array $remove_from_members Array of header columns to filter out; empty by default
* @param bool $populate boolean used to indicate whether or not to populate with test data; false by default
* @param array $options holds additional information including tags
* @return string
*/
function getExportContentFromResult(
    $focus,
    $result,
    $members = false,
    $remove_from_members = array(),
    $populate = false,
    $options = array()
) {

    global $current_user, $locale, $app_strings;
    $sampleRecordNum = 5;
    $delimiter = getDelimiter();
    $timedate = TimeDate::getInstance();
    $db = DBManagerFactory::getInstance();
    $fields_array = $db->getFieldsArray($result, true);

    // check if ID field is contained in query result
    $is_id_exported = in_array('id', $fields_array);

    // set up the order on the header row
    $fields_array = get_field_order_mapping($focus->module_dir, $fields_array, true, $focus->fields_to_exclude);

    //Remove ID, deleted collumns - By Lap Nguyen
    $isAdminUser = is_admin($current_user);
    if (!$isAdminUser) {
        foreach ($fields_array as $key => $dbname) {
            if($key == 'id' || $key == 'created_by' || strpos($key, '_id') || strpos($key, 'deleted') !== false)
                unset($fields_array[$key]);
        }
    }
    //END - By Lap Nguyen

    // set up labels to be used for the header row
    $field_labels = array();
    foreach ($fields_array as $key => $dbname) {
        // Remove fields that are only used for logic
        if ($members && (in_array($dbname, $remove_from_members))) {
            continue;
        }
        // default to the db name of label does not exist
        $field_labels[$key] = translateForExport($dbname, $focus);
    }

    $user_agent = (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : '';
    // Bug 60377 - Mac Excel doesn't support UTF-8
    if ($locale->getExportCharset() == 'UTF-8' &&
    ! preg_match('/macintosh|mac os x|mac_powerpc/i', $user_agent)
    ) {
        // Bug 55520 - add BOM to the exporting CSV so any symbols are displayed correctly in Excel
        $BOM = "\xEF\xBB\xBF";
        $content = $BOM;
    } else {
        $content = '';
    }

    $pre_id = '';

    if ($populate) {
        // Set up the "header" row with proper delimiters
        $content .= "\"" . implode("\"" . getDelimiter() . "\"", array_values($field_labels)) . "\"\r\n";
        // this is a sample request with no data, so create fake datarows
        $content .= returnFakeDataRow($focus, $fields_array, $sampleRecordNum);
    } else {
        $records = array();

        // process retrieved record
        while ($val = $db->fetchByAssoc($result, false)) {
            // order the values in the record array
            $val = get_field_order_mapping($focus->module_dir, $val);

            $new_arr = array();

            if (!$isAdminUser) {
                $focus->id = (!empty($val['id']))?$val['id']:'';
                $focus->assigned_user_id = (!empty($val['assigned_user_id']))?$val['assigned_user_id']:'' ;
                $focus->created_by = (!empty($val['created_by']))?$val['created_by']:'';
                $focus->ACLFilterFieldList($val, array(), array("blank_value" => true));
            }

            if ($members) {
                if ($is_id_exported && $pre_id == $val['id']) {
                    continue;
                }

                if (isset($val['ea_deleted']) && isset($val['primary_email_address']) &&
                ($val['ea_deleted'] == 1 || $val['ear_deleted'] == 1)) {
                    $val['primary_email_address'] = '';
                }
                unset($val['ea_deleted']);
                unset($val['ear_deleted']);
                unset($val['primary_address']);
            }
            $pre_id = $is_id_exported ? $val['id'] : '';


            // replace user_name with full name if use_real_name preference setting is enabled
            // and this is a user name field
            $useRealNames = $current_user->getPreference('use_real_names');

            foreach ($val as $key => $value) {
                // if key is not part of field map, then continue
                if (!isset($fields_array[$key])) {
                    continue;
                }
                // getting content values depending on their types
                $fieldNameMapKey = $fields_array[$key];

                if (isset($focus->field_defs[$fieldNameMapKey]) &&
                $focus->field_defs[$fieldNameMapKey]['type']
                ) {
                    $sfh = DotbFieldHandler::getDotbField($focus->field_defs[$fieldNameMapKey]['type']);
                    $sfh->setOptions($options);
                    $value = $sfh->exportSanitize($value, $focus->field_defs[$key], $focus, $val);
                }

                if ($key === 'tag' && $pre_id) {
                    $options[$pre_id] = $value;
                }

                if (isset($focus->field_defs[$fields_array[$key]]['custom_type']) &&
                $focus->field_defs[$fields_array[$key]]['custom_type'] == 'teamset' &&
                isset(Team::$nameTeamsetMapping[$fields_array[$key]])
                ) {
                    $primaryTeamId = '';
                    $fieldDefs = $focus->getFieldDefinition($fields_array[$key]);

                    if (!empty($fieldDefs['id_name']) && !empty($val[$fieldDefs['id_name']])) {
                        $primaryTeamId = $val[$fieldDefs['id_name']];
                    }
                    $value = TeamSetManager::getCommaDelimitedTeams(
                        $val[Team::$nameTeamsetMapping[$fields_array[$key]]],
                        $primaryTeamId
                    );
                }

                if ($useRealNames) {
                    $value = formatRealNameField($focus, $fields_array, $key, $value);
                }

                // Keep as $key => $value for post-processing
                $new_arr[$key] = str_replace('"', '""', $value);
            } //foreach

            // Use Bean ID as key for records if it exists
            if ($is_id_exported) {
                $records[$pre_id] = $new_arr;
            } else {
                $records[] = $new_arr;
            }
        }

        // Check if we're going to export non-primary emails
        if ($is_id_exported && $focus->hasEmails()) {
            // Add header column
            $field_labels['email_addresses_non_primary'] = translateForExport('email_addresses_non_primary', $focus);

            // $records keys are bean ids
            $keys = array_keys($records);

            $email_data = getNonPrimaryEmailsData($focus, $keys);
            foreach (array_keys($records) as $bean_id) {
                $records[$bean_id]['email_addresses_non_primary'] = isset($email_data[$bean_id])
                ? $email_data[$bean_id] : '';
            }
        }

        // Setup the "header" row with proper delimiters
        $content .= "\"" . implode("\"" . getDelimiter() . "\"", array_values($field_labels)) . "\"\r\n";

        // Write the export data
        foreach ($records as $record) {
            $line = implode("\"" . $delimiter . "\"", $record);
            $line = "\"" . $line;
            $line .= "\"\r\n";
            $content .= $line;
        }
    }

    return $content;
}

/**
* Returns non-primary emails for the given beans
*
* @param DotbBean $bean Bean instance
* @param array     $ids  Bean IDs
*
* @return array
*/
function getNonPrimaryEmailsData(DotbBean $bean, array $ids)
{
    // Split the ids array into chunks of size 100
    $chunks = array_chunk($ids, 100);

    // Attributes of non non-primary email that are about to be grouped later
    $non_primary_emails = array();

    foreach ($chunks as $chunk) {
        // Pick all the non-primary mails for the chunk
        $query = getNonPrimaryEmailsExportQuery($bean, $chunk);
        $data = $query->execute();

        foreach ($data as $row) {
            $non_primary_emails[$row['bean_id']][] = array(
                $row['email_address'],
                $row['invalid_email'] ? '1' : '0',
                $row['opt_out'] ? '1' : '0',
            );
        }
    }

    $result = array();
    foreach ($non_primary_emails as $bean_id => $emails) {
        $result[$bean_id] = serializeNonPrimaryEmails($emails);
    }

    return $result;
}

/**
* Generates query for fetching non-primary emails for the given beans
*
* @param DotbBean $bean Bean instance
* @param array     $ids  Bean IDs
*
* @return DotbQuery
*/
function getNonPrimaryEmailsExportQuery(DotbBean $bean, array $ids)
{
    $query = new DotbQuery();
    $query->from(BeanFactory::newBean('EmailAddresses'), array('alias' => 'ea'));
    $query->joinTable('email_addr_bean_rel', array(
        'joinType' => 'LEFT',
        'alias' => 'eabr',
        'linkingTable' => true,
    ))->on()->equalsField('eabr.email_address_id', 'id');
    $query->select('eabr.bean_id', 'email_address', 'invalid_email', 'opt_out');
    $query->where()
    ->in('eabr.bean_id', $ids)
    ->equals('eabr.bean_module', $bean->module_dir)
    ->notEquals('eabr.primary_address', 1)
    ->notEquals('eabr.deleted', 1);
    $query->orderBy('eabr.bean_id', 'ASC')
    ->orderBy('eabr.reply_to_address', 'ASC')
    ->orderBy('email_address', 'ASC');

    return $query;
}

/**
* Serializes non-primary email addresses of a single bean
*
* @param array $emails
*
* @return string
*/
function serializeNonPrimaryEmails(array $emails)
{
    $email_strings = array();
    foreach ($emails as $attrs) {
        $email_strings[] = implode(',', $attrs);
    }
    return implode(';', $email_strings);
}

function generateSearchWhere($module, $query)
{
    // this function is similar to the function prepareSearchForm() in view.list.php
    $seed = BeanFactory::newBean($module);
    if (file_exists('modules/' . $module . '/SearchForm.html')) {
        if (file_exists('modules/' . $module . '/metadata/SearchFields.php')) {
            require_once('include/SearchForm/SearchForm.php');
            $searchForm = new SearchForm($module, $seed);
        } elseif (!empty($_SESSION['export_where'])) {
            // bug 26026, sometimes some module doesn't have a metadata/SearchFields.php, the searchfrom is generated
            // in the ListView.php. Currently, massupdate will not generate the where sql. It will use the sql stored
            // in the SESSION. But this will cause bug 24722, and it cannot be avoided now.
            $where = $_SESSION['export_where'];
            $whereArr = explode(" ", trim($where));
            if ($whereArr[0] == trim('where')) {
                $whereClean = array_shift($whereArr);
            }
            $where = implode(" ", $whereArr);
            // rrs bug: 31329 - previously this was just returning $where, but the problem is this function's caller
            // expects the results in an array, not just a string. So rather than fixing the caller, I felt it would be
            // best for the function to return the results in a standard format.
            $ret_array['where'] = $where;
            $ret_array['searchFields'] =array();
            return $ret_array;
        } else {
            return;
        }
    } else {
        require_once('include/SearchForm/SearchForm2.php');

        $searchdefs_file = DotbAutoLoader::loadWithMetafiles($module, 'searchdefs');
        if ($searchdefs_file) {
            require $searchdefs_file;
        }

        $searchFields = DotbAutoLoader::loadSearchFields($module);
        if (empty($searchdefs) || empty($searchFields)) {
            // for some modules, such as iframe, it has massupdate, but it doesn't have search function,
            // the where sql should be empty.
            return;
        }
        $searchForm = getSearchForm($seed, $module);
        $searchForm->setup($searchdefs, $searchFields, 'SearchFormGeneric.tpl');
    }
    $searchForm->populateFromArray($query);
    $where_clauses = $searchForm->generateSearchWhere(true, $module);
    if (count($where_clauses) > 0) {
        $where = '(' . implode(' ) AND ( ', $where_clauses) . ')';
    }
    $GLOBALS['log']->info("Export Where Clause: {$where}");
    $ret_array['where'] = $where;
    $ret_array['searchFields'] = $searchForm->searchFields;
    return $ret_array;
}

/**
* Get search form - module specific, custom or default
* @param DotbBean $bean
* @param string $module
* @return SearchForm
*/
function getSearchForm($bean, $module)
{
    if (DotbAutoLoader::requireWithCustom("modules/$module/{$module}SearchForm.php")) {
        $searchFormClass = DotbAutoLoader::customClass("{$module}SearchForm");
    } else {
        DotbAutoLoader::requireWithCustom('include/SearchForm/SearchForm2.php');
        $searchFormClass = DotbAutoLoader::customClass('SearchForm');
    }
    return new $searchFormClass($bean, $module);
}

/**
* calls export method to build up a delimited string and some sample instructional text on how to use this file
* @param string type the bean-type to export
* @return string delimited string for export with some tutorial text
*/
function exportSample($type)
{
    global $app_strings;

    // first grab the
    $_REQUEST['all']=true;

    // retrieve the export content
    $content = export($type, null, false, true);

    // Add a new row and add details on removing the sample data
    // Our Importer will stop after he gets to the new row, ignoring the text below

    //edit by TKT
    return $content;

}

// this function will take in the bean and field mapping and return a proper value
function returnFakeDataRow($focus, $field_array, $rowsToReturn = 5)
{
    if (empty($focus) || empty($field_array)) {
        return ;
    }

    // include the file that defines $dotb_demodata
    include('install/demoData.en_us.php');

    $person_bean = false;
    if (isset($focus->first_name)) {
        $person_bean = true;
    }

    global $timedate;
    $returnContent = '';
    $counter = 0;
    $new_arr = array();

    // iterate through the record creation process as many times as defined.  Each iteration will create a new row
    while ($counter < $rowsToReturn) {
        $counter++;
        // go through each field and populate with dummy data if possible
        foreach ($field_array as $field_name) {
            if (empty($focus->field_defs[$field_name]) || empty($focus->field_defs[$field_name]['type'])) {
                // type is not set, fill in with empty string and continue;
                $returnContent .= '"",';
                continue;
            }
            $field = $focus->field_defs[$field_name];

            // fill in value according to type
            $type = $field['type'];

            switch ($type) {
                case "id":
                case "assigned_user_name":
                    // return new guid string
                    $returnContent .= '"' . create_guid() . '",';
                    break;
                case "int":
                    // return random number`
                    $returnContent .= '"' . mt_rand(0, 4) . '",';
                    break;
                case "name":
                    // return first, last, user name, or random name string
                    if ($field['name'] == 'first_name') {
                        $count = count($dotb_demodata['first_name_array']) - 1;
                        $returnContent .= '"' . $dotb_demodata['last_name_array'][mt_rand(0, $count)] . '",';
                    } elseif ($field['name'] == 'last_name') {
                        $count = count($dotb_demodata['last_name_array']) - 1;
                        $returnContent .= '"' . $dotb_demodata['last_name_array'][mt_rand(0, $count)] . '",';
                    } elseif ($field['name'] == 'user_name') {
                        $count = count($dotb_demodata['first_name_array']) - 1;
                        $returnContent .= '"' . $dotb_demodata['last_name_array'][mt_rand(0, $count)] .
                        '_' . mt_rand(1, 111) . '",';
                    } else {
                        // return based on bean
                        if ($focus->module_dir =='Accounts') {
                            $count = count($dotb_demodata['company_name_array']) - 1;
                            $returnContent .= '"'.$dotb_demodata['company_name_array'][mt_rand(0, $count)].'",';
                        } elseif ($focus->module_dir =='Bugs') {
                            $count = count($dotb_demodata['bug_seed_names']) - 1;
                            $returnContent .= '"'.$dotb_demodata['bug_seed_names'][mt_rand(0, $count)].'",';
                        } elseif ($focus->module_dir =='Notes') {
                            $count = count($dotb_demodata['note_seed_names_and_Descriptions']) - 1;
                            $returnContent .= '"' .
                            $dotb_demodata['note_seed_names_and_Descriptions'][mt_rand(0, $count)] . '",';
                        } elseif ($focus->module_dir =='Calls') {
                            $count = count($dotb_demodata['call_seed_data_names']) - 1;
                            $returnContent .= '"'.$dotb_demodata['call_seed_data_names'][mt_rand(0, $count)].'",';
                        } elseif ($focus->module_dir =='Tasks') {
                            $count = count($dotb_demodata['task_seed_data_names']) - 1;
                            $returnContent .= '"'.$dotb_demodata['task_seed_data_names'][mt_rand(0, $count)].'",';
                        } elseif ($focus->module_dir =='Meetings') {
                            $count = count($dotb_demodata['meeting_seed_data_names']) - 1;
                            $returnContent .= '"'.$dotb_demodata['meeting_seed_data_names'][mt_rand(0, $count)].'",';
                        } elseif ($focus->module_dir =='ProductCategories') {
                            $count = count($dotb_demodata['productcategory_seed_data_names']) - 1;
                            $returnContent .=
                            '"' . $dotb_demodata['productcategory_seed_data_names'][mt_rand(0, $count)] . '",';
                        } elseif ($focus->module_dir =='ProductTypes') {
                            $count = count($dotb_demodata['producttype_seed_data_names']) - 1;
                            $returnContent .=
                            '"' . $dotb_demodata['producttype_seed_data_names'][mt_rand(0, $count)] . '",';
                        } elseif ($focus->module_dir =='ProductTemplates') {
                            $count = count($dotb_demodata['producttemplate_seed_data']) - 1;
                            $returnContent .=
                            '"' . $dotb_demodata['producttemplate_seed_data'][mt_rand(0, $count)] . '",';
                        } else {
                            $returnContent .= '"Default Name for '.$focus->module_dir.'",';
                        }
                    }
                    break;
                case "relate":
                    if ($field['name'] == 'team_name') {
                        // apply team names and user_name
                        $teams_count = count($dotb_demodata['teams']) - 1;
                        $users_count = count($dotb_demodata['users']) - 1;
                        $returnContent .= '"' . $dotb_demodata['teams'][mt_rand(0, $teams_count)]['name'] . ',' .
                        $dotb_demodata['users'][mt_rand(0, $users_count)]['user_name'] . '",';
                    } else {
                        // apply GUID
                        $returnContent .= '"' . create_guid() . '",';
                    }
                    break;
                case "bool":
                    // return 0 or 1
                    $returnContent .= '"' . mt_rand(0, 1) . '",';
                    break;
                case "text":
                    // return random text
                    $returnContent .= '"Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas' .
                    ' porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus' .
                    ' malesuada libero, sit amet commodo magna eros quis urna",';
                    break;
                case "team_list":
                    $teams_count = count($dotb_demodata['teams']) - 1;
                    // give fake team names (East,West,North,South)
                    $returnContent .= '"' . $dotb_demodata['teams'][mt_rand(0, $teams_count)]['name'] . '",';
                    break;
                case "date":
                    // return formatted date
                    $timeStamp = strtotime('now');
                    $value =    date($timedate->dbDayFormat, $timeStamp);
                    $returnContent .= '"'.$timedate->to_display_date_time($value).'",';
                    break;
                case "datetime":
                case "datetimecombo":
                    // return formatted date time
                    $timeStamp = strtotime('now');
                    // Start with db date
                    $value = date($timedate->dbDayFormat.' '.$timedate->dbTimeFormat, $timeStamp);
                    // use timedate to convert to user display format
                    $value = $timedate->to_display_date_time($value);
                    // finally format the am/pm to have a space so it can be recognized as a date field in excel
                    $value = preg_replace('/([pm|PM|am|AM]+)/', ' \1', $value);
                    $returnContent .= '"' . $value . '",';
                    break;
                case "phone":
                    $value = '(' . mt_rand(300, 999) . ') ' . mt_rand(300, 999) . '-' . mt_rand(1000, 9999);
                    $returnContent .= '"' . $value . '",';
                    break;
                case "varchar":
                    // process varchar for possible values
                    if ($field['name'] == 'first_name') {
                        $count = count($dotb_demodata['first_name_array']) - 1;
                        $returnContent .= '"'.$dotb_demodata['last_name_array'][mt_rand(0, $count)].'",';
                    } elseif ($field['name'] == 'last_name') {
                        $count = count($dotb_demodata['last_name_array']) - 1;
                        $returnContent .= '"'.$dotb_demodata['last_name_array'][mt_rand(0, $count)].'",';
                    } elseif ($field['name'] == 'user_name') {
                        $count = count($dotb_demodata['first_name_array']) - 1;
                        $returnContent .=
                        '"'.$dotb_demodata['last_name_array'][mt_rand(0, $count)] . '_' . mt_rand(1, 111) . '",';
                    } elseif ($field['name'] == 'title') {
                        $count = count($dotb_demodata['titles']) - 1;
                        $returnContent .= '"'.$dotb_demodata['titles'][mt_rand(0, $count)].'",';
                    } elseif (strpos($field['name'], 'address_street') > 0) {
                        $count = count($dotb_demodata['street_address_array']) - 1;
                        $returnContent .= '"'.$dotb_demodata['street_address_array'][mt_rand(0, $count)].'",';
                    } elseif (strpos($field['name'], 'address_city') > 0) {
                        $count = count($dotb_demodata['city_array']) - 1;
                        $returnContent .= '"'.$dotb_demodata['city_array'][mt_rand(0, $count)].'",';
                    } elseif (strpos($field['name'], 'address_state') > 0) {
                        $state_arr = array('CA', 'NY', 'CO', 'TX', 'NV');
                        $count = count($state_arr) - 1;
                        $returnContent .= '"'.$state_arr[mt_rand(0, $count)].'",';
                    } elseif (strpos($field['name'], 'address_postalcode') > 0) {
                        $returnContent .= '"'.mt_rand(12345, 99999).'",';
                    } else {
                        $returnContent .= '"",';
                    }
                    break;
                case "url":
                    $returnContent .= '"https://www.dotbcrm.com",';
                    break;
                case "enum":
                    // get the associated enum if available
                    global $app_list_strings;

                    if (isset($focus->field_defs[$field_name]['type']) &&
                    !empty($focus->field_defs[$field_name]['options'])
                    ) {
                        if (!empty($app_list_strings[$focus->field_defs[$field_name]['options']])) {
                            // put the values into an array
                            $dd_values = $app_list_strings[$focus->field_defs[$field_name]['options']];
                            $dd_values = array_values($dd_values);

                            // grab the count
                            $count = count($dd_values) - 1;

                            // choose one at random
                            $returnContent .= '"' . $dd_values[mt_rand(0, $count)] . '",';
                        } else {
                            // name of enum options array was found but is empty, return blank
                            $returnContent .= '"",';
                        }
                    } else {
                        // name of enum options array was not found on field, return blank
                        $returnContent .= '"",';
                    }
                    break;
                default:
                    // type is not matched, fill in with empty string and continue;
                    $returnContent .= '"",';
            } // switch
        }
        $returnContent .= "\r\n";
    }
    return $returnContent;
}

// expects the field name to translate and a bean of the type being translated (to access field map and mod_strings)
function translateForExport($field_db_name, $focus)
{
    global $mod_strings, $app_strings;

    if (empty($field_db_name) || empty($focus)) {
        return false;
    }

    // grab the focus module strings
    $temp_mod_strings = $mod_strings;
    global $current_language;
    $mod_strings = return_module_language($current_language, $focus->module_dir);
    $fieldLabel = '';

    //!! first check to see if we are overriding the label for export.
    if (!empty($mod_strings['LBL_EXPORT_'.strtoupper($field_db_name)])) {
        //entry exists which means we are overriding this value for exporting, use this label
        $fieldLabel = $mod_strings['LBL_EXPORT_'.strtoupper($field_db_name)];
    } //!! next check to see if we are overriding the label for export on app_strings.
    elseif (!empty($app_strings['LBL_EXPORT_'.strtoupper($field_db_name)])) {
        // entry exists which means we are overriding this value for exporting, use this label
        $fieldLabel = $app_strings['LBL_EXPORT_'.strtoupper($field_db_name)];
    } // check to see if label exists in mapping and in mod strings
    elseif (!empty($focus->field_defs[$field_db_name]['vname']) &&
    !empty($mod_strings[$focus->field_defs[$field_db_name]['vname']])
    ) {
        $fieldLabel = $mod_strings[$focus->field_defs[$field_db_name]['vname']];
    } // check to see if label exists in mapping and in app strings
    elseif (!empty($focus->field_defs[$field_db_name]['vname']) &&
    !empty($app_strings[$focus->field_defs[$field_db_name]['vname']])
    ) {
        $fieldLabel = $app_strings[$focus->field_defs[$field_db_name]['vname']];
    } // field is not in mapping, so check to see if db can be uppercased and found in mod strings
    elseif (!empty($mod_strings['LBL_'.strtoupper($field_db_name)])) {
        $fieldLabel = $mod_strings['LBL_'.strtoupper($field_db_name)];
    } // check to see if db can be uppercased and found in app strings
    elseif (!empty($app_strings['LBL_'.strtoupper($field_db_name)])) {
        $fieldLabel = $app_strings['LBL_'.strtoupper($field_db_name)];
    } else {
        // we could not find the label in mod_strings or app_strings based on either a mapping entry
        // or on the db_name itself or being overwritten, so default to the db name as a last resort
        $fieldLabel = $field_db_name;
    }

    // strip the label of any columns
    $fieldLabel= preg_replace("/([:]|\xEF\xBC\x9A)[\\s]*$/", '', trim($fieldLabel));

    // reset the bean mod_strings back to original import strings
    $mod_strings = $temp_mod_strings;
    return $fieldLabel;
}

/**
* call this function to return the desired order to display columns for export in.
* if you pass in an array, it will reorder the array and send back to you.  It expects the array
* to have the db names as key values, or as labels
* @param string name the bean-type to export
* @param array reorderArr array containing desired order of field columns for export
* @param boolean exclude whether or not to exclude defined fields from export, defaults to true
* @param array passed_fields_to_exclude fields to be added to the default $fields_to_exclude array
* @return array array of fields to be used for export, with all the keys in lowercase
*/
function get_field_order_mapping($name = '', $reorderArr = '', $exclude = true, $passed_fields_to_exclude = array())
{

    $fields_to_exclude = array();
    $fields_to_exclude['accounts'] = array('account_name');
    $fields_to_exclude['cases'] = array('modified_by_name', 'modified_by_name_owner',
        'modified_by_name_mod', 'created_by_name', 'created_by_name_owner', 'created_by_name_mod',
        'assigned_user_name_owner', 'assigned_user_name_mod', 'team_count', 'team_count_owner', 'team_count_mod',
        'team_name_owner', 'team_name_mod', 'account_name_owner', 'account_name_mod', 'modified_user_name',
        'modified_user_name_owner', 'modified_user_name_mod');
    $fields_to_exclude['notes'] = array('first_name', 'last_name', 'file_mime_type', 'embed_flag');
    $fields_to_exclude['tasks'] = array('date_start_flag', 'date_due_flag');
    $field_to_exclude['forecastworksheet'] = array('version'=>'version');
    $field_to_exclude['forecastmanagerworksheet'] = array('version'=>'version', 'label'=>'label');

    // combine any passed in passed in fields to exclude from export
    if (!empty($passed_fields_to_exclude[strtolower($name)])) {
        foreach ($passed_fields_to_exclude[strtolower($name)] as $passed_in_field) {
            $fields_to_exclude[strtolower($name)][] = $passed_in_field;
        }
    }

    if (!empty($name) && !empty($reorderArr) && is_array($reorderArr)) {
        // make sure reorderArr has values as keys, if not then iterate through and assign the value as the key
        $newReorder = array();
        foreach ($reorderArr as $rk => $rv) {
            if (is_int($rk)) {
                $newReorder[$rv] = $rv;
            } else {
                $newReorder[strtolower($rk)] = $rv;
            }
        }

        // let's iterate through and create a reordered temporary array using
        // the newly formatted copy of the passed in array
        $temp_result_arr = array();
        $lname = strtolower($name);

        // add in all the leftover values that were not in our ordered list
        foreach ($newReorder as $nrk => $nrv) {
            $temp_result_arr[$nrk] = $nrv;
        }

        if ($exclude) {
            // Some arrays have values we wish to exclude
            if (isset($fields_to_exclude[$lname])) {
                foreach ($fields_to_exclude[$lname] as $exclude_field) {
                    unset($temp_result_arr[$exclude_field]);
                }
            }
        }

        // return temp ordered list
        return $temp_result_arr;
    }
}

/**
* This is a function to format User Name fields using global locale
*
* @param DotbBean $focus
* @param array  $fields_array field definitions array
* @param string $key   field name
* @param string $value field value
* @return string $value
*/
function formatRealNameField(DotbBean $focus, $fields_array, $key, $value)
{
    global $locale;

    if (!empty($focus->field_defs[$fields_array[$key]]['type']) &&
    $focus->field_defs[$fields_array[$key]]['type'] == 'relate' &&
    !empty($focus->field_defs[$fields_array[$key]]['module']) &&
    $focus->field_defs[$fields_array[$key]]['module'] == 'Users' &&
    !empty($focus->field_defs[$fields_array[$key]]['rname']) &&
    $focus->field_defs[$fields_array[$key]]['rname'] == 'full_name'
    ) {
        $userFocus = BeanFactory::newBean('Users');
        $userFocus->retrieve_by_string_fields(array('user_name' => $value ));
        if (!empty($userFocus->id)) {
            $value = $locale->formatName($userFocus);
        }
    }

    return $value;
}
