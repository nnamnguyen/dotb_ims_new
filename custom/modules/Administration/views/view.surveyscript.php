<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('include/MVC/View/DotbView.php');
require_once("include/DotbSmarty/Dotb_Smarty.php");
require_once 'custom/include/utilsfunction.php';

/**
 * generate report data and pass to report.tpl file
 *
 * @author     Original Author Biztech Co
 */
class ViewSurveyScript extends DotbView {

    function display() {
        global $db;
        require_once 'custom/biz/classes/Surveyutils.php';
        echo "<script src='custom/include/js/survey_js/custom_code.js'></script>";
        $checkSurveySubscription = Surveyutils::validateSurveySubscription();
        $GLOBALS['log']->fatal('This is the result : sdclsdklj');
        if (!$checkSurveySubscription['success']) {
            if (!empty($checkSurveySubscription['message'])) {
                // license not validated
                echo '<div style="color: #F11147;text-align: center;background: #FAD7EC;padding: 10px;margin: 3% auto;width: 70%;top: 50%;left: 0;right: 0;border: 1px solid #F8B3CC;font-size : 14px;">' . $checkSurveySubscription['message'] . '</div>';
            }
        } else {
            echo '<h2>Migrating Scripts </h2></br> ';
            $custom_script_migration = new Administration();
            $custom_script_migration->retrieveSettings('SurveyPlugin');
            $ScriptOneMigration = $custom_script_migration->settings['SurveyPlugin_SurveyProductScriptOne'];
            $ScriptTwoMigration = $custom_script_migration->settings['SurveyPlugin_SurveyProductScriptTwo'];
            $scriptCount = 0;
            $scriptCountOne = 0;
            $scriptCountTwo = 0;

            if ($ScriptOneMigration == 0) {
                $scriptCount++;
                echo "<b> Migration Script " . $scriptCount . "</b> for survey report : </br>";
                // To insert rating type submission data. By Govind. One Time Script.
                $q1 = "select COUNT(1) as num_rows from bc_survey_submit_answer_calculation where answer_type = 'rating'";
                $runQ = $db->query($q1);
                $RowsOfrunQ = $db->fetchByAssoc($runQ);
                if ($RowsOfrunQ['num_rows'] == 0) {
                    $q2 = "SELECT 
                        sq.question_type AS answer_type,
                        sa.answer_name AS submit_answer_id,
                        bc_survey.id AS sent_survey_id,
                        CASE
                            WHEN ss.submission_type = 'Open Ended' THEN ss.customer_name
                            ELSE ss.target_parent_id
                        END AS survey_receiver_id,
                        sq.id AS question_id,
                        ss.id AS submission_id
                    FROM
                        bc_survey
                            JOIN
                        bc_survey_submission_bc_survey_c AS sss 
                        ON sss.bc_survey_submission_bc_surveybc_survey_ida = bc_survey.id
                            AND sss.deleted = 0
                            AND bc_survey.deleted = 0
                            JOIN
                        bc_survey_submission AS ss 
                        ON ss.id = sss.bc_survey_submission_bc_surveybc_survey_submission_idb
                            AND ss.deleted = 0
                            AND sss.deleted = 0
                            JOIN
                        bc_submission_data_bc_survey_submission_c AS sdss 
                        ON sdss.bc_submission_data_bc_survey_submissionbc_survey_submission_ida = ss.id
                            AND sdss.deleted = 0
                            JOIN
                        bc_submission_data_bc_survey_answers_c AS sdsa 
                        ON sdsa.bc_submission_data_bc_survey_answersbc_submission_data_idb = sdss.bc_submission_data_bc_survey_submissionbc_submission_data_idb
                            AND sdsa.deleted = 0
                            JOIN
                        bc_survey_answers AS sa 
                        ON sa.id = sdsa.bc_submission_data_bc_survey_answersbc_survey_answers_ida
                            AND sa.deleted = 0
                            LEFT JOIN
                        bc_submission_data_bc_survey_questions_c AS sdsq 
                        ON sdsq.bc_submission_data_bc_survey_questionsbc_submission_data_idb = sdss.bc_submission_data_bc_survey_submissionbc_submission_data_idb
                            AND sdsq.deleted = 0
                            LEFT JOIN
                        bc_survey_questions AS sq 
                        ON sq.id = sdsq.bc_submission_data_bc_survey_questionsbc_survey_questions_ida
                            AND sq.deleted = 0
                    WHERE
                        sq.question_type in ('rating','textbox', 'commentbox', 'contact-information') and ss.status = 'Submitted'";
                    $runQ2 = $db->query($q2);
                    while ($insertDataArray = $db->fetchByAssoc($runQ2)) {
                        $scriptCountOne++;
                        $GLOBALS['log']->fatal('This is the result : $insertDataArray', print_r($insertDataArray, 1));
                        $contactSubDetails = '';
                        $contactSubDetailsInsert = array();
                        if ($insertDataArray['answer_type'] == 'contact-information') {
                            $contactSubDetails = html_entity_decode($insertDataArray['submit_answer_id']);
                            $contactSubDetailsInsert[$insertDataArray['question_id']] = json_decode($contactSubDetails, true);
                            $contactInfo = count(array_count_values(json_decode($contactSubDetails, true)));
                            $contactSubDetails = json_encode($contactSubDetailsInsert);
                            if ($contactInfo <= 1) {
                                $insertDataArray['submit_answer_id'] = '';
                            } else {
                                $insertDataArray['submit_answer_id'] = $contactSubDetails;
                            }
                        }
                        $selectData = "SELECT
                            COUNT(*) as count
                          FROM
                            bc_survey_submit_answer_calculation
                          WHERE
                            question_id = '{$insertDataArray['question_id']}' AND submission_id = '{$insertDataArray['submission_id']}'";
                        $selectDataQ = $db->query($selectData);
                        $selectDataArray = $db->fetchByAssoc($selectDataQ);
                        if ($selectDataArray['count'] < 1) {
                            $GLOBALS['log']->fatal('This is the result : Check');
                            $id = create_guid();
                            $insertData = "Insert into bc_survey_submit_answer_calculation(
                                id,
                                answer_type,
                                submit_answer_id,
                                sent_survey_id,
                                survey_receiver_id,
                                question_id,
                                submission_id
                                ) values ('{$id}',
                                          '{$insertDataArray['answer_type']}',
                                          '{$insertDataArray['submit_answer_id']}',
                                          '{$insertDataArray['sent_survey_id']}',
                                          '{$insertDataArray['survey_receiver_id']}',
                                          '{$insertDataArray['question_id']}',
                                          '{$insertDataArray['submission_id']}'
                                )";
                            $db->query($insertData);
                        }
                    }
                }
                // End
                $custom_script_migration->saveSetting("SurveyPlugin", "SurveyProductScriptOne", 1);
                echo '<b>' . $scriptCountOne . '</b> records updated. </br> </br>';
            }
            if ($ScriptTwoMigration == 0) {
                $scriptCount++;
                echo "<b> Migration Script " . $scriptCount . "</b> for survey report : </br>";
                //To insert submission id in bc_survey_submit_answer_calculation
                $DataPresentquery = "select COUNT(1) as num_rows from bc_survey_submit_answer_calculation";
                $runQ = $db->query($DataPresentquery);
                $RowsOfrunQ = $db->fetchByAssoc($runQ);
                if ($RowsOfrunQ['num_rows'] != 0) {
                    $PreviousSurveyData = array();
                    $has_column = false;
                    if ($db->dbType == "mssql") {
                        $SubmissionFieldsql = $db->query("EXEC sp_columns 'bc_survey_submit_answer_calculation'");
                    } else {
                        $SubmissionFieldsql = $db->query("SELECT * FROM bc_survey_submit_answer_calculation LIMIT 1");
                    }

                    while ($answer_rows = $db->fetchByAssoc($SubmissionFieldsql)) {
                        if ($db->dbType == "mssql") {
                            if ($answer_rows['COLUMN_NAME'] == "submission_id") {
                                $has_column = true;
                            }
                        } else {
                            if (isset($answer_rows['submission_id'])) {
                                $has_column = true;
                            }
                        }
                    }
                    if ($has_column == true) {

                        $DataPresentquery = "SELECT sent_survey_id AS survey_id,question_id, survey_receiver_id FROM bc_survey_submit_answer_calculation  WHERE (submission_id IS NULL OR submission_id = '')";
                        $DataPresentQ = $db->query($DataPresentquery);
                        while ($row = $db->fetchByAssoc($DataPresentQ)) {

                            if (str_split($row['survey_receiver_id'], 8)[0] == 'Web Link') {
                                $where_reciever = " submission.name = '{$row['survey_receiver_id']}' ";
                            } else {
                                $where_reciever = " submission.target_parent_id = '{$row['survey_receiver_id']}' ";
                            }

                            $qry = "SELECT bc_survey_submission_bc_surveybc_survey_ida AS survey_id,submission.id AS submission_id,target_parent_id,customer_name FROM bc_survey_submission submission
                                LEFT JOIN bc_survey_submission_bc_survey_c ON bc_survey_submission_bc_surveybc_survey_submission_idb = submission.id
                                   WHERE submission.deleted = 0 
                                    AND $where_reciever  
                                        AND bc_survey_submission_bc_survey_c.bc_survey_submission_bc_surveybc_survey_ida = '{$row['survey_id']}'";
                            $result = $db->query($qry);

                            while ($row_inner = $db->fetchByAssoc($result)) {
                                $scriptCountTwo++;
                                $qry_to_update = "UPDATE bc_survey_submit_answer_calculation SET submission_id = '{$row_inner['submission_id']}' WHERE sent_survey_id = '{$row['survey_id']}' AND survey_receiver_id = '{$row['survey_receiver_id']}'";
                                $db->query($qry_to_update);
                                $GLOBALS['log']->fatal('This is the $qry_to_update : ', print_r($qry_to_update, 1));
                            }
                        }
                    }
                }
                $custom_script_migration->saveSetting("SurveyPlugin", "SurveyProductScriptTwo", 1);
                echo '<b>' . $scriptCountTwo . '</b> records updated.</br> </br>';
            }

//            echo '<input title="Back to Administrator" class="button primary back" onclick="javascript:parent.DOTB.App.router.navigate(\'#bwc/index.php?module=Administration&action=health_check\', {trigger: true})"  name="back" value="Back to Administrator" type="button">';
            echo '<input title="Back to Administrator" class="button primary back" onclick="document.location.href=\'index.php?module=Administration&action=index\'" name="back" value="Back to Administrator" type="button">';

            parent::display();
        }
    }

}
