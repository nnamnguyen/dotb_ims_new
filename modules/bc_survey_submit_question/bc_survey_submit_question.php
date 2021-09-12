<?PHP

/*
 * Your installation or use of this DotbCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotbCRM file.
 *
 * Copyright (C) DotbCRM Inc. All rights reserved.
 */
/**
 * THIS CLASS IS FOR DEVELOPERS TO MAKE CUSTOMIZATIONS IN
 */
require_once('modules/bc_survey_submit_question/bc_survey_submit_question_dotb.php');

class bc_survey_submit_question extends bc_survey_submit_question_dotb {

    function custom_retrieve_by_string_fields($fields_array, $encode = true, $deleted = true) {
        global $db;
        if ($db->dbType == "mssql") {
            $group_con = " STRING_AGG(sa.name,',') ";
        } else {
            $group_con = " GROUP_CONCAT(sa.name) ";
        }
        $exportQuestionReportCSV = $fields_array['exportQuestionReportCSV'];
        $where_clause = $this->get_where($fields_array, $deleted);
        $whereClause = " ssq.survey_ID = '{$fields_array['survey_ID']}' and ssq.deleted = 0";
        if (array_key_exists('submission_id', $fields_array)) {
            $whereClause = " ssq.survey_ID = '{$fields_array['survey_ID']}' and ssq.submission_id = '{$fields_array['submission_id']}'  and ssq.deleted = 0 ";
        }
        $query = "SELECT
                    ssq.id,
                    ssq.name AS qName,
                    ssq.question_id AS question_id,
                    ssq.question_type AS question_type,
                    bc_survey_questions.piping_sequence AS piping_sequence,
                    {$group_con} AS ansName
                  FROM
                    bc_survey_submit_question AS ssq
                  LEFT JOIN
                    bc_survey_submit_question_bc_survey_answers_c AS ssqsa ON ssqsa.bc_survey_c9f6uestion_ida = ssq.id 
                    AND ssqsa.deleted = 0 
                    AND ssq.deleted = 0
                  LEFT JOIN
                    bc_survey_answers AS sa ON sa.id = ssqsa.bc_survey_submit_question_bc_survey_answersbc_survey_answers_idb 
                    AND sa.deleted = 0
                  LEFT JOIN
                    bc_survey_questions_bc_survey_submit_question_1_c 
                    ON bc_survey_questions_bc_survey_submit_question_1_c.bc_survey_bb7auestion_idb = ssq.id 
                    AND bc_survey_questions_bc_survey_submit_question_1_c.deleted = 0
                  LEFT JOIN
                    bc_survey_questions ON bc_survey_questions.id = bc_survey_questions_bc_survey_submit_question_1_c.bc_survey_6a25estions_ida 
                    AND bc_survey_questions.deleted = 0
                   left join bc_survey_pages_bc_survey_questions_c on bc_survey_pages_bc_survey_questions_c.bc_survey_pages_bc_survey_questionsbc_survey_questions_idb = bc_survey_questions.id
                    and bc_survey_questions.deleted = 0 and bc_survey_pages_bc_survey_questions_c.deleted = 0
                    left join bc_survey_pages on bc_survey_pages.id = bc_survey_pages_bc_survey_questions_c.bc_survey_pages_bc_survey_questionsbc_survey_pages_ida
                    and bc_survey_pages.deleted = 0
                  WHERE
                    {$whereClause} AND ssq.deleted = 0 and ssq.name != ''
                    Group by ssq.id,ssq.name,bc_survey_pages.page_sequence,bc_survey_questions.question_sequence
                    order by bc_survey_pages.page_sequence asc, bc_survey_questions.question_sequence asc";
        $runQuery = $this->db->query($query);
        $returnDataArr = array();
        $piping_wise_answers = array();

        // Question - Answer Piping Allowed Question Types :: START
        $QType_allowedforquestionpiping = array('radio-button', 'dropdownlist', 'check-box', 'multiselectlist', 'boolean', 'netpromoterscore', 'emojis', 'textbox', 'commentbox', 'scale', 'rating', 'date-time', 'matrix', 'contact-information', 'doc-attachment');
        $QType_allowedforanswerpiping = array('radio-button', 'dropdownlist', 'netpromoterscore', 'emojis', 'textbox', 'commentbox', 'scale', 'rating');
        $QType_appliedforanswerpiping = array('radio-button', 'dropdownlist', 'check-box', 'multiselectlist', 'emojis');
        // Question - Answer Piping Allowed Question Types :: END

        while ($result = $this->db->fetchByAssoc($runQuery)) {
            if ($result['ansName'] == 'selection_default_value_dropdown' || empty($result['ansName'])) {
                $result['ansName'] = 'N/A';
            }
            // Replace Answer Piping Text with Actual answer submitted
            if (in_array($result['question_type'], $QType_appliedforanswerpiping)) {
                // Replace Piping string with _blank_
                $fullstring = $result['ansName'];
                $occu = substr_count($fullstring, "{{Q");
                $piping_seq = array();
                for ($i = 0; $i < $occu; $i++) {
                    $sub_part = explode('{{Q', $fullstring)[1];
                    $current_piping_seq = explode('}}', $sub_part)[0];
                    $piping_seq .= explode('}}', $sub_part)[0] . ' ';
                    $fullstring = str_replace('{{Q' . trim($current_piping_seq) . '}}', $piping_wise_answers[$current_piping_seq], $fullstring);
                }
                $result['ansName'] = $fullstring;
            }
            if (in_array($result['question_type'], $QType_allowedforanswerpiping)) {
                $piping_wise_answers[$result['piping_sequence']] = $result['ansName'];
            }
            // Replace Answer Piping Text with Actual answer submitted
            $que_title = $result['qName'];
            if (in_array($result['question_type'], $QType_allowedforquestionpiping)) {
                // Replace Piping string with _blank_
                $fullstring = $que_title;
                $occu = substr_count($fullstring, "{{Q");
                $piping_seq = array();
                for ($i = 0; $i < $occu; $i++) {
                    $sub_part = explode('{{Q', $fullstring)[1];
                    $current_piping_seq = explode('}}', $sub_part)[0];
                    $piping_seq .= explode('}}', $sub_part)[0] . ' ';
                    $fullstring = str_replace('{{Q' . trim($current_piping_seq) . '}}', $piping_wise_answers[$current_piping_seq], $fullstring);
                }
                $result['qName'] = $fullstring;
            }
//            if (!in_array($exportQuestionReportCSV, $fields_array)) {
//                $returnDataArr[] = array($result['qName'] => $result['ansName']);
//            } else {
            $returnDataArr[$result['question_id']] = array($result['qName'] => $result['ansName']);
//            }
        }

        return $returnDataArr;
    }

}
