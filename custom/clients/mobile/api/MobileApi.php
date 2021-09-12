<?php

class MobileApi extends DotbApi
{
    function registerApiRest()
    {
        return array(
            'user-login' => array(
                'reqType' => 'POST',
                'path' => array('userlogin'),
                'pathVars' => array(''),
                'method' => 'user_login',
                'shortHelp' => '',
                'longHelp' => ''
            ),

            'user-regis' => array(
                'reqType' => 'POST',
                'path' => array('userregis'),
                'pathVars' => array(''),
                'method' => 'user_regis',
                'shortHelp' => '',
                'longHelp' => ''
            ),

            'create-record' => array(
                'reqType' => 'POST',
                'path' => array('createrecord'),
                'pathVars' => array(''),
                'method' => 'create_record',
                'shortHelp' => '',
                'longHelp' => ''
            ),

            'post-token' => array(
                'reqType' => 'POST',
                'path' => array('posttoken'),
                'pathVars' => array(''),
                'method' => 'post_token',
                'shortHelp' => '',
                'longHelp' => ''
            ),

            'save-comment' => array(
                'reqType' => 'POST',
                'path' => array('savecomment'),
                'pathVars' => array(''),
                'method' => 'save_comment',
                'shortHelp' => '',
                'longHelp' => ''
            ),

            'create-report' => array(
                'reqType' => 'POST',
                'path' => array('createreport'),
                'pathVars' => array(''),
                'method' => 'create_report',
                'shortHelp' => '',
                'longHelp' => ''
            ),

            'download_attachment' => array(
                'reqType' => 'GET',
                'path' => array('downloadattachment'),
                'pathVars' => array(''),
                'method' => 'download_attachment',
                'shortHelp' => '',
                'longHelp' => ''
            ),
        );
    }

    //push_elements on array_temp
    function push_elements(array $app)
    {
        $array_temp = array();
        foreach ($app as $key => $val) {
            if ($key != '') {
                $new_array = array(
                    'key' => (string)$key,
                    'value' => (string)$val,
                );
                $array_temp[] = $new_array;
            }
        }
        return $array_temp;
    }

    function getRole($user_id, $module_name){
        $role_id = ACLRole::getUserRoles($user_id, false)[0]->id;

        //0 not set, 1 normal, 99 admin
        $role = ACLRole::getRoleActions($role_id)['Leads']['module']['admin']['aclaccess'];

        if($user_id == 1 || $role == 99){
            return "";
        } elseif ($role == 0 || $role == 1){
            return " AND {$module_name}.team_set_id IN
        (SELECT
        tst.team_set_id
        FROM
        team_sets_teams tst
        INNER JOIN
        team_memberships team_memberships ON tst.team_id = team_memberships.team_id
        AND team_memberships.user_id = '{$user_id}'
        AND team_memberships.deleted = 0)";
        }
    }

    function getNotes(&$result, $where, $main_module, $sub_module = '')
    {
        if ($sub_module == '') {
            $select = "";
            if($main_module == 'contacts') $from = "INNER JOIN  notes ON {$main_module}.id=notes." . chop($main_module, 's') . "_id AND notes.deleted=0";
            else $from = "INNER JOIN notes ON {$main_module}.id=notes.parent_id AND notes.deleted=0 AND notes.parent_type = '" . ucfirst($main_module) . "'";
        } else {
            $select = "IFNULL({$sub_module}.id, '') {$sub_module}_id,";

            if ($sub_module == 'tasks' || ($main_module == 'accounts' && ($sub_module == 'calls' || $sub_module == 'meetings'))) {
                $from = "INNER JOIN  {$sub_module} ON {$main_module}.id={$sub_module}.parent_id AND {$sub_module}.deleted=0
 				AND {$sub_module}.parent_type = '" . ucfirst($main_module) . "'";
            } else if ($sub_module == 'opportunities' && $main_module == 'contacts') {
                $from = "INNER JOIN  {$sub_module}_{$main_module} lsub_main ON {$main_module}.id=lsub_main." . chop($main_module, 's') . "_id AND lsub_main.deleted=0
 				INNER JOIN  {$sub_module} ON {$sub_module}.id=lsub_main.opportunity_id AND {$sub_module}.deleted=0";
            }else if ($sub_module == 'opportunities' && $main_module == 'accounts') {
                $from = "INNER JOIN  {$main_module}_{$sub_module} lsub_main ON {$main_module}.id=lsub_main." . chop($main_module, 's') . "_id AND lsub_main.deleted=0
 				INNER JOIN  {$sub_module} ON {$sub_module}.id=lsub_main.opportunity_id AND {$sub_module}.deleted=0";
            } else {
                $from = "INNER JOIN {$sub_module}_{$main_module} lsub_main ON {$main_module}.id=lsub_main." . chop($main_module, 's') . "_id AND lsub_main.deleted=0
 				INNER JOIN  {$sub_module} ON {$sub_module}.id=lsub_main." . chop($sub_module, 's') . "_id AND {$sub_module}.deleted=0";
            }

            $from = $from . "\nINNER JOIN notes ON {$sub_module}.id=notes.parent_id AND notes.deleted=0
 				AND notes.parent_type = '" . ucfirst($sub_module) . "'";
        }

        $qNotes = "SELECT DISTINCT IFNULL({$main_module}.id,'') {$main_module}_id,
                   {$select}
                   IFNULL(notes.id, '') notes_id,
                   IFNULL(notes.created_by, '') created_by,
                   IFNULL(notes.modified_user_id, '') modified_user_id,
                   IFNULL(notes.assigned_user_id, '') assigned_user_id,
                   IFNULL(notes.date_entered, '') date_entered,
                   IFNULL(notes.date_modified, '') date_modified,
                   IFNULL(notes.name, '') notes_name,
                   IFNULL(notes.description, '') description,
                   IFNULL(notes.parent_type, '') parent_type,
                   IFNULL(notes.parent_id, '') parent_id,
                   IFNULL(notes.contact_id, '') notes_contact_id,
                   IFNULL(notes.filename, '') filename,
                   IFNULL(notes.file_mime_type, '') file_mime_type,
                   IFNULL(l_fav.id, '') favorites
                    FROM {$main_module} 
                    {$from}
                    LEFT JOIN dotbfavorites l_fav ON notes.id = l_fav.record_id AND l_fav.deleted=0 AND l_fav.module = 'Notes'
                    WHERE {$main_module}.deleted=0
                    {$where}
                    ORDER BY notes.date_modified DESC";
        $resultNotes = $GLOBALS['db']->query($qNotes);
        if ($sub_module == '')
            while ($row = $GLOBALS['db']->fetchByAssoc($resultNotes)) {
                $result[$row[$main_module . '_id']]['notes'][$row['notes_id']]['notes_id'] = $row['notes_id'];
                $result[$row[$main_module . '_id']]['notes'][$row['notes_id']]['created_by'] = $row['created_by'];
                $result[$row[$main_module . '_id']]['notes'][$row['notes_id']]['modified_user_id'] = $row['modified_user_id'];
                $result[$row[$main_module . '_id']]['notes'][$row['notes_id']]['assigned_user_id'] = $row['assigned_user_id'];
                $result[$row[$main_module . '_id']]['notes'][$row['notes_id']]['date_entered'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_entered']));
                $result[$row[$main_module . '_id']]['notes'][$row['notes_id']]['date_modified'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_modified']));
                $result[$row[$main_module . '_id']]['notes'][$row['notes_id']]['notes_name'] = $row['notes_name'];
                $result[$row[$main_module . '_id']]['notes'][$row['notes_id']]['description'] = $row['description'];
                $result[$row[$main_module . '_id']]['notes'][$row['notes_id']]['parent_type'] = $row['parent_type'];
                $result[$row[$main_module . '_id']]['notes'][$row['notes_id']]['parent_id'] = $row['parent_id'];
                $result[$row[$main_module . '_id']]['notes'][$row['notes_id']]['notes_contact_id'] = $row['notes_contact_id'];
                $result[$row[$main_module . '_id']]['notes'][$row['notes_id']]['filename'] = $row['filename'];
                $result[$row[$main_module . '_id']]['notes'][$row['notes_id']]['file_mime_type'] = $row['file_mime_type'];
                if ($row['favorites'] != "")
                    $result[$row[$main_module . '_id']]['notes'][$row['notes_id']]['favorites'] = true;
                else $result[$row[$main_module . '_id']]['notes'][$row['notes_id']]['favorites'] = false;
            }
        else
            while ($row = $GLOBALS['db']->fetchByAssoc($resultNotes)) {
                $result[$row[$main_module . '_id']][$sub_module][$row[$sub_module . '_id']]['notes'][$row['notes_id']]['notes_id'] = $row['notes_id'];
                $result[$row[$main_module . '_id']][$sub_module][$row[$sub_module . '_id']]['notes'][$row['notes_id']]['created_by'] = $row['created_by'];
                $result[$row[$main_module . '_id']][$sub_module][$row[$sub_module . '_id']]['notes'][$row['notes_id']]['modified_user_id'] = $row['modified_user_id'];
                $result[$row[$main_module . '_id']][$sub_module][$row[$sub_module . '_id']]['notes'][$row['notes_id']]['assigned_user_id'] = $row['assigned_user_id'];
                $result[$row[$main_module . '_id']][$sub_module][$row[$sub_module . '_id']]['notes'][$row['notes_id']]['date_entered'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_entered']));
                $result[$row[$main_module . '_id']][$sub_module][$row[$sub_module . '_id']]['notes'][$row['notes_id']]['date_modified'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_modified']));
                $result[$row[$main_module . '_id']][$sub_module][$row[$sub_module . '_id']]['notes'][$row['notes_id']]['notes_name'] = $row['notes_name'];
                $result[$row[$main_module . '_id']][$sub_module][$row[$sub_module . '_id']]['notes'][$row['notes_id']]['description'] = $row['description'];
                $result[$row[$main_module . '_id']][$sub_module][$row[$sub_module . '_id']]['notes'][$row['notes_id']]['parent_type'] = $row['parent_type'];
                $result[$row[$main_module . '_id']][$sub_module][$row[$sub_module . '_id']]['notes'][$row['notes_id']]['parent_id'] = $row['parent_id'];
                $result[$row[$main_module . '_id']][$sub_module][$row[$sub_module . '_id']]['notes'][$row['notes_id']]['notes_contact_id'] = $row['notes_contact_id'];
                $result[$row[$main_module . '_id']][$sub_module][$row[$sub_module . '_id']]['notes'][$row['notes_id']]['filename'] = $row['filename'];
                $result[$row[$main_module . '_id']][$sub_module][$row[$sub_module . '_id']]['notes'][$row['notes_id']]['file_mime_type'] = $row['file_mime_type'];
                if ($row['favorites'] != "")
                    $result[$row[$main_module . '_id']][$sub_module][$row[$sub_module . '_id']]['notes'][$row['notes_id']]['favorites'] = true;
                else $result[$row[$main_module . '_id']][$sub_module][$row[$sub_module . '_id']]['notes'][$row['notes_id']]['favorites'] = false;
            }

    }

    function getOpportunites(&$result, $where, $main_module)
    {
        if($main_module == 'accounts')
            $from = "accounts_opportunities";
        else $from = "opportunities_contacts";

        $qOpportunites = "SELECT IFNULL({$main_module}.id, '') {$main_module}_id,
				IFNULL(l1.id, '') opportunities_id,
				IFNULL(l1.created_by, '') created_by,
				IFNULL(l1.modified_user_id, '') modified_user_id,
				IFNULL(l1.assigned_user_id, '') assigned_user_id,
				IFNULL(l1.date_entered, '') date_entered,
				IFNULL(l1.date_modified, '') date_modified,
				IFNULL(l1.name, '') opportunities_name,
				IFNULL(l1.amount, '') amount,
				IFNULL(l1.date_closed, '') date_closed,
				IFNULL(l1.next_step, '') next_step,
				IFNULL(l1.description, '') description,
				IFNULL(l1.opportunity_type, '') opportunity_type,
				IFNULL(l1.lead_source, '') lead_source,
				IFNULL(l1.sales_stage, '') sales_stage,
				IFNULL(l1.sales_status, '') sales_status,
				IFNULL(l1.probability, '') probability,
				IFNULL(l1.best_case, '') best_case,
				IFNULL(l1.worst_case, '') worst_case,
				IFNULL(l1.commit_stage, '') commit_stage,
				IFNULL(l1.base_rate, '') base_rate,
                IFNULL(l_fav.id, '') favorites
				FROM {$main_module}
                INNER JOIN  {$from} l1_1 ON {$main_module}.id=l1_1." . chop($main_module, 's') . "_id AND l1_1.deleted=0
 				INNER JOIN  opportunities l1 ON l1.id=l1_1.opportunity_id AND l1.deleted=0
 				LEFT JOIN dotbfavorites l_fav ON l1.id = l_fav.record_id AND l_fav.deleted=0
                AND l_fav.module = 'Opportunities'
				WHERE {$main_module}.deleted = '0'
				{$where}
				ORDER BY l1.date_modified DESC";
        $resultOpportunites = $GLOBALS['db']->query($qOpportunites);
        while ($row = $GLOBALS['db']->fetchByAssoc($resultOpportunites)) {
            $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['id'] = $row['opportunities_id'];
            $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['created_by'] = $row['created_by'];
            $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['modified_user_id'] = $row['modified_user_id'];
            $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['assigned_user_id'] = $row['assigned_user_id'];
            $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['date_entered'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_entered']));
            $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['date_modified'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_modified']));
            $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['name'] = $row['opportunities_name'];
            $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['amount'] = $row['amount'];
            $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['date_closed'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_closed']));
            $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['next_step'] = $row['next_step'];
            $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['description'] = $row['description'];
            $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['opportunity_type'] = $row['opportunity_type'];
            $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['lead_source'] = $row['lead_source'];
            $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['sales_stage'] = $row['sales_stage'];
            $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['sales_status'] = $row['sales_status'];
            $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['probability'] = $row['probability'];
            $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['best_case'] = $row['best_case'];
            $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['worst_case'] = $row['worst_case'];
            $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['commit_stage'] = $row['commit_stage'];
            $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['base_rate'] = $row['base_rate'];
            if ($row['favorites'] != "")
                $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['favorites'] = true;
            else $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['favorites'] = false;
            $result[$row[$main_module . '_id']]['opportunities'][$row['opportunities_id']]['notes'] = array();
        }
    }

    function getTasks(&$result, $where, $main_module)
    {
        $qTasks = "SELECT IFNULL({$main_module}.id, '') {$main_module}_id,
				IFNULL(l2.id, '') tasks_id,
				IFNULL(l2.created_by, '') created_by,
				IFNULL(l2.modified_user_id, '') modified_user_id,
				IFNULL(l2.assigned_user_id, '') assigned_user_id,
				IFNULL(l2.date_entered, '') date_entered,
				IFNULL(l2.date_modified, '') date_modified,
                IFNULL(l2.name, '') tasks_name,
                IFNULL(l2.date_start, '') date_start,
                IFNULL(l2.date_due, '') date_due,
                IFNULL(l2.parent_type, '') parent_type,
                IFNULL(l2.parent_id, '') related_to,
                IFNULL(l2.description, '') description,
                IFNULL(l2.priority, '') priority,
                IFNULL(l2.status, '') tasks_status,
                IFNULL(l2.remind_email, '') remind_email,
                IFNULL(l2.remind_popup, '') remind_popup,
                IFNULL(l_fav.id, '') favorites
                FROM {$main_module}
                INNER JOIN  tasks l2 ON {$main_module}.id=l2.parent_id AND l2.deleted=0
 				AND l2.parent_type = '" . ucfirst($main_module) . "'
 				LEFT JOIN dotbfavorites l_fav ON l2.id = l_fav.record_id AND l_fav.deleted=0
                AND l_fav.module = 'Tasks'
                WHERE {$main_module}.deleted = '0'
                {$where}
                ORDER BY l2.date_start DESC";
        $resultTasks = $GLOBALS['db']->query($qTasks);
        while ($row = $GLOBALS['db']->fetchByAssoc($resultTasks)){
            $result[$row[$main_module . '_id']]['tasks'][$row['tasks_id']]['id'] = $row['tasks_id'];
            $result[$row[$main_module . '_id']]['tasks'][$row['tasks_id']]['created_by'] = $row['created_by'];
            $result[$row[$main_module . '_id']]['tasks'][$row['tasks_id']]['modified_user_id'] = $row['modified_user_id'];
            $result[$row[$main_module . '_id']]['tasks'][$row['tasks_id']]['assigned_user_id'] = $row['assigned_user_id'];
            $result[$row[$main_module . '_id']]['tasks'][$row['tasks_id']]['date_entered'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_entered']));
            $result[$row[$main_module . '_id']]['tasks'][$row['tasks_id']]['date_modified'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_modified']));
            $result[$row[$main_module . '_id']]['tasks'][$row['tasks_id']]['name'] = $row['tasks_name'];
            $result[$row[$main_module . '_id']]['tasks'][$row['tasks_id']]['date_start'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_start']));
            $result[$row[$main_module . '_id']]['tasks'][$row['tasks_id']]['date_due'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_due']));
            $result[$row[$main_module . '_id']]['tasks'][$row['tasks_id']]['parent_type'] = $row['parent_type'];
            $result[$row[$main_module . '_id']]['tasks'][$row['tasks_id']]['related_to'] = $row['related_to'];
            $result[$row[$main_module . '_id']]['tasks'][$row['tasks_id']]['description'] = $row['description'];
            $result[$row[$main_module . '_id']]['tasks'][$row['tasks_id']]['priority'] = $row['priority'];
            $result[$row[$main_module . '_id']]['tasks'][$row['tasks_id']]['status'] = $row['tasks_status'];
            $result[$row[$main_module . '_id']]['tasks'][$row['tasks_id']]['remind_email'] = $row['remind_email'];
            $result[$row[$main_module . '_id']]['tasks'][$row['tasks_id']]['remind_popup'] = $row['remind_popup'];
            if ($row['favorites'] != "")
                $result[$row[$main_module . '_id']]['tasks'][$row['tasks_id']]['favorites'] = true;
            else $result[$row[$main_module . '_id']]['tasks'][$row['tasks_id']]['favorites'] = false;
            $result[$row[$main_module . '_id']]['tasks'][$row['tasks_id']]['notes'] = array();
        }
    }

    function getCalls(&$result, $where, $main_module)
    {
        if($main_module == 'accounts')
            $from = "INNER JOIN  calls l3 ON accounts.id=l3.parent_id AND l3.deleted=0
 				AND l3.parent_type = 'Accounts'";
        else $from = "INNER JOIN  calls_{$main_module} l3_1 ON {$main_module}.id=l3_1." . chop($main_module, 's') . "_id AND l3_1.deleted=0
				INNER JOIN  calls l3 ON l3.id=l3_1.call_id AND l3.deleted=0";
        $qCalls = "SELECT IFNULL({$main_module}.id, '') {$main_module}_id,
				IFNULL(l3.id, '') calls_id,
				IFNULL(l3.created_by, '') created_by,
				IFNULL(l3.modified_user_id, '') modified_user_id,
				IFNULL(l3.assigned_user_id, '') assigned_user_id,
				IFNULL(l3.date_entered, '') date_entered,
				IFNULL(l3.date_modified, '') date_modified,
                IFNULL(l3.name, '') calls_name,
                IFNULL(l3.date_start, '') date_start,
                IFNULL(l3.date_end, '') date_end,
                IFNULL(l3.status, '') AS status,
                IFNULL(l3.parent_type, '') parent_type,
                IFNULL(l3.parent_id, '') related_to,
                IFNULL(l3.direction, '') direction,
                IFNULL(l3.description, '') description,
                IFNULL(l3.duration_hours, '') duration_hours,
                IFNULL(l3.duration_minutes, '') duration_minutes,
                IFNULL(l3.reminder_time, '') reminder_time,
                IFNULL(l3.call_result, '') call_result,
                IFNULL(l3.mark_favorite, '') mark_favorite,
                IFNULL(l3.move_trash, '') move_trash,
                IFNULL(l3.recall, '') recall,
                IFNULL(l3.recall_at, '') recall_at,
                IFNULL(l3.call_duration, '') call_duration,
                IFNULL(l3.duration, '') duration,
                IFNULL(l3.call_source, '') call_source,
                IFNULL(l3.call_destination, '') call_destination,
                IFNULL(l3.call_recording, '') call_recording,
                IFNULL(l3.call_entrysource, '') call_entrysource
                FROM {$main_module}
                {$from}
                WHERE {$main_module}.deleted = '0'
                {$where}
                ORDER BY l3.date_start DESC";
        $resultCalls = $GLOBALS['db']->query($qCalls);
        while ($row = $GLOBALS['db']->fetchByAssoc($resultCalls)) {
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['id'] = $row['calls_id'];
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['created_by'] = $row['created_by'];
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['modified_user_id'] = $row['modified_user_id'];
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['assigned_user_id'] = $row['assigned_user_id'];
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['date_entered'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_entered']));
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['date_modified'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_modified']));
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['name'] = $row['calls_name'];
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['date_start'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_start']));
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['date_end'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_end']));
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['status'] = $row['status'];
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['parent_type'] = $row['parent_type'];
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['related_to'] = $row['related_to'];
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['direction'] = $row['direction'];
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['description'] = $row['description'];
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['duration_hours'] = $row['duration_hours'];
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['duration_minutes'] = $row['duration_minutes'];
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['reminder_time'] = $row['reminder_time'];
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['call_result'] = $row['call_result'];
            if ($row['mark_favorite'] == "0")
                $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['mark_favorite'] = true;
            else $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['mark_favorite'] = false;
            if ($row['move_trash'] == "0")
                $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['move_trash'] = true;
            else $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['move_trash'] = false;
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['recall'] = $row['recall'];
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['recall_at'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['recall_at']));
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['call_duration'] = $row['call_duration'];
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['duration'] = $row['duration'];
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['call_source'] = $row['call_source'];
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['call_destination'] = $row['call_destination'];
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['call_recording'] = $row['call_recording'];
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['call_entrysource'] = $row['call_entrysource'];
            $result[$row[$main_module . '_id']]['calls'][$row['calls_id']]['notes'] = array();
        }
    }

    function getMeetings(&$result, $where, $main_module)
    {
        if($main_module == 'accounts')
            $from = "INNER JOIN  meetings l4 ON accounts.id=l4.parent_id AND l4.deleted=0
 				AND l4.parent_type = 'Accounts'";
        else $from = "INNER JOIN  meetings_{$main_module} l4_1 ON {$main_module}.id=l4_1." . chop($main_module, 's') . "_id AND l4_1.deleted=0
				INNER JOIN  meetings l4 ON l4.id=l4_1.meeting_id AND l4.deleted=0";

        $qMeetings = "SELECT IFNULL({$main_module}.id, '') {$main_module}_id,
				IFNULL(l4.id, '') meetings_id,
				IFNULL(l4.created_by, '') created_by,
				IFNULL(l4.modified_user_id, '') modified_user_id,
				IFNULL(l4.assigned_user_id, '') assigned_user_id,
				IFNULL(l4.date_entered, '') date_entered,
				IFNULL(l4.date_modified, '') date_modified,
                IFNULL(l4.name, '') meeting_name,
                IFNULL(l4.date_start, '') date_start,
                IFNULL(l4.date_end, '') date_end,
                IFNULL(l4.description, '') description,
                IFNULL(l4.reminder_time, '') reminder_time,
                IFNULL(l4.email_reminder_time, '') email_reminder_time,
                IFNULL(l4.repeat_type, '') repeat_type,
                IFNULL(l4.repeat_interval, '') repeat_interval,
                IFNULL(l4.repeat_until, '') repeat_until,
                IFNULL(l4.repeat_dow, '') repeat_dow,
                IFNULL(l4.repeat_count, '') repeat_count,
                IFNULL(l4.repeat_selector, '') repeat_selector,
                IFNULL(l4.repeat_days, '') repeat_days,
                IFNULL(l4.repeat_ordinal, '') repeat_ordinal,
                IFNULL(l4.repeat_parent_id, '') repeat_parent_id,
                IFNULL(l4.recurrence_id, '') recurrence_id,
                IFNULL(l4.type, '') meeting_type,
                IFNULL(l4.status, '') meeting_status,
                IFNULL(l4.location, '') location,
                IFNULL(l4.duration_hours, '') duration_hours,
                IFNULL(l4.duration_minutes, '') duration_minutes,
                IFNULL(l4.parent_id, '') parent_id,
                IFNULL(l4.parent_type, '') parent_type,
                IFNULL(l_fav.id, '') favorites
                FROM {$main_module}
                {$from}
				LEFT JOIN dotbfavorites l_fav ON l4.id = l_fav.record_id AND l_fav.deleted=0
                AND l_fav.module = 'Meetings'
                WHERE {$main_module}.deleted = '0'
                {$where}
                ORDER BY l4.date_start DESC";
        $resultMeetings = $GLOBALS['db']->query($qMeetings);
        while ($row = $GLOBALS['db']->fetchByAssoc($resultMeetings)) {
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['id'] = $row['meetings_id'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['created_by'] = $row['created_by'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['modified_user_id'] = $row['modified_user_id'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['assigned_user_id'] = $row['assigned_user_id'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['date_entered'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_entered']));
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['date_modified'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_modified']));
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['name'] = $row['meeting_name'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['date_start'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_start']));
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['date_end'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_end']));
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['description'] = $row['description'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['reminder_time'] = $row['reminder_time'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['email_reminder_time'] = $row['email_reminder_time'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['repeat_type'] = $row['repeat_type'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['repeat_interval'] = $row['repeat_interval'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['repeat_until'] = $row['repeat_until'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['repeat_dow'] = $row['repeat_dow'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['repeat_count'] = $row['repeat_count'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['repeat_selector'] = $row['repeat_selector'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['repeat_days'] = $row['repeat_days'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['repeat_ordinal'] = $row['repeat_ordinal'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['repeat_parent_id'] = $row['repeat_parent_id'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['recurrence_id'] = $row['recurrence_id'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['meeting_type'] = $row['meeting_type'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['meeting_status'] = $row['meeting_status'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['location'] = $row['location'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['duration_hours'] = $row['duration_hours'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['duration_minutes'] = $row['duration_minutes'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['parent_id'] = $row['parent_id'];
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['parent_type'] = $row['parent_type'];
            if ($row['favorites'] != "")
                $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['favorites'] = true;
            else $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['favorites'] = false;
//                $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['guests']['contacts'] = array();
//                $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['guests']['leads'] = array();
//                $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['guests']['users'] = array();
            $result[$row[$main_module . '_id']]['meetings'][$row['meetings_id']]['notes'] = array();
        }
    }

    function getAudit(&$result, $module_name){
        $index = 0;
        $qAudit = "SELECT IFNULL(l1.date_created, '') date_created,
        IFNULL(l1.parent_id, '') parent_id,
        IFNULL(l1.created_by, '') created_by,
        IFNULL(l1.field_name, '') field_name,
        IFNULL(l1.before_value_string, '') before_value_string,
        IFNULL(l1.after_value_string, '') after_value_string
        FROM {$module_name}_audit l1
        WHERE l1.date_created <> (
        SELECT l2.date_entered
        FROM {$module_name} l2
        WHERE l2.id = l1.parent_id)
        ORDER BY date_created DESC, parent_id ASC";
        $resultAudit = $GLOBALS['db']->query($qAudit);
        while($row = $GLOBALS['db']->fetchByAssoc($resultAudit)){
            $row['date_created'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_created']));
            $result[$module_name][$row['parent_id']][$row['created_by']][$row['date_created']]['fields'][$index]['field_name'] = $row['field_name'];
            $result[$module_name][$row['parent_id']][$row['created_by']][$row['date_created']]['fields'][$index]['before_value_string'] = $row['before_value_string'];
            $result[$module_name][$row['parent_id']][$row['created_by']][$row['date_created']]['fields'][$index]['after_value_string'] = $row['after_value_string'];
            $index++;
        }
    }

    function getMetaData($module_name){
        $bean = BeanFactory::getBean($module_name);
        $res = array();
        foreach ($bean->field_defs as $field){
            if(!isset($field['source'])){
                $res[] = array(
                    'field_name' => $field['name'],
                    'lang_vn' => return_module_language('vn_vn', $module_name)[$field['vname']],
                    'lang_en' => return_module_language('en_us', $module_name)[$field['vname']],
                    'type' => $field['type'],
                    'options' => $field['options'],
                );
            }
        }
        return $res;
    }

    function user_login(ServiceBase $api, array $args)
    {
        if (isset($args) && !empty($args)) {
            $user_name = $args['user_name'];
            $password = $args['password'];

            //Check Username credential
            $q1 = "SELECT IFNULL(users.id, '') primaryid,
                IFNULL(users.user_name, '') user_name,
                IFNULL(users.user_hash, '') password,
                IFNULL(users.picture, '') picture,
                IFNULL(users.first_name, '') first_name,
                IFNULL(users.last_name, '') last_name,
                IFNULL(users.title, '') title,
                IFNULL(users.phone_home, '') phone_home,
                IFNULL(users.phone_mobile, '') phone_mobile,
                IFNULL(users.phone_work, '') phone_work,
                IFNULL(users.address_street, '') address_street,
                IFNULL(users.address_city, '') address_city,
                IFNULL(users.address_country, '') address_country,
                IFNULL(users.reminder_time_default, '') reminder_time_default,
                IFNULL(l1.email_address, '') email,
                IFNULL(users.default_team, '') default_team,
                IFNULL(l2.name, '') roles_name
                FROM users
                LEFT JOIN  email_addr_bean_rel l1_1 ON users.id=l1_1.bean_id AND l1_1.deleted=0
                AND l1_1.bean_module = 'Users'
                LEFT JOIN  email_addresses l1 ON l1.id=l1_1.email_address_id AND l1.deleted=0
                LEFT JOIN acl_roles_users l2_1 ON l2_1.user_id = users.id AND l2_1.deleted=0
                LEFT JOIN acl_roles l2 ON l2_1.role_id = l2.id AND l2.deleted=0
                WHERE users.user_name = '$user_name'
                AND users.deleted = '0'
                AND users.status = 'Active'";

            $users = $GLOBALS['db']->fetchOne($q1);
            if (empty($users))
                return array(
                    'success' => false,
                    'message' => "invalid_username",
                );

            $users_info = array();

            //Check user_preferences
            global $current_user;
            $users_dateFormat = $current_user->getPreference('datef');
            $users_timeFormat = $current_user->getPreference('timef');
            $users_nameFormat = $current_user->getPreference('default_locale_name_format');
            //Check Password credential
            $pwdCheck = false;

            if (User::checkPassword($password, $users['password']) && !$pwdCheck) {
                $pwdCheck = true;
                //add users profile
                $users_info = $users;
                $users_info['password'] = $password;
                $users_info['dateformat'] = $users_dateFormat;
                $users_info['timeformat'] = $users_timeFormat;
                $users_info['nameformat'] = $users_nameFormat;
            }

            if (!$pwdCheck)
                return array(
                    'success' => false,
                    'message' => "invalid_password",
                );

            $default_team = $users['default_team'];
            $q2 = "SELECT IFNULL(id, '') primaryid,
                IFNULL(name, '') team_name,
                IFNULL(short_name, '') short_name,
                IFNULL(code_prefix, '') code_prefix,
                IFNULL(region, '') region,
                '123' balance
                FROM teams
                WHERE id = '$default_team'
                AND deleted = '0'";

            $users_default_team = $GLOBALS['db']->fetchOne($q2);

            if (empty($users_default_team)) {
                $users_info['default_team'] = [];
            } else {
                $users_info['default_team'] = $users_default_team;
            }

            //get member of teams
            $q2_1 = "SELECT IFNULL(users.id, '') user_id,
                IFNULL(users.last_name, '') last_name,
                IFNULL(users.first_name, '') first_name,
                IFNULL(users.picture, '') picture,
                IFNULL(l1.name, '') roles_name,
                IFNULL(users.title, '') title,
                IFNULL(users.phone_home, '') phone_home,
                IFNULL(users.phone_mobile, '') phone_mobile,
                IFNULL(users.phone_work, '') phone_work,
                IFNULL(users.address_street, '') address_street,
                IFNULL(users.address_city, '') address_city,
                IFNULL(users.address_country, '') address_country,
                IFNULL(l2.email_address, '') email,
                IFNULL(users.user_name, '') user_name,
                IFNULL(users.last_login, '') last_login
		        FROM users 
                LEFT JOIN acl_roles_users l1_1 ON l1_1.user_id = users.id AND l1_1.deleted=0
                LEFT JOIN acl_roles l1 ON l1_1.role_id = l1.id AND l1.deleted=0
                LEFT JOIN  email_addr_bean_rel l2_1 ON users.id=l2_1.bean_id AND l2_1.deleted=0
                AND l2_1.bean_module = 'Users'
                LEFT JOIN  email_addresses l2 ON l2.id=l2_1.email_address_id AND l2.deleted=0
		        WHERE users.deleted=0 AND users.default_team = '$default_team'";
            $member = array();
            $result2_1 = $GLOBALS['db']->query($q2_1);
            while ($row = $GLOBALS['db']->fetchByAssoc($result2_1)) {
                $member[$row['user_id']]['user_id'] = $row['user_id'];
                $row['last_name'] = ucwords($row['last_name'], " ");
                $row['first_name'] = ucwords($row['first_name'], " ");
                $member[$row['user_id']]['full_user_name'] = trim(ucwords($row['last_name'], " ") . ' ' . ucwords($row['first_name'], " "));
                $member[$row['user_id']]['picture'] = $row['picture'];
                $member[$row['user_id']]['roles'] = $row['roles_name'];
                $member[$row['user_id']]['title'] = $row['title'];
                $member[$row['user_id']]['phone_home'] = $row['phone_home'];
                $member[$row['user_id']]['phone_mobile'] = $row['phone_mobile'];
                $member[$row['user_id']]['phone_work'] = $row['phone_work'];
                $member[$row['user_id']]['address_street'] = $row['address_street'];
                $member[$row['user_id']]['address_city'] = $row['address_city'];
                $member[$row['user_id']]['address_country'] = $row['address_country'];
                $member[$row['user_id']]['email'] = $row['email'];
                $member[$row['user_id']]['user_name'] = $row['user_name'];
                $member[$row['user_id']]['last_login'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['last_login']));;
            }

            if (!empty($users_default_team)) {
                $users_info['default_team']['member'] = array_values($member);
//                $users_info['default_team']['payment_list'] = array_values($payment_list);
            }

            $users_primaryid = $users['primaryid'];
            //get Leads
            $roleLeads = $this->getRole($users_primaryid, 'leads');
            $q3 = "SELECT IFNULL(leads.id, '') primaryid,
                IFNULL(leads.created_by, '') created_by,
                IFNULL(leads.modified_user_id, '') modified_user_id,
                IFNULL(leads.assigned_user_id, '') assigned_user_id,
                IFNULL(leads.date_entered, '') date_entered,
                IFNULL(leads.date_modified, '') date_modified,
                IFNULL(leads.picture, '') picture,
                IFNULL(leads.salutation, '') salutation,
                IFNULL(leads.first_name, '') first_name,
                IFNULL(leads.last_name, '') last_name,
                IFNULL(l_fav.id,'') favorites,
                IFNULL(leads.status, '') lead_status,
                IFNULL(leads.title, '') title,
                IFNULL(leads.account_name, '') account_name,
                IFNULL(leads.phone_mobile, '') phone_mobile,
                IFNULL(leads.lead_source, '') lead_source,
                IFNULL(leads.website, '') website,
                IFNULL(l1.email_address,'') email,
                IFNULL(leads.birthdate, '') birthdate,
                IFNULL(leads.description, '') description,
                IFNULL(leads.international_name, '') international_name,
                IFNULL(leads.phone_work, '') phone_work,
                IFNULL(leads.industry, '') industry,
                IFNULL(leads.business_code, '') business_code,
                IFNULL(leads.phone_fax, '') phone_fax,
                IFNULL(leads.date_of_issue, '') date_of_issue,
                IFNULL(leads.opportunity_amount, '') opportunity_amount,
                IFNULL(leads.primary_address_street, '') primary_address_street,
                IFNULL(leads.pri_latitude, '') pri_latitude,
                IFNULL(leads.pri_longitude, '') pri_longitude,
                IFNULL(leads.department, '') department,
                IFNULL(leads.utm_source, '') utm_source,
                IFNULL(leads.do_not_call, '') do_not_call,
                IFNULL(leads.lead_source_description, '') lead_source_description
                FROM leads
                LEFT JOIN  email_addr_bean_rel l1_1 ON leads.id=l1_1.bean_id AND l1_1.deleted=0
                AND l1_1.bean_module = 'Leads' AND l1_1.primary_address = 1
                LEFT JOIN  email_addresses l1 ON l1.id=l1_1.email_address_id AND l1.deleted=0
                LEFT JOIN dotbfavorites l_fav ON leads.id = l_fav.record_id
                AND l_fav.deleted=0 AND l_fav.module = 'leads'
                WHERE leads.deleted=0
                {$roleLeads}
                ORDER BY leads.date_modified DESC";

            $leads = array();
            $result3 = $GLOBALS['db']->query($q3);
            while ($row = $GLOBALS['db']->fetchByAssoc($result3)) {
                $leads[$row['primaryid']]['primaryid'] = $row['primaryid'];
                $leads[$row['primaryid']]['created_by'] = $row['created_by'];
                $leads[$row['primaryid']]['modified_user_id'] = $row['modified_user_id'];
                $leads[$row['primaryid']]['assigned_user_id'] = $row['assigned_user_id'];
                $leads[$row['primaryid']]['date_entered'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_entered']));
                $leads[$row['primaryid']]['date_modified'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_modified']));
                $leads[$row['primaryid']]['picture'] = $row['picture'];
                $leads[$row['primaryid']]['salutation'] = $row['salutation'];
                $leads[$row['primaryid']]['first_name'] = $row['first_name'];
                $leads[$row['primaryid']]['last_name'] = $row['last_name'];
                $leads[$row['primaryid']]['name'] = trim(ucwords($row['last_name'], " ") . ' ' . ucwords($row['first_name'], " "));
                if ($row['favorites'] != "")
                    $leads[$row['primaryid']]['favorites'] = true;
                else $leads[$row['primaryid']]['favorites'] = false;
                $leads[$row['primaryid']]['status'] = $row['lead_status'];
                $leads[$row['primaryid']]['title'] = $row['title'];
                $leads[$row['primaryid']]['account_name'] = $row['account_name'];
                $leads[$row['primaryid']]['phone_mobile'] = $row['phone_mobile'];
                $leads[$row['primaryid']]['lead_source'] = $row['lead_source'];
                $leads[$row['primaryid']]['website'] = $row['website'];
                $leads[$row['primaryid']]['email'] = $row['email'];
                $leads[$row['primaryid']]['birthdate'] = $row['birthdate'];
                $diff = date_diff(date_create($row['birthdate']), date_create(date("Y-m-d")));
                $leads[$row['primaryid']]['age'] = $diff->format('%y');
                $leads[$row['primaryid']]['description'] = $row['description'];
                $leads[$row['primaryid']]['international_name'] = $row['international_name'];
                $leads[$row['primaryid']]['phone_work'] = $row['phone_work'];
                $leads[$row['primaryid']]['industry'] = $row['industry'];
                $leads[$row['primaryid']]['business_code'] = $row['business_code'];
                $leads[$row['primaryid']]['phone_fax'] = $row['phone_fax'];
                $leads[$row['primaryid']]['date_of_issue'] = $row['date_of_issue'];
                $leads[$row['primaryid']]['opportunity_amount'] = $row['opportunity_amount'];
                $leads[$row['primaryid']]['primary_address_street'] = $row['primary_address_street'];
                $leads[$row['primaryid']]['pri_latitude'] = $row['pri_latitude'];
                $leads[$row['primaryid']]['pri_longitude'] = $row['pri_longitude'];
                $leads[$row['primaryid']]['department'] = $row['department'];
                $leads[$row['primaryid']]['utm_source'] = $row['utm_source'];
                $leads[$row['primaryid']]['do_not_call'] = $row['do_not_call'];
                $leads[$row['primaryid']]['lead_source_description'] = $row['lead_source_description'];
                $leads[$row['primaryid']]['tasks'] = array();
                $leads[$row['primaryid']]['calls'] = array();
                $leads[$row['primaryid']]['meetings'] = array();
                $leads[$row['primaryid']]['notes'] = array();
            }

            //get leads_tasks
            $this->getTasks($leads, $roleLeads, "leads");

            //get leads_tasks_notes
            $this->getNotes($leads, $roleLeads, "leads", "tasks");

            //get leads_calls
            $this->getCalls($leads, $roleLeads, 'leads');

            //get leads_calls_notes
            $this->getNotes($leads, $roleLeads, 'leads', 'calls');

            //get leads_meetings
            $this->getMeetings($leads, $roleLeads, 'leads');

            //get leads_meetings_notes
            $this->getNotes($leads, $roleLeads, 'leads', 'meetings');

            //get leads_notes
            $this->getNotes($leads, $roleLeads, "leads");

            $users_info['leads'] = array_values($leads);
            foreach ($users_info['leads'] as $leads_id => $value) {
                $users_info['leads'][$leads_id]['tasks'] = array_values($users_info['leads'][$leads_id]['tasks']);
                $users_info['leads'][$leads_id]['calls'] = array_values($users_info['leads'][$leads_id]['calls']);
                $users_info['leads'][$leads_id]['meetings'] = array_values($users_info['leads'][$leads_id]['meetings']);

                foreach ($users_info['leads'][$leads_id]['tasks'] as $tasks_id => $value) {
                    $users_info['leads'][$leads_id]['tasks'][$tasks_id]['notes'] = array_values($users_info['leads'][$leads_id]['tasks'][$tasks_id]['notes']);
                }
                foreach ($users_info['leads'][$leads_id]['calls'] as $calls_id => $value) {
                    $users_info['leads'][$leads_id]['calls'][$calls_id]['notes'] = array_values($users_info['leads'][$leads_id]['calls'][$calls_id]['notes']);
                }
                foreach ($users_info['leads'][$leads_id]['meetings'] as $meetings_id => $value) {
//                    $users_info['leads'][$leads_id]['meetings'][$meetings_id]['guests']['contacts'] = array_values($users_info['leads'][$leads_id]['meetings'][$meetings_id]['guests']['contacts']);
//                    $users_info['leads'][$leads_id]['meetings'][$meetings_id]['guests']['leads'] = array_values($users_info['leads'][$leads_id]['meetings'][$meetings_id]['guests']['leads']);
//                    $users_info['leads'][$leads_id]['meetings'][$meetings_id]['guests']['users'] = array_values($users_info['leads'][$leads_id]['meetings'][$meetings_id]['guests']['users']);
                    $users_info['leads'][$leads_id]['meetings'][$meetings_id]['notes'] = array_values($users_info['leads'][$leads_id]['meetings'][$meetings_id]['notes']);
                }
                foreach ($users_info['leads'][$leads_id]['notes'] as $notes_id => $value) {
                    $users_info['leads'][$leads_id]['notes'] = array_values($users_info['leads'][$leads_id]['notes']);
                }
            }

            //get contacts
            $roleContacts = $this->getRole($users_primaryid, 'contacts');
            $q4 = "SELECT IFNULL(contacts.id, '') primaryid,
				IFNULL(contacts.created_by, '') created_by,
				IFNULL(contacts.modified_user_id, '') modified_user_id,
				IFNULL(contacts.assigned_user_id, '') assigned_user_id,
                IFNULL(contacts.date_entered, '') date_entered,
                IFNULL(contacts.date_modified, '') date_modified,
				IFNULL(l1.id, '') accounts_id,
				IFNULL(contacts.first_name, '') first_name, 
				IFNULL(contacts.last_name, '') last_name,
				IFNULL(contacts.phone_mobile, '') phone_mobile, 
				IFNULL(contacts.primary_address_street, '') primary_address_street, 
				IFNULL(contacts.primary_address_city, '') primary_address_city,
				IFNULL(contacts.pri_latitude, '') pri_latitude,
                IFNULL(contacts.pri_longitude, '') pri_longitude,
				IFNULL(contacts.lead_source, '') lead_source, 
				IFNULL(contacts.birthdate, '') birthdate, 
				IFNULL(contacts.picture, '') picture,
				IFNULL(contacts.title, '') title,
				IFNULL(contacts.department, '') department,
				IFNULL(contacts.description, '') description,
				IFNULL(l2.email_address, '') email,
                IFNULL(l_fav.id, '') favorites
				FROM contacts
                LEFT JOIN  accounts_contacts l1_1 ON contacts.id=l1_1.contact_id AND l1_1.deleted=0
 				AND l1_1.primary_account = 1 
				LEFT JOIN  accounts l1 ON l1.id=l1_1.account_id AND l1.deleted=0
				LEFT JOIN  email_addr_bean_rel l2_1 ON contacts.id=l2_1.bean_id AND l2_1.deleted=0
                AND l2_1.bean_module = 'Contacts' AND l2_1.primary_address = 1 
                LEFT JOIN  email_addresses l2 ON l2.id=l2_1.email_address_id AND l2.deleted=0
                LEFT JOIN dotbfavorites l_fav ON contacts.id = l_fav.record_id AND l_fav.deleted=0
                AND l_fav.module = 'Contacts'
				WHERE contacts.deleted = '0'
				{$roleContacts}
				ORDER BY contacts.date_modified DESC";
            $contacts = array();
            $result4 = $GLOBALS['db']->query($q4);
            while ($row = $GLOBALS['db']->fetchByAssoc($result4)) {
                $contacts[$row['primaryid']]['primaryid'] = $row['primaryid'];
                $contacts[$row['primaryid']]['created_by'] = $row['created_by'];
                $contacts[$row['primaryid']]['modified_user_id'] = $row['modified_user_id'];
                $contacts[$row['primaryid']]['assigned_user_id'] = $row['assigned_user_id'];
                $contacts[$row['primaryid']]['date_entered'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_entered']));
                $contacts[$row['primaryid']]['date_modified'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_modified']));
                $contacts[$row['primaryid']]['accounts_id'] = $row['accounts_id'];
                $contacts[$row['primaryid']]['first_name'] = $row['first_name'];
                $contacts[$row['primaryid']]['last_name'] = $row['last_name'];
                $contacts[$row['primaryid']]['name'] = trim(ucwords($row['last_name'], " ") . ' ' . ucwords($row['first_name'], " "));
                $contacts[$row['primaryid']]['phone_mobile'] = $row['phone_mobile'];
                $contacts[$row['primaryid']]['primary_address_street'] = $row['primary_address_street'];
                $contacts[$row['primaryid']]['primary_address_city'] = $row['primary_address_city'];
                $contacts[$row['primaryid']]['pri_latitude'] = $row['pri_latitude'];
                $contacts[$row['primaryid']]['pri_longitude'] = $row['pri_longitude'];
                $contacts[$row['primaryid']]['lead_source'] = $row['lead_source'];
                $contacts[$row['primaryid']]['birthdate'] = $row['birthdate'];
                $diff = date_diff(date_create($row['birthdate']), date_create(date("Y-m-d")));
                $contacts[$row['primaryid']]['age'] = $diff->format('%y');
                $contacts[$row['primaryid']]['picture'] = $row['picture'];
                $contacts[$row['primaryid']]['title'] = $row['title'];
                $contacts[$row['primaryid']]['department'] = $row['department'];
                $contacts[$row['primaryid']]['description'] = $row['description'];
                $contacts[$row['primaryid']]['email'] = $row['email'];
                if ($row['favorites'] != "")
                    $contacts[$row['primaryid']]['favorites'] = true;
                else $contacts[$row['primaryid']]['favorites'] = false;
                $contacts[$row['primaryid']]['opportunities'] = array();
                $contacts[$row['primaryid']]['tasks'] = array();
                $contacts[$row['primaryid']]['calls'] = array();
                $contacts[$row['primaryid']]['meetings'] = array();
                $contacts[$row['primaryid']]['notes'] = array();
            }

            //get contacts_opportunities
            $this->getOpportunites($contacts, $roleContacts, 'contacts');

            //get contacts_opportunities_notes
            $this->getNotes($contacts, $roleContacts, 'contacts', 'opportunities');

            //get contacts_tasks
            $this->getTasks($contacts, $roleContacts, 'contacts');

            //get contacts_tasks_notes
            $this->getNotes($contacts, $roleContacts, 'contacts', 'tasks');

            //get contacts_calls
            $this->getCalls($contacts, $roleContacts, 'contacts');

            //get contacts_calls_notes
            $this->getNotes($contacts, $roleContacts, 'contacts', 'calls');

            //get contacts_meetings
            $this->getMeetings($contacts, $roleContacts, 'contacts');

            //get contacts_meeting_notes
            $this->getNotes($contacts, $roleContacts, 'contacts', 'meetings');

            //get contacts_notes
            $this->getNotes($contacts, $roleContacts, 'contacts');

            $users_info['contacts'] = array_values($contacts);
            foreach ($users_info['contacts'] as $contacts_id => $value) {
                $users_info['contacts'][$contacts_id]['opportunities'] = array_values($users_info['contacts'][$contacts_id]['opportunities']);
                $users_info['contacts'][$contacts_id]['tasks'] = array_values($users_info['contacts'][$contacts_id]['tasks']);
                $users_info['contacts'][$contacts_id]['calls'] = array_values($users_info['contacts'][$contacts_id]['calls']);
                $users_info['contacts'][$contacts_id]['meetings'] = array_values($users_info['contacts'][$contacts_id]['meetings']);
                $users_info['contacts'][$contacts_id]['notes'] = array_values($users_info['contacts'][$contacts_id]['notes']);

                foreach ($users_info['contacts'][$contacts_id]['opportunities'] as $opportunities_id => $value) {
                    $users_info['contacts'][$contacts_id]['opportunities'][$opportunities_id]['notes'] = array_values($users_info['contacts'][$contacts_id]['opportunities'][$opportunities_id]['notes']);
                }

                foreach ($users_info['contacts'][$contacts_id]['tasks'] as $tasks_id => $value) {
                    $users_info['contacts'][$contacts_id]['tasks'][$tasks_id]['notes'] = array_values($users_info['contacts'][$contacts_id]['tasks'][$tasks_id]['notes']);
                }

                foreach ($users_info['contacts'][$contacts_id]['calls'] as $calls_id => $value) {
                    $users_info['contacts'][$contacts_id]['calls'][$calls_id]['notes'] = array_values($users_info['contacts'][$contacts_id]['calls'][$calls_id]['notes']);
                }

                foreach ($users_info['contacts'][$contacts_id]['meetings'] as $meetings_id => $value) {
//                    $users_info['contacts'][$contacts_id]['meetings'][$meetings_id]['guests']['contacts'] = array_values($users_info['contacts'][$contacts_id]['meetings'][$meetings_id]['guests']['contacts']);
//                    $users_info['contacts'][$contacts_id]['meetings'][$meetings_id]['guests']['leads'] = array_values($users_info['contacts'][$contacts_id]['meetings'][$meetings_id]['guests']['leads']);
//                    $users_info['contacts'][$contacts_id]['meetings'][$meetings_id]['guests']['users'] = array_values($users_info['contacts'][$contacts_id]['meetings'][$meetings_id]['guests']['users']);
                    $users_info['contacts'][$contacts_id]['meetings'][$meetings_id]['notes'] = array_values($users_info['contacts'][$contacts_id]['meetings'][$meetings_id]['notes']);
                }
            }

            //get accounts
            $roleAccounts = $this->getRole($users_primaryid, 'accounts');
            $q5 = "SELECT IFNULL(accounts.id, '') primaryid,
				IFNULL(accounts.created_by, '') created_by,
				IFNULL(accounts.modified_user_id, '') modified_user_id,
				IFNULL(accounts.assigned_user_id, '') assigned_user_id,
				IFNULL(accounts.date_entered, '') date_entered,
				IFNULL(accounts.date_modified, '') date_modified,
				IFNULL(accounts.name, '') accounts_name,
                IFNULL(accounts.account_type, '') account_type,
                IFNULL(accounts.industry, '') industry,
                IFNULL(accounts.billing_address_street, '') billing_address_street,
                IFNULL(accounts.billing_address_city, '') billing_address_city,
                IFNULL(accounts.billing_address_state, '') billing_address_state,
                IFNULL(accounts.phone_office, '') phone_office,
                IFNULL(accounts.website, '') website,
                IFNULL(accounts.shipping_address_street, '') shipping_address_street,
                IFNULL(accounts.shipping_address_city, '') shipping_address_city,
                IFNULL(accounts.shipping_address_state, '') shipping_address_state,
				IFNULL(accounts.billing_latitude, '') pri_latitude,
                IFNULL(accounts.billing_longitude, '') pri_longitude,
                IFNULL(accounts.description, '') description,
                IFNULL(accounts.picture, '') picture,
                IFNULL(l1.email_address, '') email,
                IFNULL(l_fav.id, '') favorites
                FROM accounts
                LEFT JOIN  email_addr_bean_rel l1_1 ON accounts.id=l1_1.bean_id AND l1_1.deleted=0
                AND l1_1.bean_module = 'Accounts' AND l1_1.primary_address = 1 
                LEFT JOIN  email_addresses l1 ON l1.id=l1_1.email_address_id AND l1.deleted=0
                LEFT JOIN dotbfavorites l_fav ON accounts.id = l_fav.record_id AND l_fav.deleted=0
                AND l_fav.module = 'Accounts'
                WHERE accounts.deleted=0
                {$roleAccounts}
                ORDER BY accounts.date_modified DESC";
            $accounts = array();
            $result5 = $GLOBALS['db']->query($q5);
            while ($row = $GLOBALS['db']->fetchByAssoc($result5)) {
                $accounts[$row['primaryid']]['primaryid'] = $row['primaryid'];
                $accounts[$row['primaryid']]['created_by'] = $row['created_by'];
                $accounts[$row['primaryid']]['modified_user_id'] = $row['modified_user_id'];
                $accounts[$row['primaryid']]['assigned_user_id'] = $row['assigned_user_id'];
                $accounts[$row['primaryid']]['date_entered'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_entered']));
                $accounts[$row['primaryid']]['date_modified'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_modified']));
                $accounts[$row['primaryid']]['name'] = $row['accounts_name'];
                $accounts[$row['primaryid']]['account_type'] = $row['account_type'];
                $accounts[$row['primaryid']]['industry'] = $row['industry'];
                $accounts[$row['primaryid']]['billing_address_street'] = $row['billing_address_street'];
                $accounts[$row['primaryid']]['billing_address_city'] = $row['billing_address_city'];
                $accounts[$row['primaryid']]['billing_address_state'] = $row['billing_address_state'];
                $accounts[$row['primaryid']]['phone_office'] = $row['phone_office'];
                $accounts[$row['primaryid']]['website'] = $row['website'];
                $accounts[$row['primaryid']]['shipping_address_street'] = $row['shipping_address_street'];
                $accounts[$row['primaryid']]['shipping_address_city'] = $row['shipping_address_city'];
                $accounts[$row['primaryid']]['shipping_address_state'] = $row['shipping_address_state'];
                $accounts[$row['primaryid']]['pri_latitude'] = $row['pri_latitude'];
                $accounts[$row['primaryid']]['pri_longitude'] = $row['pri_longitude'];
                $accounts[$row['primaryid']]['description'] = $row['description'];
                $accounts[$row['primaryid']]['picture'] = $row['picture'];
                $accounts[$row['primaryid']]['email'] = $row['email'];
                if ($row['favorites'] != "")
                    $accounts[$row['primaryid']]['favorites'] = true;
                else $accounts[$row['primaryid']]['favorites'] = false;
                $accounts[$row['primaryid']]['opportunities'] = array();
                $accounts[$row['primaryid']]['tasks'] = array();
                $accounts[$row['primaryid']]['calls'] = array();
                $accounts[$row['primaryid']]['meetings'] = array();
                $accounts[$row['primaryid']]['notes'] = array();
            }

            //get accounts_opportunites
            $this->getOpportunites($accounts, $roleAccounts, 'accounts');

            //get accounts_opportunities_notes
            $this->getNotes($accounts, $roleAccounts, 'accounts', 'opportunities');

            //get accounts_tasks
            $this->getTasks($accounts, $roleAccounts, 'accounts');

            //get accounts_tasks_notes
            $this->getNotes($accounts, $roleAccounts, 'accounts', 'tasks');

            //get accounts_calls
            $this->getCalls($accounts, $roleAccounts, 'accounts');

            //get accounts_calls_notes
            $this->getNotes($accounts, $roleAccounts, 'accounts', 'calls');

            //get accounts_meetings
            $this->getMeetings($accounts, $roleAccounts, 'accounts');

            //get accounts_meetings_notes
            $this->getNotes($accounts, $roleAccounts, 'accounts', 'meetings');

            //get accounts_notes
            $this->getNotes($accounts, $roleAccounts, 'accounts');

            $users_info['accounts'] = array_values($accounts);
            foreach ($users_info['accounts'] as $accounts_id => $value) {
                $users_info['accounts'][$accounts_id]['opportunities'] = array_values($users_info['accounts'][$accounts_id]['opportunities']);
                $users_info['accounts'][$accounts_id]['tasks'] = array_values($users_info['accounts'][$accounts_id]['tasks']);
                $users_info['accounts'][$accounts_id]['calls'] = array_values($users_info['accounts'][$accounts_id]['calls']);
                $users_info['accounts'][$accounts_id]['meetings'] = array_values($users_info['accounts'][$accounts_id]['meetings']);
                $users_info['accounts'][$accounts_id]['notes'] = array_values($users_info['accounts'][$accounts_id]['notes']);

                foreach ($users_info['accounts'][$accounts_id]['opportunities'] as $opportunities_id => $value) {
                    $users_info['accounts'][$accounts_id]['opportunities'][$opportunities_id]['notes'] = array_values($users_info['accounts'][$accounts_id]['opportunities'][$opportunities_id]['notes']);
                }

                foreach ($users_info['accounts'][$accounts_id]['tasks'] as $tasks_id => $value) {
                    $users_info['accounts'][$accounts_id]['tasks'][$tasks_id]['notes'] = array_values($users_info['accounts'][$accounts_id]['tasks'][$tasks_id]['notes']);
                }

                foreach ($users_info['accounts'][$accounts_id]['calls'] as $calls_id => $value) {
                    $users_info['accounts'][$accounts_id]['calls'][$calls_id]['notes'] = array_values($users_info['accounts'][$accounts_id]['calls'][$calls_id]['notes']);
                }

                foreach ($users_info['accounts'][$accounts_id]['meetings'] as $meetings_id => $value) {
//                    $users_info['accounts'][$accounts_id]['meetings'][$meetings_id]['guests']['contacts'] = array_values($users_info['accounts'][$accounts_id]['meetings'][$meetings_id]['guests']['contacts']);
//                    $users_info['accounts'][$accounts_id]['meetings'][$meetings_id]['guests']['leads'] = array_values($users_info['accounts'][$accounts_id]['meetings'][$meetings_id]['guests']['leads']);
//                    $users_info['accounts'][$accounts_id]['meetings'][$meetings_id]['guests']['users'] = array_values($users_info['accounts'][$accounts_id]['meetings'][$meetings_id]['guests']['users']);
                    $users_info['accounts'][$accounts_id]['meetings'][$meetings_id]['notes'] = array_values($users_info['accounts'][$accounts_id]['meetings'][$meetings_id]['notes']);
                }
            }

            //get feedback
            $roleCases = $this->getRole($users_primaryid, 'cases');
            $q6 = "SELECT DISTINCT
                IFNULL(cases.id, '') primaryid,
                IFNULL(cases.name, '') cases_name,
                IFNULL(cases.date_entered, '') date_entered,
                IFNULL(cases.date_modified, '') date_modified,
                IFNULL(cases.modified_user_id, '') modified_user_id,
                IFNULL(cases.created_by, '') created_by,
                IFNULL(cases.description, '') description,
                IFNULL(cases.case_number, '') case_number,
                IFNULL(cases.type, '') case_type,
                IFNULL(cases.status, '') case_status,
                IFNULL(cases.priority, '') priority,
                IFNULL(cases.resolution, '') resolution,
                IFNULL(l1.id, '') accounts_id,
                IFNULL(cases.source, '') case_source,
                IFNULL(cases.portal_viewable, '') portal_viewable,
                IFNULL(cases.assigned_user_id, '') assigned_user_id,
				IFNULL(cases.team_id, '') team_id
                FROM cases
                LEFT JOIN  accounts l1 ON cases.account_id=l1.id AND l1.deleted=0
                WHERE
                cases.deleted = 0 
                {$roleCases}
                ORDER BY date_modified DESC";
            $feedback = array();
            $result6 = $GLOBALS['db']->query($q6);
            while ($row = $GLOBALS['db']->fetchByAssoc($result6)) {
                $feedback[$row['primaryid']]['primaryid'] = $row['primaryid'];
                $feedback[$row['primaryid']]['cases_name'] = $row['cases_name'];
                $feedback[$row['primaryid']]['date_entered'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_entered']));
                $feedback[$row['primaryid']]['date_modified'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_modified']));
                $feedback[$row['primaryid']]['modified_user_id'] = $row['modified_user_id'];
                $feedback[$row['primaryid']]['created_by'] = $row['created_by'];
                $feedback[$row['primaryid']]['description'] = $row['description'];
                $feedback[$row['primaryid']]['case_number'] = $row['case_number'];
                $feedback[$row['primaryid']]['case_type'] = $row['case_type'];
                $feedback[$row['primaryid']]['case_status'] = $row['case_status'];
                $feedback[$row['primaryid']]['priority'] = $row['priority'];
                $feedback[$row['primaryid']]['resolution'] = $row['resolution'];
                $feedback[$row['primaryid']]['accounts_id'] = $row['accounts_id'];
                $feedback[$row['primaryid']]['case_source'] = $row['case_source'];
                $feedback[$row['primaryid']]['portal_viewable'] = $row['portal_viewable'];
                $feedback[$row['primaryid']]['assigned_user_id'] = $row['assigned_user_id'];
                $feedback[$row['primaryid']]['team_id'] = $row['team_id'];
                $feedback[$row['primaryid']]['comments'] = array();
            }

            $users_info['feedback'] = array_values($feedback);

            //get log notifications
            $q7 = "SELECT DISTINCT
                IFNULL(notifications.id, '') primaryid,
                IFNULL(notifications.name, '') notifications_name,
                IFNULL(notifications.date_entered, '') date_entered,
                IFNULL(notifications.date_modified, '') date_modified,
                IFNULL(notifications.modified_user_id, '') modified_user_id,
                IFNULL(notifications.created_by, '') created_by,
                IFNULL(notifications.description, '') description,
                IFNULL(notifications.is_read, '') is_read,
                IFNULL(notifications.severity, '') severity,
                IFNULL(notifications.parent_type, '') parent_type,
                IFNULL(notifications.parent_id, '') parent_id,
                IFNULL(notifications.assigned_user_id, '') assigned_user_id
                FROM notifications
                WHERE
                notifications.deleted = 0 
                AND notifications.assigned_user_id = '$users_primaryid'
                AND notifications.created_by <> notifications.assigned_user_id
                ORDER BY date_modified DESC";
            $notifications = array();
            $result7 = $GLOBALS['db']->query($q7);
            while ($row = $GLOBALS['db']->fetchByAssoc($result7)) {
                $notifications[$row['primaryid']]['primaryid'] = $row['primaryid'];
                $notifications[$row['primaryid']]['notifications_name'] = $row['notifications_name'];
                $notifications[$row['primaryid']]['date_entered'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_entered']));
                $notifications[$row['primaryid']]['date_modified'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_modified']));
                $notifications[$row['primaryid']]['modified_user_id'] = $row['modified_user_id'];
                $notifications[$row['primaryid']]['created_by'] = $row['created_by'];
                $notifications[$row['primaryid']]['description'] = $row['description'];
                $notifications[$row['primaryid']]['is_read'] = $row['is_read'];
                $notifications[$row['primaryid']]['severity'] = $row['severity'];
                $notifications[$row['primaryid']]['parent_type'] = $row['parent_type'];
                $notifications[$row['primaryid']]['parent_id'] = $row['parent_id'];
                $notifications[$row['primaryid']]['assigned_user_id'] = $row['assigned_user_id'];
//                $notifications[$row['primaryid']]['type'] = $row['type'];
//                $notifications[$row['primaryid']]['parent_name'] = $row['parent_name'];
            }
            $users_info['notifications'] = array_values($notifications);

            //get contract list
            $roleContracts = $this->getRole($users_primaryid, 'contracts');
            $q8 = "SELECT DISTINCT IFNULL(contracts.id,'') primaryid
                ,IFNULL(contracts.created_by,'') created_by 
                ,IFNULL(contracts.modified_user_id,'') modified_user_id 
                ,IFNULL(contracts.assigned_user_id,'') assigned_user_id 
                ,IFNULL(contracts.date_entered,'') date_entered 
                ,IFNULL(contracts.date_modified,'') date_modified 
                ,IFNULL(contracts.name,'') contracts_name 
                ,IFNULL(contracts.reference_code,'') reference_code 
                ,IFNULL(contracts.status,'') contracts_status 
                ,IFNULL(contracts.start_date,'') start_date 
                ,IFNULL(contracts.end_date,'') end_date 
                ,IFNULL(l1.id,'') opportunities_id 
                ,IFNULL(l1.name,'') opportunities_name 
                ,IFNULL(l2.id,'') accounts_id 
                ,IFNULL(l2.name,'') accounts_name 
                ,IFNULL(contracts.total_contract_value,'') total_contract_value 
                ,IFNULL(contracts.company_signed_date,'') company_signed_date 
                ,IFNULL(contracts.customer_signed_date,'') customer_signed_date 
                ,IFNULL(contracts.expiration_notice,'') expiration_notice
                ,IFNULL(contracts.description,'') description
                FROM contracts LEFT JOIN contracts_opportunities l1_1 ON contracts.id=l1_1.contract_id AND l1_1.deleted=0 
                LEFT JOIN opportunities l1 ON l1.id=l1_1.opportunity_id AND l1.deleted=0
                INNER JOIN accounts l2 ON l2.id = contracts.account_id AND l2.deleted=0
                WHERE contracts.deleted=0
                {$roleContracts} 
                ORDER BY date_modified DESC";
            $contracts = array();
            $result8 = $GLOBALS['db']->query($q8);
            while ($row = $GLOBALS['db']->fetchByAssoc($result8)) {
                $contracts[$row['primaryid']]['primaryid'] = $row['primaryid'];
                $contracts[$row['primaryid']]['name'] = $row['contracts_name'];
                $contracts[$row['primaryid']]['date_entered'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_entered']));
                $contracts[$row['primaryid']]['date_modified'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_modified']));
                $contracts[$row['primaryid']]['modified_user_id'] = $row['modified_user_id'];
                $contracts[$row['primaryid']]['created_by'] = $row['created_by'];
                $contracts[$row['primaryid']]['reference_code'] = $row['reference_code'];
                $contracts[$row['primaryid']]['status'] = $row['contracts_status'];
                $contracts[$row['primaryid']]['start_date'] = $row['start_date'];
                $contracts[$row['primaryid']]['end_date'] = $row['end_date'];
                $contracts[$row['primaryid']]['opportunities_id'] = $row['opportunities_id'];
                $contracts[$row['primaryid']]['opportunities_name'] = $row['opportunities_name'];
                $contracts[$row['primaryid']]['accounts_id'] = $row['accounts_id'];
                $contracts[$row['primaryid']]['accounts_name'] = $row['accounts_name'];
                $contracts[$row['primaryid']]['total_contract_value'] = $row['total_contract_value'];
                $contracts[$row['primaryid']]['company_signed_date'] = $row['company_signed_date'];
                $contracts[$row['primaryid']]['customer_signed_date'] = $row['customer_signed_date'];
                $contracts[$row['primaryid']]['expiration_notice'] = $row['expiration_notice'];
                $contracts[$row['primaryid']]['description'] = $row['description'];
                $contracts[$row['primaryid']]['assigned_user_id'] = $row['assigned_user_id'];
                $contracts[$row['primaryid']]['documents'] = array();
                $contracts[$row['primaryid']]['contacts'] = array();
            }

            $q8_1 = "SELECT DISTINCT IFNULL(contracts.id,'') contracts_id
                    ,IFNULL(l1.id,'') documents_id 
                    ,IFNULL(l1.created_by,'') created_by 
                    ,IFNULL(l1.modified_user_id,'') modified_user_id 
                    ,IFNULL(l1.assigned_user_id,'') assigned_user_id 
                    ,IFNULL(l1.date_entered,'') date_entered 
                    ,IFNULL(l1.date_modified,'') date_modified 
                    ,IFNULL(l1.document_revision_id,'') document_revision_id 
                    ,IFNULL(l2.filename,'') filename 
                    ,IFNULL(l1.document_name,'') document_name
                    ,IFNULL(l2.file_mime_type,'') file_mime_type 
                    ,IFNULL(l2.revision,'') revision 
                    ,IFNULL(l1.doc_type,'') doc_type 
                    ,IFNULL(l1.status_id,'') status_id 
                    ,IFNULL(l1.template_type,'') template_type 
                    ,IFNULL(l1.is_template,'') is_template 
                    ,IFNULL(l1.active_date,'') active_date 
                    ,IFNULL(l1.exp_date,'') exp_date 
                    ,IFNULL(l1.category_id,'') category_id 
                    ,IFNULL(l1.subcategory_id,'') subcategory_id 
                    ,IFNULL(l1.description,'') description 
                    ,IFNULL(l3.id,'') related_doc_id 
                    ,IFNULL(l3.document_name,'') related_doc_name 
                    FROM contracts 
                    LEFT JOIN linked_documents l1_1 ON contracts.id=l1_1.parent_id AND l1_1.deleted=0 AND l1_1.parent_type = 'Contracts' 
                    LEFT JOIN documents l1 ON l1.id=l1_1.document_id AND l1.deleted=0 
                    INNER JOIN document_revisions l2 ON l2.id = l1.document_revision_id AND l2.deleted=0 
                    LEFT JOIN documents l3 ON l3.id = l1.related_doc_id AND l3.deleted=0
                    WHERE contracts.deleted=0
                    {$roleContracts}
                    ORDER BY date_modified DESC";
            $result8_1 = $GLOBALS['db']->query($q8_1);
            while ($row = $GLOBALS['db']->fetchByAssoc($result8_1)) {
                $contracts[$row['contracts_id']]['documents'][$row['documents_id']]['documents_id'] = $row['documents_id'];
                $contracts[$row['contracts_id']]['documents'][$row['documents_id']]['created_by'] = $row['created_by'];
                $contracts[$row['contracts_id']]['documents'][$row['documents_id']]['modified_user_id'] = $row['modified_user_id'];
                $contracts[$row['contracts_id']]['documents'][$row['documents_id']]['assigned_user_id'] = $row['assigned_user_id'];
                $contracts[$row['contracts_id']]['documents'][$row['documents_id']]['date_entered'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_entered']));
                $contracts[$row['contracts_id']]['documents'][$row['documents_id']]['date_modified'] = date('Y-m-d H:i:s', strtotime("+7 hours " . $row['date_modified']));
                $contracts[$row['contracts_id']]['documents'][$row['documents_id']]['document_revision_id'] = $row['document_revision_id'];
                $contracts[$row['contracts_id']]['documents'][$row['documents_id']]['filename'] = $row['filename'];
                $contracts[$row['contracts_id']]['documents'][$row['documents_id']]['document_name'] = $row['document_name'];
                $contracts[$row['contracts_id']]['documents'][$row['documents_id']]['file_mime_type'] = $row['file_mime_type'];
                $contracts[$row['contracts_id']]['documents'][$row['documents_id']]['revision'] = $row['revision'];
                $contracts[$row['contracts_id']]['documents'][$row['documents_id']]['doc_type'] = $row['doc_type'];
                $contracts[$row['contracts_id']]['documents'][$row['documents_id']]['template_type'] = $row['template_type'];
                $contracts[$row['contracts_id']]['documents'][$row['documents_id']]['is_template'] = $row['is_template'];
                $contracts[$row['contracts_id']]['documents'][$row['documents_id']]['active_date'] = $row['active_date'];
                $contracts[$row['contracts_id']]['documents'][$row['documents_id']]['exp_date'] = $row['exp_date'];
                $contracts[$row['contracts_id']]['documents'][$row['documents_id']]['category_id'] = $row['category_id'];
                $contracts[$row['contracts_id']]['documents'][$row['documents_id']]['subcategory_id'] = $row['subcategory_id'];
                $contracts[$row['contracts_id']]['documents'][$row['documents_id']]['description'] = $row['description'];
                $contracts[$row['contracts_id']]['documents'][$row['documents_id']]['related_doc_id'] = $row['related_doc_id'];
                $contracts[$row['contracts_id']]['documents'][$row['documents_id']]['related_doc_name'] = $row['related_doc_name'];
            }

            $q8_2 = "SELECT IFNULL(contracts.id,'') contracts_id
                    ,IFNULL(l1.id,'') contacts_id 
                    FROM contracts 
                    INNER JOIN contracts_contacts l1_1 ON contracts.id=l1_1.contract_id AND l1_1.deleted=0 
                    INNER JOIN contacts l1 ON l1.id=l1_1.contact_id AND l1.deleted=0 
                    WHERE contracts.deleted=0
                    {$roleContracts}
                    ORDER BY l1.date_modified DESC";
            $result8_2 = $GLOBALS['db']->query($q8_2);
            while ($row = $GLOBALS['db']->fetchByAssoc($result8_2)) {
                $contracts[$row['contracts_id']]['contacts'][$row['contacts_id']]['contacts_id'] = $row['contacts_id'];
            }

            $users_info['contracts'] = array_values($contracts);
            foreach ($users_info['contracts'] as $contracts_id => $value) {
                $users_info['contracts'][$contracts_id]['documents'] = array_values($users_info['contracts'][$contracts_id]['documents']);
                $users_info['contracts'][$contracts_id]['contacts'] = array_values($users_info['contracts'][$contracts_id]['contacts']);
            }

            //get Audit
            $audit = array();
            $this->getAudit($audit, 'leads');
            $this->getAudit($audit, 'contacts');
            $this->getAudit($audit, 'accounts');
            $this->getAudit($audit, 'opportunities');
            $this->getAudit($audit, 'contracts');

            foreach ($audit as $module => $module_val) {
                foreach ($module_val as $parent_id => $parent_id_val) {
                    foreach ($parent_id_val as $created_by => $created_by_val) {
                        foreach ($created_by_val as $date_created => $date_created_val) {
                            $sub_feeds = array();
                            $sub_feeds['parent_id'] = $parent_id;
                            $sub_feeds['created_by'] = (string)$created_by;
                            $sub_feeds['date_created'] = $date_created;
                            $sub_feeds['fields'] = array_values($audit[$module][$parent_id][$created_by][$date_created]['fields']);
                            $users_info['feeds'][$module][] = $sub_feeds;
                        }

                    }
                }
            }

            //Set App_String
            $language_options = array('account_type_dom', 'call_direction_dom', 'call_result_options', 'call_status_dom', 'case_priority_dom', 'case_type_dom',
                'case_status_dom', 'commit_stage_dom', 'gender_list', 'industry_dom', 'lead_source_dom', 'lead_status_dom', 'meeting_status_dom', 'meeting_type_dom',
                'opportunity_type_dom', 'reminder_time_options', 'repeat_type_dom', 'repeat_interval_number', 'repeat_end_types', 'repeat_selector_dom', 'repeat_ordinal_dom',
                'repeat_unit_dom', 'sales_status_dom', 'sales_stage_dom', 'source_dom', 'task_status_dom', 'task_priority_dom', 'dom_cal_day_of_week', 'contract_status_dom',
                'tasks_duration_options', 'calls_duration_options', 'calls_recall_options');
            $app_strings = array(
                'en' => $this->parseAppListString('en_us',$language_options),
                'vn' => $this->parseAppListString('vn_vn',$language_options),
            );

            global $dotb_config;
            $app_strings_date= array(
                'name' => 'date_formats',
                'list' => $this->push_elements($dotb_config['date_formats']),
            );
            $app_strings['en'][] = $app_strings_date;
            $app_strings['vn'][] = $app_strings_date;

            $app_strings_time= array(
                'name' => 'time_formats',
                'list' => $this->push_elements($dotb_config['time_formats']),
            );
            $app_strings['en'][] = $app_strings_time;
            $app_strings['vn'][] = $app_strings_time;

            $app_strings_name = array(
                'name' => 'name_formats',
                'list' => array(
                    array(
                        'key' => 'f l',
                        'value' => 'f l',
                    ),
                    array(
                        'key' => 'l f',
                        'value' => 'l f',
                    ),
                ),
            );
            $app_strings['en'][] = $app_strings_name;
            $app_strings['vn'][] = $app_strings_name;

            //get MetaData
            $meta_data['Leads'] = $this->getMetaData('Leads');
            $meta_data['Contacts'] = $this->getMetaData('Contacts');
            $meta_data['Accounts'] = $this->getMetaData('Accounts');
            $meta_data['Opportunities'] = $this->getMetaData('Opportunities');
            $meta_data['Tasks'] = $this->getMetaData('Tasks');
            $meta_data['Calls'] = $this->getMetaData('Calls');
            $meta_data['Meetings'] = $this->getMetaData('Meetings');
            $meta_data['Notes'] = $this->getMetaData('Notes');
            $meta_data['Cases'] = $this->getMetaData('Cases');
            $meta_data['Notifications'] = $this->getMetaData('Notifications');
            $meta_data['Contracts'] = $this->getMetaData('Contracts');

            //Return
            return array(
                'success' => true,
                'data' => $users_info,
                'app_strings_en' => $app_strings['en'],
                'app_strings_vn' => $app_strings['vn'],
                'meta_data' => $meta_data,
            );

        } else
            return array(
                'success' => false,
                'message' => "sending_failed",
            );
    }

    function parseAppListString($language,array $appStrings){
        global $app_list_strings;
        $app_list_strings = return_app_list_strings_language($language);
        $return_value = array();
        foreach ($appStrings as $appString){
            $array = array();
            $array['name']= $appString;
            $list = array();

            foreach ($app_list_strings[$appString] as $key => $value){
                $list_array = array();
                $list_array['key'] = $key;
                $list_array['value'] = $value;
                array_push ($list, $list_array);
            }
            $array['list']= $list;
            array_push ($return_value, $array);
        }
        return $return_value;
    }

    function create_record(ServiceBase $api, array $args)
    {
        $moduleName = $args['module_name'];
        $id = $args['id'];

        if (isset($args['date_closed']) && $moduleName != 'Opportunities') {//Opportunities date_closed format Y-m-d
            $args['date_closed'] = date('Y-m-d H:i:s', strtotime("-7 hours " . $args['date_closed']));
        }
        if (isset($args['date_start'])) {// && $moduleName != 'Meetings'
            $args['date_start'] = date('Y-m-d H:i:s', strtotime("-7 hours " . $args['date_start']));
        }
        if (isset($args['date_due'])) {
            $args['date_due'] = date('Y-m-d H:i:s', strtotime("-7 hours " . $args['date_due']));
        }
        if (isset($args['date_end'])) {// && $moduleName != 'Meetings'
            $args['date_end'] = date('Y-m-d H:i:s', strtotime("-7 hours " . $args['date_end']));
        }
        if (isset($args['recall_at'])) {
            $args['recall_at'] = date('Y-m-d H:i:s', strtotime("-7 hours " . $args['recall_at']));
        }

//        if ($moduleName == "Meetings") {//create meeting
//            if ($id != '') {//update meeting
//                $bean = BeanFactory::getBean($moduleName, $id);
//                foreach ($args as $field => $Val)
//                    $bean->$field = $Val;
//                $bean->save();
//
//                if (isset($args['mark_favorite'])) {//add favorite
//                    $sql = "select id from dotbfavorites where record_id='{$bean->id}'";
//                    $result = $GLOBALS['db']->query($sql);
//                    if($args['mark_favorite'] == true) {
//                        if ($row = $GLOBALS['db']->fetchByAssoc($result)) {
//                            $sql = "update dotbfavorites set deleted=0 where record_id='{$bean->id}'";
//                            $GLOBALS['db']->query($sql);
//                        } else {
//                            $tid = create_guid();
//                            $sql = "insert into dotbfavorites(id,module,record_id,assigned_user_id,created_by,modified_user_id)
//                        values('{$tid}','{$moduleName}','{$bean->id}','{$bean->assigned_user_id}','{$bean->created_by}','{$bean->modified_user_id}')";
//                            $GLOBALS['db']->query($sql);
//                        }
//                    }else{
//                        if ($row = $GLOBALS['db']->fetchByAssoc($result)) {
//                            $sql = "update dotbfavorites set deleted=1 where record_id='{$bean->id}'";
//                            $GLOBALS['db']->query($sql);
//                        }
//                    }
//                }
//
//                return array(
//                    'success' => true,
//                    'bean_id' => $bean->id,
//                );
//            } else {//new meeting
//                $args['module'] = $args['module_name'];
//
//                unset($args['module_name']);
//                unset($args['id']);
//
//                if(isset($args['date_start'])){//sửa format date time c cho new meeting
//                    $date = DateTime::createFromFormat('Y-m-d H:i:s e', $args['date_start'] . ' Asia/Ho_Chi_Minh');
//                    $args['date_start'] = $date->format("c");
//                }
//                if(isset($args['date_end'])){
//                    $date = DateTime::createFromFormat('Y-m-d H:i:s e', $args['date_end'] . ' Asia/Ho_Chi_Minh');
//                    $args['date_end'] = $date->format("c");
//                }
//
//                $additionalProperties = array();
//                $calendarEventsApi = new CalendarEventsApi();
//                $bean = $calendarEventsApi->createBean($api, $args, $additionalProperties);
//
//                if($bean->id == ""){
//                    return array(
//                        'success' => false,
//                        'message' => '',
//                    );
//                }else{
//                    return array(
//                        'success' => true,
//                        'bean_id' => $bean->id,
//                    );
//                }
//            }
//        } else {//create record mudule khac

            if ($moduleName != '') {
                if ($id != '') {
                    $bean = BeanFactory::getBean($moduleName, $id);
                } else {
                    $bean = BeanFactory::getBean($moduleName);
                }
            } else return array(
                'success' => false,
                'message' => '',
            );

            //user xu li dateformat, timeformat, nameformat
            if ($args['module_name'] == "Users") {
                if (isset($args['dateformat'])) {
                    $bean->setPreference('datef', $args['dateformat'], 0, 'global');
                }
                if (isset($args['timeformat'])) {
                    $bean->setPreference('timef', $args['timeformat'], 0, 'global');
                }
                if (isset($args['nameformat'])) {
                    $bean->setPreference('default_locale_name_format', $args['nameformat'], 0, 'global');
                }
                unset($args['dateformat']);
                unset($args['timeformat']);
                unset($args['nameformat']);
            } elseif ($moduleName == 'Calls'){//xử lí duration, recall module calls
                $start = strtotime($args['date_start']);

                if ($args['call_duration'] == 99999) {
                    $end = strtotime($args['date_end']);
                    if ($start <= $end)
                        $bean->duration = $end - $start;
                    $bean->duration_hours = (int)($bean->duration / 3600);
                    $bean->duration_minutes = (int)(($bean->duration - $bean->duration_hours * 3600) / 60);
                } elseif ($args['call_duration'] != 0) {
                    $bean->duration = (int)$args['call_duration'];
                    $bean->duration_hours = (int)($bean->duration / 3600);
                    $bean->duration_minutes = (int)(($bean->duration - $bean->duration_hours * 3600) / 60);
                } else {
                    $bean->duration_hours = $bean->duration_minutes = $bean->duration = 0;
                }

                if ($args['recall'] != 0 && $args['recall'] != 99999) {
                    $bean->recall_at = date("Y-m-d H:i:s", $args['recall'] + $start);
                } elseif ($args['recall'] == 0) {
                    $bean->recall_at = null;
                }
            }elseif($moduleName == "Dashboards" && isset($args['metadata'])){
                $dashlet = '';
                foreach ($args['metadata'] as $row) {
                    if ($row['type'] == 'dashablelist') {
                        $dashlet .= '[
                                       {
                                          "width":12,
                                          "context":{
                                             "module":"' . $row['module'] . '"
                                          },
                                          "view":{
                                             "label":"' . $row['label'] . '",
                                             "type":"' . $row['type'] . '",
                                             "module":"' . $row['module'] . '",
                                             "last_state":{
                                                "id":"dashable-list"
                                             },
                                             "intelligent":"0",
                                             "limit":' . $row['limit'] . ',
                                             "filter_id":"all_records",
                                             "display_columns":["' . join('", "', $row['display_columns']) . '"]
                                          }
                                       }
                                    ],';
                    } elseif ($row['type'] == 'saved-reports-chart') {
                        $dashlet .= '[
                                       {
                                          "width":12,
                                          "context":{
                                             "module":"' . $row['module'] . '"
                                          },
                                          "view":{
                                             "label":"' . $row['label'] . '",
                                             "type":"' . $row['type'] . '",
                                             "module":"' . $row['module'] . '",
                                             "saved_report_id":"' . $row['saved_report_id'] . '",
                                             "saved_report":"' . $row['saved_report'] . '",
                                             "allowScroll":true,
                                             "colorData":"class",
                                             "hideEmptyGroups":true,
                                             "reduceXTicks":true,
                                             "rotateTicks":true,
                                             "show_controls":false,
                                             "show_title":true,
                                             "show_x_label":false,
                                             "show_y_label":false,
                                             "staggerTicks":true,
                                             "wrapTicks":true,
                                             "x_axis_label":"' . $row['x_axis_label'] . '",
                                             "y_axis_label":"' . $row['y_axis_label'] . '",
                                             "report_title":"' . $row['report_title'] . '",
                                             "show_legend":true,
                                             "stacked":true,
                                             "allow_drillthru":"1",
                                             "vertical":true,
                                             "direction":"ltr",
                                             "chart_type":"pie chart"
                                          }
                                       }
                                    ],';
                    }
                }

                $metaData = '{
                               "components":[
                                  {
                                     "rows":[
                                     ' . trim($dashlet, ",") . '
                                     ],
                                     "width":12
                                  }
                               ]
                            }';
                $args['metadata'] = $metaData;
            }elseif ($moduleName == "Documents" && isset($_FILES['document_revisions'])){
                if(!empty($args['document_revision_id'])){
                    $beanDocRev = BeanFactory::getBean('DocumentRevisions', $args['document_revision_id']);
                } else {
                    $beanDocRev = BeanFactory::getBean('DocumentRevisions');
                }

                $beanDocRev->filename = $_FILES['document_revisions']['name'];
                $beanDocRev->file_ext = pathinfo($_FILES['document_revisions']['name'], PATHINFO_EXTENSION);
                $beanDocRev->file_mime_type = $_FILES['document_revisions']['type'];
                $beanDocRev->file_size = $_FILES['document_revisions']['size'];
                $beanDocRev->revision = $args['revision'];
                $beanDocRev->doc_type = $args['doc_type'];
                $beanDocRev->change_log = 'Document Created';
                $beanDocRev->save();
                $savefile = 'upload/' . $beanDocRev->id;
                move_uploaded_file($_FILES['document_revisions']['tmp_name'], $savefile);

                if(empty($args['document_name'])){
                    $args['document_name'] = $beanDocRev->filename;
                }
                $args['document_revision_id'] = $beanDocRev->id;
            }

            if(isset($args['picture']) && strlen($args['picture']) > 36){//save picture
                require_once('include/DotbFields/Fields/Image/ImageHelper.php');
                $name = create_guid();
                $img = $args['picture'];
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);

                $data = base64_decode($img);
                if($args['module_name'] != "Users") {
                    if(!is_dir('upload/origin')){
                        mkdir('upload/origin');
                    }
                    if(!is_dir('upload/resize')){
                        mkdir('upload/resize');
                    }
                    $file1 = 'upload/origin/' . $name;
                    $file2 = 'upload/resize/' . $name;
                    file_put_contents($file1, $data);
                    file_put_contents($file2, $data);

                    $imgOri1 = new ImageHelper($file1);
                    $imgOri1->resize(500);
                    $imgOri1->save($file1);

                    $imgOri2 = new ImageHelper($file2);
                    $imgOri2->resize(220, 220);
                    $imgOri2->save($file2);
                }else{
                    $file1 = 'upload/' . $name;
                    file_put_contents($file1, $data);
                }
                $args['picture'] = $name;
            }

            unset($args['module_name']);
            unset($args['id']);

            if(isset($args['mark_favorite'])){//chuyen mark_favorite sang bool
                if($args['mark_favorite'] == "true")
                    $args['mark_favorite'] = true;
                else $args['mark_favorite'] = false;
            }
            if(isset($args['move_trash'])){//chuyen move_trash sang bool
                if($args['move_trash'] == "true")
                    $args['move_trash'] = true;
                else $args['move_trash'] = false;
            }

            //luu
            foreach ($args as $field => $Val)
                $bean->$field = $Val;
            $bean->save();

            //xu li document_revision sau khi co bean->id
            if ($moduleName == "Documents" && isset($_FILES['document_revisions'])) {
                $beanDocRev->document_id = $bean->id;
                $beanDocRev->save();
            }

            if ($bean->id == "")
                return array(
                    'success' => false,
                    'message' => '',
                );
            else {
                if (($moduleName == "Calls" || $moduleName == "Meetings") && ($bean->parent_type == "Contacts" || $bean->parent_type == "Leads")) {//create call relationship contacts or leads
                    if($bean->parent_type == "Leads"){
                        $this->unrelate($moduleName, 'Contacts', $bean->id);
                    }elseif($bean->parent_type == "Contacts"){
                        $this->unrelate($moduleName, 'Leads', $bean->id);
                    }
                    $this->relate($moduleName, $bean->parent_type, $bean->id, $bean->parent_id, $bean->date_modified);
                }elseif ($moduleName == 'Documents' && $args['parent_type'] == 'Contracts'){
                    $qCheckDocument = "SELECT id FROM linked_documents WHERE document_id = '{$bean->id}' AND parent_type = 'Contracts'";
                    $checkDocument = $GLOBALS['db']->getOne($qCheckDocument);
                    if(!empty($checkDocument)){
                        $qUpdateDocument = "UPDATE linked_documents SET deleted=0, parent_id = '{$args['parent_id']}' WHERE document_id = '{$bean->id}'";
                        $GLOBALS['db']->query($qUpdateDocument);
                    } else{
                        $linkedDocumentsID = create_guid();
                        $qInsertDocument="INSERT INTO linked_documents(id, parent_id, parent_type, document_id, date_modified, deleted) 
                                        VALUES ('{$linkedDocumentsID}','{$args['parent_id']}','Contracts','{$bean->id}','{$bean->date_modified}',0)";
                        $GLOBALS['db']->query($qInsertDocument);
                    }
                }

                if ($moduleName != "Calls" && isset($args['mark_favorite'])) {//add favorite

                    $sql = "select id from dotbfavorites where record_id='{$bean->id}'";
                    $result = $GLOBALS['db']->query($sql);
                    if($args['mark_favorite'] == true) {
                        if ($row = $GLOBALS['db']->fetchByAssoc($result)) {
                            $sql = "update dotbfavorites set deleted=0 where record_id='{$bean->id}'";
                            $GLOBALS['db']->query($sql);
                        } else {
                            $tid = create_guid();
                            $sql = "insert into dotbfavorites(id,module,record_id,assigned_user_id,created_by,modified_user_id)
                        values('{$tid}','{$moduleName}','{$bean->id}','{$bean->assigned_user_id}','{$bean->created_by}','{$bean->modified_user_id}')";
                            $GLOBALS['db']->query($sql);
                        }
                    }else{
                        if ($row = $GLOBALS['db']->fetchByAssoc($result)) {
                            $sql = "update dotbfavorites set deleted=1 where record_id='{$bean->id}'";

                            $GLOBALS['db']->query($sql);
                        }
                    }
                }

                return array(
                    'success' => true,
                    'bean_id' => $bean->id,
                );
            }
//        }
    }

    //delete relate calls - leads/contacts, meetings - leads/contacts
    function unrelate($main_module, $sub_module, $id_record){
        $qCheckRelateCall = "SELECT COUNT(*) FROM " . strtolower($main_module) . "_" . strtolower($sub_module) . " 
        WHERE ". chop(strtolower($main_module), 's') . "_id = '{$id_record}'";
        if ($GLOBALS['db']->getOne($qCheckRelateCall) > 0) {
            $sqlUpdate = "UPDATE " . strtolower($main_module) . "_" . strtolower($sub_module) . "
                         SET deleted = 1
                         WHERE ". chop(strtolower($main_module), 's') . "_id='{$id_record}'";
            $GLOBALS['db']->query($sqlUpdate);
        }
    }

    //create relate calls - leads/contacts, meetings - leads/contacts
    function relate($main_module, $sub_module, $id_record, $id_sub, $date_modified){
        $qCheckRelateCall = "SELECT COUNT(*) FROM " . strtolower($main_module) . "_" . strtolower($sub_module) . " 
        WHERE ". chop(strtolower($main_module), 's') . "_id = '{$id_record}'";
        if ($GLOBALS['db']->getOne($qCheckRelateCall) > 0) {
            $sqlUpdate = "UPDATE " . strtolower($main_module) . "_" . strtolower($sub_module) . "
                        SET " . chop(strtolower($sub_module), 's') . "_id='{$id_sub}', date_modified = '{$date_modified}'
                        WHERE ". chop(strtolower($main_module), 's') . "_id='{$id_record}'";
            $GLOBALS['db']->query($sqlUpdate);
        } else {
            $q_create = "INSERT INTO " . strtolower($main_module) . "_" . strtolower($sub_module) . " (id, ". chop(strtolower($main_module), 's') . "_id, " . chop(strtolower($sub_module), 's') . "_id, required, accept_status, date_modified, deleted) 
                        VALUES ('" . create_guid() . "', '{$id_record}', '{$id_sub}', '1', 'none', '{$date_modified}', '0');";
            $GLOBALS['db']->query($q_create);
        }
    }

    function post_token(ServiceBase $api, array $args)
    {

        $userId = $args['user_id'];

        $token = $args['token'];

        $method = $args['method'];


            if (empty($userId)) return array('success' => false);

            //Get token
            $content = $GLOBALS['db']->getOne("SELECT IFNULL(portal_app_token, '') portal_app_token FROM users WHERE id = '$userId'");

            $curToken = json_decode(html_entity_decode($content), true);
            $count_change = 0;

            if (!in_array($token, $curToken) && (empty($method) || $method == 'add')) {    //Add Token
                $curToken[] = $token;
                $count_change++;
            }

            if (($key = array_search($token, $curToken)) !== false && $method == 'delete') { //remove Token
                unset($curToken[$key]);
                $count_change++;
            }

            $ext_token = '';
            if ($count_change > 0)
                $ext_token = "portal_app_token = '" . json_encode($curToken) . "'";

            $GLOBALS['db']->query("UPDATE users SET deleted=0, $ext_token WHERE id = '$userId'");

            return array(
                'success' => true,
            );
    }

    function user_regis(ServiceBase $api, array $args)
    {
        if(!empty($args)) {
            $newAccount = new User();
            $newAccount->user_name = $args['user_name'];
            $newAccount->first_name = $args['first_name'];
            $newAccount->last_name = $args['last_name'];
            $newAccount->phone_mobile = $args['phone_mobile'];
            $newAccount->setNewPassword($args['password'], $system_generated = '0');
            $user_hash = $newAccount->getPasswordHash($args['password']);
            $newAccount->user_hash = $user_hash;
            $newAccount->status = 'Active';

            $newTeam = new Team();
            $newTeam->name = $args['name'];
            $newTeam->code_prefix = $args['code_prefix'];

            $newMembership = new TeamMembership();
            $newMembership->team_id = $newTeam->id;
            $newMembership->user_id = $newAccount->id;
            $newMembership->deleted = 0;

            try {
                $newAccount->save();
                $newTeam->save();
                $newMembership->save();
            } catch (DotbApiExceptionLicenseSeatsNeeded $e) {
            }

            return array(
                'success' => true,
                'bean_id' => $newAccount->id,
            );
        } else return array(
            'success' => false,
        );
    }

    function create_report(ServiceBase $api, array $args)
    {
        if(!empty($args)) {
            $new_report = new ReportsDashletsApi();
            $new_chart = $new_report->getSavedReportChartById($api, $args);

//            $report_api = new ReportsApi();
//            $record = $report_api->getReportRecords($api, $args);


//            var_dump($new_chart);

            $data_report=array();
            $data_report['properties']= $new_chart['chartData']->properties['0'];
            $data_report['values']= $new_chart['chartData']->values;

            return array(
                'success' => true,
                'data' => $data_report,
            );
        } else return array(
            'success' => false,
        );
    }

    function download_attachment(ServiceBase $api, array $args){
        if (file_exists('upload/' . $args['id'])) {
            global $db;
            $local_location = "upload://{$args['id']}";
            $query = "SELECT filename name FROM document_revisions INNER JOIN documents ON documents.id = document_revisions.document_id ";
            $query .= "WHERE document_revisions.id = '" . $db->quote($args['id']) . "' ";
            $row = $db->fetchOne($query);
            $name = $row['name'];
            header("Pragma: public");
            header("Cache-Control: max-age=1, post-check=0, pre-check=0");
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"" . $name . "\"");
            header("X-Content-Type-Options: nosniff");
            header("Content-Length: " . filesize($local_location));
            header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + 2592000));
            header('Content-Length: ' . filesize('upload/' . $args['id']));
            set_time_limit(0);
            @ob_end_clean();
            ob_start();
            readfile($local_location);
            @ob_flush();
            return array(
                'success' => true,
                'data' => $args['id'],
            );
        }
        return array(
            'success' => false,
        );
    }
}
