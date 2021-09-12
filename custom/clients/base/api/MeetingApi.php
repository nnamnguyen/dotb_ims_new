<?php

class MeetingApi extends DotbApi {
    function registerApiRest() {
        return array(
            'meeting-get-type' => array(
                'reqType' => 'PUT',
                'path' => array('Meetings', 'get-type'),
                'pathVars' => array(''),
                'method' => 'getType',
                'shortHelp' => '',
                'longHelp' => '',
            ),

            'meeting-check-student-lead-in-pt' => array(
                'reqType' => 'PUT',
                'path' => array('Meetings', 'check-student-lead-in-pt'),
                'pathVars' => array(''),
                'method' => 'checkStudentLeadMeeting',
                'shortHelp' => '',
                'longHelp' => '',
            ),

            'meeting-save-select' => array(
                'reqType' => 'GET',
                'path' => array('Meetings', 'save-select'),
                'pathVars' => array(''),
                'method' => 'saveSelect',
                'shortHelp' => '',
                'longHelp' => '',
            ),

            'meeting-update-result' => array(
                'reqType' => 'GET',
                'path' => array('Meetings', 'update-result'),
                'pathVars' => array(''),
                'method' => 'updatePTResult',
                'shortHelp' => '',
                'longHelp' => '',
            ),

            'meeting-delete-result' => array(
                'reqType' => 'PUT',
                'path' => array('Meetings', 'delete-result'),
                'pathVars' => array(''),
                'method' => 'deletePTResult',
                'shortHelp' => '',
                'longHelp' => '',
            ),

            'meeting-save-result' => array(
                'reqType' => 'GET',
                'path' => array('Meetings', 'save-result'),
                'pathVars' => array(''),
                'method' => 'saveResultAll',
                'shortHelp' => '',
                'longHelp' => '',
            ),

            'meeting-move-result' => array(
                'reqType' => 'PUT',
                'path' => array('Meetings', 'move-result'),
                'pathVars' => array(''),
                'method' => 'movePTResult',
                'shortHelp' => '',
                'longHelp' => '',
            ),

            'meeting-save-demo' => array(
                'reqType' => 'GET',
                'path' => array('Meetings', 'save-demo'),
                'pathVars' => array(''),
                'method' => 'saveDemoResult',
                'shortHelp' => '',
                'longHelp' => '',
            ),
            'meeting-save-attended' => array(
                'reqType' => 'GET',
                'path' => array('Meetings', 'save-attended'),
                'pathVars' => array(''),
                'method' => 'saveDemoAttended',
                'shortHelp' => '',
                'longHelp' => '',
            ),

            'meeting-update-ecnote' => array(
                'reqType' => 'GET',
                'path' => array('Meetings', 'update-ecnote'),
                'pathVars' => array(''),
                'method' => 'updateECNote',
                'shortHelp' => '',
                'longHelp' => '',
            ),

        );
    }

    /**
     * Added by Hieu Pham to get type of meeting for routing
     * @param ServiceBase $api
     * @param array $args
     * @return string
     */
    function getType(ServiceBase $api, array $args) {
        $type = 'other';
        if (isset($args) && !empty($args)) {
            if ($args["id"]) {
                $db = DBManagerFactory::getInstance();
                $result = $db->query("SELECT meeting_type FROM meetings WHERE id = '" . $args['id'] . "' AND deleted = 0");
                if ($row = $db->fetchByAssoc($result)) {
                    $type = $row['meeting_type'];
                } else {
                    $type = 'none';
                }
            }
        }
        return $type;

    }

    /**
     * Added by Hieu Pham to check student/lead have exists in PT
     * @param ServiceBase $api
     * @param array $data
     * @return bool
     */
    function checkStudentLeadMeeting(ServiceBase $api, array $data) {
        //kiem tra neu student or lead do da co trong situation thi bo qua khong them nua
        $sql_check = "
        SELECT count(j_ptresult.id)
        FROM j_ptresult
        LEFT JOIN leads_j_ptresult_1_c l1_1 ON j_ptresult.id = l1_1.leads_j_ptresult_1j_ptresult_idb AND l1_1.deleted = 0
        LEFT JOIN leads l1 ON l1.id = l1_1.leads_j_ptresult_1leads_ida AND l1.deleted = 0
        LEFT JOIN contacts_j_ptresult_1_c l2_1 ON j_ptresult.id = l2_1.contacts_j_ptresult_1j_ptresult_idb AND l2_1.deleted = 0
        LEFT JOIN contacts l2 ON l2.id = l2_1.contacts_j_ptresult_1contacts_ida AND l2.deleted = 0
        INNER JOIN meetings_j_ptresult_1_c l3_1 ON j_ptresult.id = l3_1.meetings_j_ptresult_1j_ptresult_idb AND l3_1.deleted = 0
        INNER JOIN meetings l3 ON l3.id = l3_1.meetings_j_ptresult_1meetings_ida AND l3.deleted = 0
        WHERE (l3.id = '{$data['meeting_id']}') AND j_ptresult.deleted = 0
        AND j_ptresult.type_result = '{$data['meeting_type']}'
        AND ( l1.id = '{$data['student_id']}' OR l2.id='{$data['student_id']}' ) ";

        return ($GLOBALS['db']->getOne($sql_check) ? false : true);
    }

    /**
     * Added by Hieu Pham to save select lead/student in PT/Demo
     * @param ServiceBase $api
     * @param array $data
     * @return mixed
     */
    function saveSelect(ServiceBase $api, array $data) {
        global $timedate;
        //get date add time
        $first_time_aft = $timedate->to_db($data['first_day_mt']);
        //update meeting frst time when save pt result
        $sql_update = "UPDATE meetings
        SET first_time='$first_time_aft', time_range='{$data['time_range']}'
        WHERE id='{$data['meeting_id']}'";
        $GLOBALS['db']->query($sql_update);

        $i = 0;
        $meeting = BeanFactory::getBean('Meetings', $data['meeting_id']);
        $meeting->load_relationship('meetings_j_ptresult_1');

        $result = new J_PTResult();
        $result->pt_order = $data['order'][$i];
        $timedate->nowDate();
        //get date add time
        $start_bef_db = $data['get_pt_date'] . ' ' . $timedate->to_db_time($timedate->nowDate().' '.$data['start_hidden'][$i]);
        $end_bef_db = $data['get_pt_date'] . ' ' . $timedate->to_db_time($timedate->nowDate().' '.$data['end_hidden'][$i]);

        $result->time_start = $start_bef_db;
        $result->time_end = $end_bef_db;

        $result->team_id = $meeting->team_id;
        $result->team_set_id = $meeting->team_set_id;
        $result->assigned_user_id = $meeting->assigned_user_id;

        $result->attended = $data['check_attended'][$i];
        $result->parent = $data['parent'][$i];

        $result->type_result = "Placement Test";

        //get Student Info
        $rela_student = BeanFactory::getBean($data['parent'][$i], $data['pt_id'][$i]);
        $result->name = $meeting->name . ' - ' . $rela_student->last_name . ' ' . $rela_student->first_name;
        $result->student_id = $data['pt_id'][$i];
        $result->save();
        $meeting->meetings_j_ptresult_1->add($result->id);

        if ($data['parent'][$i] == "Leads") {
            $rela_lead = BeanFactory::getBean('J_PTResult', $result->id);
            $rela_lead->load_relationship('leads_j_ptresult_1');
            $rela_lead->leads_j_ptresult_1->add($data['pt_id'][$i]);
        } else {
            $rela_contact = BeanFactory::getBean('J_PTResult', $result->id);
            $rela_contact->load_relationship('contacts_j_ptresult_1');
            $rela_contact->contacts_j_ptresult_1->add($data['pt_id'][$i]);
        }
        return $result->id;
    }

    /**
     * Added by Hieu Pham to update PT result when change score, note, ...
     * @param ServiceBase $api
     * @param array $data
     * @return mixed
     */
    function updatePTResult(ServiceBase $api, array $data) {
        $id_result = $data['id_of_result'][0];
        $res_koc = $data['result_koc'][0];
        $score = $data['score_result_koc'][0];
        $parts = explode(' ', $res_koc);
        $result_koc = $parts[0];
        $result_lvl = trim(str_replace($result_koc, '', $res_koc));
        //Update Lead/Student last_pt_result
        $r_up = $GLOBALS['db']->fetchOne("SELECT student_id, parent FROM j_ptresult WHERE id = '$id_result'");


        $thisResult = array(
            'listening' => strtoupper($data['listening'][0]),
            'speaking' => strtoupper($data['speaking'][0]),
            'reading' => strtoupper($data['reading'][0]),
            'writing' => strtoupper($data['writing'][0]),
            'score' => strtoupper($score),
            'result' => $res_koc,
            'result_koc' => $result_koc,
            'result_lvl' => $result_lvl,
            'attended' => $data['check_attended'][0],
            'ec_note' => $data['ec_note'][0],
            'teacher_comment' => $data['teacher_comment'][0],
        );
        $update_value = array();
        foreach ($thisResult as $key => $val)
            $update_value[] = " $key = '$val'";

        $sql_update = "UPDATE j_ptresult SET " . implode(',', $update_value) . " WHERE id='$id_result'";

        //update lead status
        if($r_up['parent'] == 'Leads' && !empty($r_up['student_id']) && $data['check_attended'][0]){
            $notInStatus = array('Converted', 'Deposit', 'PT/Demo');
            $student = BeanFactory::getBean('Leads',$r_up['student_id']);
            if(!in_array($student->status, $notInStatus)){
                $student->status = 'PT/Demo';
                $student->save();
            }    
        }
        return $GLOBALS['db']->query($sql_update);
    }

    /**
     * Added by Hieu Pham to delete PTResult record when delete in the sub-panel
     * @param ServiceBase $api
     * @param array $data
     * @return bool
     */
    function deletePTResult(ServiceBase $api, array $data) {
        $thisResult = new J_PTResult();
        $thisResult->retrieve($data['result_id']);
        if ($thisResult->id) {
            $thisResult->mark_deleted($thisResult->id);
            return true;
        }
        return false;
    }

    /**
     * Added by Hieu Pham to save all result
     * @param ServiceBase $api
     * @param array $data
     * @return bool
     */
    function saveResultAll(ServiceBase $api, array $data) {
        global $timedate;
        $meeting = BeanFactory::getBean('Meetings', $data['meeting_id']);
        $meeting->load_relationship('meetings_j_ptresult_1');
        $sql_update = "UPDATE meetings SET time_range='{$data['time_range']}' WHERE id='{$meeting->id}'";
        $GLOBALS['db']->query($sql_update);
        for ($i = 1; $i < count($data['id_of_result']); $i++) {
            $result = new J_PTResult();
            $result->retrieve($data['id_of_result'][$i]);
            if ($result->id) {
                $result->pt_order = $data['order'][$i];

                $start_bef_db = $data['get_pt_date'] . ' ' . $timedate->to_db_time($timedate->nowDate().' '.$data['start_hidden'][$i]);
                $end_bef_db = $data['get_pt_date'] . ' ' . $timedate->to_db_time($timedate->nowDate().' '.$data['end_hidden'][$i]);

                $result->time_start = $start_bef_db;
                $result->time_end = $end_bef_db;

                $result->save();
            }
        }
        return true;
    }

    /**
     * Added by Hieu Pham to move result to another Meeting
     * @param ServiceBase $api
     * @param array $data
     * @return bool
     */
    function movePTResult(ServiceBase $api, array $data) {
        $results = $data["results"];
        $meetingId = $data["meeting_id"];

        foreach ($results as $id) {
            $result = BeanFactory::getBean('J_PTResult', $id);
            $meeting = BeanFactory::getBean('Meetings', $meetingId);
            $result->team_id = $meeting->team_id;
            $result->team_set_id = $meeting->team_set_id;
            $result->assigned_user_id = $meeting->assigned_user_id;
            $result->ec_note = "";
            $result->save();

            $meeting = BeanFactory::getBean('Meetings', $meetingId);
            $meeting->load_relationship('meetings_j_ptresult_1');
            $meeting->meetings_j_ptresult_1->add($id);
        }

        return "success";
    }

    /**
     * Added by Hieu Pham to save demo result after add in sub-panel view
     * @param ServiceBase $api
     * @param array $data
     * @return bool
     */
    function saveDemoResult(ServiceBase $api, array $data) {
        global $timedate;
        $meeting = BeanFactory::getBean('Meetings', $data['meeting_id']);
        $meeting->load_relationship('meetings_j_ptresult_1');
        $i = 0;
        $result = new J_PTResult();
        $result->team_id = $meeting->team_id;
        $result->team_set_id = $meeting->team_set_id;
        $result->assigned_user_id = $meeting->assigned_user_id;
        $result->attended = $data['check_attended'][$i];
        $result->parent = $data['parent'][$i];
        $result->ec_note = $data['ec_note'][$i];
        $result->type_result = "Demo";
        $result->time_start = $meeting->date_start;
        $result->time_end = $meeting->date_end;

        //get Student Info
        $rela_student = BeanFactory::getBean($data['parent'][$i], $data['pt_id'][$i]);
        $result->name = $meeting->name . ' - ' . $rela_student->last_name . ' ' . $rela_student->first_name;

        $result->student_id = $data['demo_id'][$i];
        $result->save();
        $meeting->meetings_j_ptresult_1->add($result->id);

        if ($result->parent == "Leads") {
            $rela_lead = BeanFactory::getBean('J_PTResult', $result->id);
            $rela_lead->load_relationship('leads_j_ptresult_1');
            $rela_lead->leads_j_ptresult_1->add($data['demo_id'][$i]);
        } else {
            $rela_contact = BeanFactory::getBean('J_PTResult', $result->id);
            $rela_contact->load_relationship('contacts_j_ptresult_1');
            $rela_contact->contacts_j_ptresult_1->add($data['demo_id'][$i]);
        }
        return $result->id;
    }

    /**
     * Added by Hieu Pham to save demo Attended
     * @param ServiceBase $api
     * @param array $data
     * @return bool
     */
    function saveDemoAttended(ServiceBase $api, array $data) {
        $sql_up_taken = "UPDATE j_ptresult SET attended='{$data['check_attended'][0]}' WHERE id='{$data['id_of_result'][0]}'";
        return $GLOBALS['db']->query($sql_up_taken);

        //update lead status
        $r_up = $GLOBALS['db']->fetchOne("SELECT student_id, parent FROM j_ptresult WHERE id = '{$data['id_of_result'][0]}'");
        if($r_up['parent'] == 'Leads' && !empty($r_up['student_id'])){
            $notInStatus = array('Converted', 'Deposit', 'PT/Demo');
            $student = BeanFactory::getBean('Leads',$r_up['student_id']);
            if(!in_array($student->status, $notInStatus)){
                $student->status = 'PT/Demo';
                $student->save();
            }    
        }
    }

    /**
     * Added by Hieu Pham to save update EC Note demo result
     * @param ServiceBase $api
     * @param array $data
     * @return bool
     */
    function updateECNote($data) {
        $sql_update_koc = "UPDATE j_ptresult SET ec_note='{$data['ec_note'][0]}'  WHERE id='{$data['id_of_result'][0]}'";
        return $GLOBALS['db']->query($sql_update_koc);
    }
}