
<?php
/**
 * The file used to handle preview survey view  
 *
 * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
 * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
 * agreed to the terms and conditions of the License, and you may not use this file except in compliance
 * with the License.
 *
 * @author     Biztech Consultancy
 */
if (!defined('dotbEntry') || !dotbEntry)
    define('dotbEntry', true);
include_once('config.php');
require_once('include/entryPoint.php');
require_once('data/DotbBean.php');
require_once('data/BeanFactory.php');
require_once('include/utils.php');
require_once('include/database/DBManager.php');
require_once('include/database/DBManagerFactory.php');
require_once 'custom/include/utilsfunction.php';
global $dotb_config;
$survey_id = $_REQUEST['survey_id'];
$survey = new bc_survey();
$survey->retrieve($survey_id);
$default_survey_language = $survey->default_survey_language;


// get survey supported language
if (empty($_REQUEST['selected_lang'])) {
    $selected_lang = $default_survey_language;
} else if (isset($_REQUEST['selected_lang']) && !empty($_REQUEST['selected_lang'])) {
    $selected_lang = $_REQUEST['selected_lang'];
} else {
    $selected_lang = $dotb_config['default_language'];
}
$langValues_array = return_app_list_strings_language($selected_lang);
$langValues = $langValues_array['available_language_dom'];
$supported_lang = unencodeMultienum($survey->supported_survey_language);

foreach ($supported_lang as $key => $slang) {
    $oLang = BeanFactory::getBean('bc_survey_language');
    $oLang->retrieve_by_string_fields(array('bc_survey_id_c' => $survey_id, 'survey_lang' => $slang, 'translated' => 1, 'status' => 'enabled'));
    if (!empty($oLang->id)) {
        $available_lang[$slang] = $langValues[$slang];
    }
}

//check text_direction of selected language

$oLang = BeanFactory::getBean('bc_survey_language');
$oLang->retrieve_by_string_fields(array('bc_survey_id_c' => $survey_id, 'survey_lang' => $selected_lang, 'translated' => 1, 'status' => 'enabled'), '');
$text_direction = !empty($oLang->text_direction) ? $oLang->text_direction : 'left_to_right';
// list of lang wise survey detail
$list_lang_detail = array();
$list_lang_detail_array = return_app_list_strings_language($selected_lang);
if (isset($list_lang_detail_array) && isset($list_lang_detail_array[$survey_id])) {
    $list_lang_detail = $list_lang_detail_array[$survey_id];
}
$is_progress_indicator = $survey->is_progress;
$survey->load_relationship('bc_survey_pages_bc_survey');
$survey_details = array();
$themeObject = DotbThemeRegistry::current();
$favicon = $themeObject->getImageURL('dotb_icon.ico', false);
$questions = array();
foreach ($survey->bc_survey_pages_bc_survey->getBeans() as $pages) {
    unset($questions);
    $survey_details[$pages->page_sequence]['page_title'] = (isset($list_lang_detail) && !empty($list_lang_detail[$pages->id])) ? $list_lang_detail[$pages->id] : $pages->name;
    $survey_details[$pages->page_sequence]['page_number'] = $pages->page_number;
    $survey_details[$pages->page_sequence]['page_id'] = $pages->id;
    $pages->load_relationship('bc_survey_pages_bc_survey_questions');
    foreach ($pages->bc_survey_pages_bc_survey_questions->getBeans() as $survey_questions) {
        $questions[$survey_questions->question_sequence]['que_id'] = $survey_questions->id;
        $questions[$survey_questions->question_sequence]['que_title'] = (!empty($list_lang_detail[$survey_questions->id . '_que_title'])) ? $list_lang_detail[$survey_questions->id . '_que_title'] : $survey_questions->name;
        $questions[$survey_questions->question_sequence]['que_type'] = $survey_questions->question_type;
        if ($survey_questions->question_type == 'richtextareabox') {
            $questions[$survey_questions->question_sequence]['richtextContent'] = $survey_questions->richtextContent;
        }
        $questions[$survey_questions->question_sequence]['is_required'] = $survey_questions->is_required;
        $questions[$survey_questions->question_sequence]['is_question_seperator'] = $survey_questions->is_question_seperator;
        $questions[$survey_questions->question_sequence]['file_size'] = $survey_questions->file_size;
        $questions[$survey_questions->question_sequence]['file_extension'] = $survey_questions->file_extension;
        $questions[$survey_questions->question_sequence]['question_help_comment'] = (!empty($list_lang_detail[$survey_questions->id . '_question_help_comment'])) ? $list_lang_detail[$survey_questions->id . '_question_help_comment'] : $survey_questions->question_help_comment;
        $questions[$survey_questions->question_sequence]['display_boolean_label'] = (!empty($list_lang_detail[$survey_questions->id . '_display_boolean_label'])) ? $list_lang_detail[$survey_questions->id . '_display_boolean_label'] : $survey_questions->display_boolean_label;
        $questions[$survey_questions->question_sequence]['is_image_option'] = $survey_questions->is_image_option;
        $questions[$survey_questions->question_sequence]['show_option_text'] = $survey_questions->show_option_text;
        //changes Regarding the Disable Questions not to show in survey preview form 08-08-2019
        $questions[$survey_questions->question_sequence]['disabled_question'] = $survey_questions->disabled_question;

        //advance options
        $questions[$survey_questions->question_sequence]['advance_type'] = (isset($survey_questions->advance_type)) ? $survey_questions->advance_type : '';
        $questions[$survey_questions->question_sequence]['maxsize'] = (isset($survey_questions->maxsize)) ? $survey_questions->maxsize : '';
        $questions[$survey_questions->question_sequence]['min'] = (isset($survey_questions->min)) ? $survey_questions->min : '';
        $questions[$survey_questions->question_sequence]['max'] = (isset($survey_questions->max)) ? $survey_questions->max : '';
        $questions[$survey_questions->question_sequence]['precision'] = (isset($survey_questions->precision_value)) ? $survey_questions->precision_value : '';
        $questions[$survey_questions->question_sequence]['is_datetime'] = (isset($survey_questions->is_datetime) ) ? $survey_questions->is_datetime : '';
        $questions[$survey_questions->question_sequence]['allow_future_dates'] = (isset($survey_questions->allow_future_dates) ) ? $survey_questions->allow_future_dates : '';
        $questions[$survey_questions->question_sequence]['is_sort'] = (isset($survey_questions->is_sort) ) ? $survey_questions->is_sort : '';
        $questions[$survey_questions->question_sequence]['enable_otherOption'] = (isset($survey_questions->enable_otherOption) ) ? $survey_questions->enable_otherOption : '';
        $questions[$survey_questions->question_sequence]['matrix_row'] = (isset($survey_questions->matrix_row)) ? base64_decode($survey_questions->matrix_row) : '';
        $questions[$survey_questions->question_sequence]['matrix_col'] = (isset($survey_questions->matrix_col)) ? base64_decode($survey_questions->matrix_col) : '';
        $questions[$survey_questions->question_sequence]['description'] = (isset($survey_questions->description)) ? $survey_questions->description : '';


        $survey_questions->load_relationship('bc_survey_answers_bc_survey_questions');
        $questions[$survey_questions->question_sequence]['answers'] = array();
        foreach ($survey_questions->bc_survey_answers_bc_survey_questions->getBeans() as $survey_answers) {
            if ($questions[$survey_questions->question_sequence]['is_required'] && !isset($survey_answers->answer_name)) {
                continue;
            } else {
                $questions[$survey_questions->question_sequence]['answers'][$survey_answers->answer_sequence][$survey_answers->id] = (!empty($list_lang_detail[$survey_answers->id])) ? $list_lang_detail[$survey_answers->id] : $survey_answers->answer_name;
            }
        }
        ksort($questions[$survey_questions->question_sequence]['answers']);
    }
    ksort($questions);
    $survey_details[$pages->page_sequence]['page_questions'] = $questions;
    ksort($survey_details);
}



/* * Create layout of question and answer for the preview
 * 
 * @param type $answers - options for multi choice
 * @param type $type - question type
 * @param type $que_id - question id of 36 char
 * @param type $is_required - is required or not 
 * @param type $maxsize - max size allowed for answer
 * @param type $min - min value for answer
 * @param type $max - max value for answer
 * @param type $precision - precision value for float type
 * @param type $scale_slot - scale slot value for scale type
 * @param type $is_sort - sorting
 * @param type $is_datetime - is datetime selected or not for date-time question
 * @param type $advancetype - advance option for question
 * @param type $que_title - question title
 * @param type $matrix_row - matrix rows detail
 * @param type $matrix_col - matrix cols detail
 * @param type $description - question description
 * @return string
 */

function getMultiselectHTML($queArr, $list_lang_detail, $richtextContent, $survey_id) {
    global $db;
    $html = "";
    $display_boolean_label = (isset($queArr['display_boolean_label'])) ? $queArr['display_boolean_label'] : '';
    $answers = (isset($queArr['answers'])) ? $queArr['answers'] : '';
    $type = (isset($queArr['que_type'])) ? $queArr['que_type'] : '';
    $que_id = (isset($queArr['que_id'])) ? $queArr['que_id'] : '';
    $is_required = (isset($queArr['is_required'])) ? $queArr['is_required'] : '';
    $maxsize = (isset($queArr['maxsize'])) ? $queArr['maxsize'] : '';
    $min = (isset($queArr['min'])) ? $queArr['min'] : '';
    $max = (isset($queArr['max'])) ? $queArr['max'] : '';
    $is_sort = (isset($queArr['is_sort'])) ? $queArr['is_sort'] : '';
    $is_datetime = (isset($queArr['is_datetime'])) ? $queArr['is_datetime'] : '';
    $allow_future_dates = (isset($queArr['allow_future_dates'])) ? $queArr['allow_future_dates'] : '';
    $advancetype = (isset($queArr['advance_type'])) ? $queArr['advance_type'] : '';
    $que_title = (isset($queArr['que_title'])) ? $queArr['que_title'] : '';
    $matrix_row = (isset($queArr['matrix_row'])) ? $queArr['matrix_row'] : '';
    $matrix_col = (isset($queArr['matrix_col'])) ? $queArr['matrix_col'] : '';
    $description = (isset($queArr['description'])) ? $queArr['description'] : '';
    $is_image_option = (isset($queArr['is_image_option'])) ? $queArr['is_image_option'] : '';
    $show_option_text = (isset($queArr['show_option_text'])) ? $queArr['show_option_text'] : '';
    switch ($type) {
        case 'multiselectlist':
            $placeholder_label_other = '';
            if (isset($list_lang_detail[$que_id . '_other_placeholder_label']) && $list_lang_detail[$que_id . '_other_placeholder_label']) {
                $placeholder_label_other = $list_lang_detail[$que_id . '_other_placeholder_label'];
            }
            $html = "<div class='option multiselect-list  two-col' id='{$que_id}_div'>
                    <input type='hidden' name='placeholder_label_other_{$que_id}' value='{$placeholder_label_other}' />
                    <select class='form-control multiselect {$que_id}' multiple='' size='10' name='{$que_id}[]' onchange='addOtherField(this);showReset(this);'>";
            //if sorting
            if ($is_sort == 1) {
                foreach ($answers as $ans) {
                    foreach ($ans as $ans_id => $answer) {
                        $OtherAnswerType = '';
                        $OtherAnswerQuery = "Select answer_type FROM bc_survey_answers WHERE id='{$ans_id}'";
                        $OtherAnswerQueryData = $db->fetchByAssoc($db->query($OtherAnswerQuery));
                        $OtherAnswerType = $OtherAnswerQueryData['answer_type'];
                        if ($OtherAnswerType != 'other') {
                            $options[$ans_id] = $answer;
                        } else {
                            $optionsOther[$ans_id] = $answer;
                        }
                    }
                }
                asort($options);
                if (!empty($optionsOther)) {
                    $options = $options + $optionsOther;
                }
                foreach ($options as $ans_id => $answer) {
                    // Replace Piping string with _blank_
                    $fullstring = $answer;
                    $occu = substr_count($fullstring, "{{Q");
                    $piping_seq = array();
                    for ($i = 0; $i < $occu; $i++) {
                        $sub_part = explode('{{Q', $fullstring)[1];
                        $current_piping_seq = explode('}}', $sub_part)[0];
                        $piping_seq .= explode('}}', $sub_part)[0] . ' ';
                        $fullstring = str_replace('{{Q' . trim($current_piping_seq) . '}}', ' <span class="que_pipe_' . $current_piping_seq . '"> </span>', $fullstring);
                    }
                    $answer = $fullstring;
                    // check if answer is other type of or not
                    $is_other = '';
                    $oAnswer = BeanFactory::getBean('bc_survey_answers', $ans_id);
                    if ($oAnswer->answer_type == 'other') {
                        $is_other = 'is_other_option';
                    }
                    $html .= "<option value='{$ans_id}' class='{$is_other}'>" . htmlspecialchars_decode($answer) . "</option>";
                }
            }
            // not sorting
            else {
                foreach ($answers as $ans) {
                    foreach ($ans as $ans_id => $answer) {
                        // Replace Piping string with _blank_
                        $fullstring = $answer;
                        $occu = substr_count($fullstring, "{{Q");
                        $piping_seq = array();
                        for ($i = 0; $i < $occu; $i++) {
                            $sub_part = explode('{{Q', $fullstring)[1];
                            $current_piping_seq = explode('}}', $sub_part)[0];
                            $piping_seq .= explode('}}', $sub_part)[0] . ' ';
                            $fullstring = str_replace('{{Q' . trim($current_piping_seq) . '}}', ' <span class="que_pipe_' . $current_piping_seq . '"> </span>', $fullstring);
                        }
                        $answer = $fullstring;
                        // check if answer is other type of or not
                        $is_other = '';
                        $oAnswer = BeanFactory::getBean('bc_survey_answers', $ans_id);
                        if ($oAnswer->answer_type == 'other') {
                            $is_other = 'is_other_option';
                        }
                        $html .= "<option value='{$ans_id}' class='{$is_other}'>" . htmlspecialchars_decode($answer) . "</option>";
                    }
                }
            }

            $html .= "</select></div>";
            return $html;
            break;
        case 'check-box':
            $placeholder_label_other = '';
            if (isset($list_lang_detail[$que_id . '_other_placeholder_label']) && $list_lang_detail[$que_id . '_other_placeholder_label']) {
                $placeholder_label_other = $list_lang_detail[$que_id . '_other_placeholder_label'];
            }
            $html = "<div class='option checkbox-list' id='{$que_id}_div'>"
                    . " <input type='hidden' name='placeholder_label_other_{$que_id}' value='{$placeholder_label_other}' />";
            if ($advancetype == 'Horizontal') {
                //changes for normal horizontal option by kairvi 22/11/2018
                if ($is_image_option) {
                    $html .= '<ul class="horizontal-options is_image_horizontal">';
                } else {
                    $html .= '<ul class="horizontal-options">';
                }
            } else {
                $html .= '<ul>';
            }
            //if sorting
            if ($is_sort == 1) {

                foreach ($answers as $ans) {
                    foreach ($ans as $ans_id => $answer) {
                        $OtherAnswerType = '';
                        $OtherAnswerQuery = "Select answer_type FROM bc_survey_answers WHERE id='{$ans_id}'";
                        $OtherAnswerQueryData = $db->fetchByAssoc($db->query($OtherAnswerQuery));
                        $OtherAnswerType = $OtherAnswerQueryData['answer_type'];
                        if ($OtherAnswerType != 'other') {
                            $options[$ans_id] = $answer;
                        } else {
                            $optionsOther[$ans_id] = $answer;
                        }
                    }
                }
                asort($options);
                if (!empty($optionsOther)) {
                    $options = $options + $optionsOther;
                }
                // if horizontal
                if ($advancetype == 'Horizontal') {
                    $op = 1;
                    if ($is_image_option) {
                        foreach ($options as $ans_id => $answer) {
                            // Replace Piping string with _blank_
                            $fullstring = $answer;
                            $occu = substr_count($fullstring, "{{Q");
                            $piping_seq = array();
                            for ($i = 0; $i < $occu; $i++) {
                                $sub_part = explode('{{Q', $fullstring)[1];
                                $current_piping_seq = explode('}}', $sub_part)[0];
                                $piping_seq .= explode('}}', $sub_part)[0] . ' ';
                                $fullstring = str_replace('{{Q' . trim($current_piping_seq) . '}}', ' <span class="que_pipe_' . $current_piping_seq . '"> </span>', $fullstring);
                            }
                            $answer = $fullstring;
                            // check if answer is other type of or not
                            $is_other = '';
                            $oAnswer = BeanFactory::getBean('bc_survey_answers', $ans_id);
                            if ($oAnswer->answer_type == 'other') {
                                $is_other = 'is_other_option';
                            }
                            $optionText = "<p>" . htmlspecialchars_decode($answer) . "</p>";
                            if (!$show_option_text) {
                                $optionText = '';
                            }
                            $html .= "<li class='md-checkbox' style='display:inline;'>"
                                    . "<label><img src='" . $oAnswer->radio_image . "'><input type='checkbox' id='{$que_id}_{$op}' value='{$ans_id}' name='{$que_id}[]' class='{$que_id} md-radiobtn {$is_other}' onchange='addOtherField(this);showReset(this);'> {$optionText} <label for='{$que_id}_{$op}'>
                                                            <span class='check'></span>
                                                            <span class='box'></span></label></label></li>";
                            $op++;
                        }
                    } else {
                        foreach ($options as $ans_id => $answer) {
                            // Replace Piping string with _blank_
                            $fullstring = $answer;
                            $occu = substr_count($fullstring, "{{Q");
                            $piping_seq = array();
                            for ($i = 0; $i < $occu; $i++) {
                                $sub_part = explode('{{Q', $fullstring)[1];
                                $current_piping_seq = explode('}}', $sub_part)[0];
                                $piping_seq .= explode('}}', $sub_part)[0] . ' ';
                                $fullstring = str_replace('{{Q' . trim($current_piping_seq) . '}}', ' <span class="que_pipe_' . $current_piping_seq . '"> </span>', $fullstring);
                            }
                            $answer = $fullstring;
                            // check if answer is other type of or not
                            $is_other = '';
                            $oAnswer = BeanFactory::getBean('bc_survey_answers', $ans_id);
                            if ($oAnswer->answer_type == 'other') {
                                $is_other = 'is_other_option';
                            }
                            $html .= "<li class='md-checkbox' style='display:inline;'><label><input type='checkbox' value='{$ans_id}' id='{$que_id}_{$op}' name='{$que_id}[]' class='{$que_id} md-check {$is_other}' onclick='addOtherField(this);showReset(this);'> " . htmlspecialchars_decode($answer) . "<label for='{$que_id}_{$op}'>"
                                    . "<span></span>
                                                            <span class='check'></span>
                                                            <span class='box'></span></label></label></li>";
                            $op++;
                        }
                    }
                }
                // if vertical
                else {
                    $op = 1;
                    foreach ($options as $ans_id => $answer) {
                        // Replace Piping string with _blank_
                        $fullstring = $answer;
                        $occu = substr_count($fullstring, "{{Q");
                        $piping_seq = array();
                        for ($i = 0; $i < $occu; $i++) {
                            $sub_part = explode('{{Q', $fullstring)[1];
                            $current_piping_seq = explode('}}', $sub_part)[0];
                            $piping_seq .= explode('}}', $sub_part)[0] . ' ';
                            $fullstring = str_replace('{{Q' . trim($current_piping_seq) . '}}', ' <span class="que_pipe_' . $current_piping_seq . '"> </span>', $fullstring);
                        }
                        $answer = $fullstring;
                        // check if answer is other type of or not
                        $is_other = '';
                        $oAnswer = BeanFactory::getBean('bc_survey_answers', $ans_id);
                        if ($oAnswer->answer_type == 'other') {
                            $is_other = 'is_other_option';
                        }
                        $html .= "<li class='md-checkbox'><label><input type='checkbox' value='{$ans_id}' name='{$que_id}[]' id='{$que_id}_{$op}' class='{$que_id} md-check {$is_other}' onchange='addOtherField(this);showReset(this);'> " . htmlspecialchars_decode($answer) . "<label for='{$que_id}_{$op}'>
                           <span></span>
                                                            <span class='check'></span>
                                                            <span class='box'></span></label></label></li>";
                        $op++;
                    }
                }
            }
            // if not sorting
            else {
                //if horizontal
                if ($advancetype == 'Horizontal') {
                    $op = 1;
                    if ($is_image_option) {
                        foreach ($answers as $ans) {
                            foreach ($ans as $ans_id => $answer) {
                                // Replace Piping string with _blank_
                                $fullstring = $answer;
                                $occu = substr_count($fullstring, "{{Q");
                                $piping_seq = array();
                                for ($i = 0; $i < $occu; $i++) {
                                    $sub_part = explode('{{Q', $fullstring)[1];
                                    $current_piping_seq = explode('}}', $sub_part)[0];
                                    $piping_seq .= explode('}}', $sub_part)[0] . ' ';
                                    $fullstring = str_replace('{{Q' . trim($current_piping_seq) . '}}', ' <span class="que_pipe_' . $current_piping_seq . '"> </span>', $fullstring);
                                }
                                $answer = $fullstring;
                                // check if answer is other type of or not
                                $is_other = '';
                                $oAnswer = BeanFactory::getBean('bc_survey_answers', $ans_id);
                                if ($oAnswer->answer_type == 'other') {
                                    $is_other = 'is_other_option';
                                }
                                $optionText = "<p>" . htmlspecialchars_decode($answer) . "</p>";
                                if (!$show_option_text) {
                                    $optionText = '';
                                }
                                $html .= "<li class='md-checkbox' style='display:inline;'><label><img src='" . $oAnswer->radio_image . "'><input type='checkbox' value='{$ans_id}' id='{$que_id}_{$op}' name='{$que_id}[]' class='{$que_id} md-radiobtn {$is_other}' onchange='addOtherField(this);showReset(this);'> {$optionText} <label for='{$que_id}_{$op}'>
                                <span></span>
                                                            <span class='check'></span>
                                                            <span class='box'></span></label></label></li>";
                            }
                            $op++;
                        }
                    } else {
                        foreach ($answers as $ans) {
                            foreach ($ans as $ans_id => $answer) {
                                // Replace Piping string with _blank_
                                $fullstring = $answer;
                                $occu = substr_count($fullstring, "{{Q");
                                $piping_seq = array();
                                for ($i = 0; $i < $occu; $i++) {
                                    $sub_part = explode('{{Q', $fullstring)[1];
                                    $current_piping_seq = explode('}}', $sub_part)[0];
                                    $piping_seq .= explode('}}', $sub_part)[0] . ' ';
                                    $fullstring = str_replace('{{Q' . trim($current_piping_seq) . '}}', ' <span class="que_pipe_' . $current_piping_seq . '"> </span>', $fullstring);
                                }
                                $answer = $fullstring;
                                // check if answer is other type of or not
                                $is_other = '';
                                $oAnswer = BeanFactory::getBean('bc_survey_answers', $ans_id);
                                if ($oAnswer->answer_type == 'other') {
                                    $is_other = 'is_other_option';
                                }
                                $html .= "<li class='md-checkbox' style='display:inline;'><label><input type='checkbox' value='{$ans_id}' id='{$que_id}_{$op}' name='{$que_id}[]' class='{$que_id} md-check {$is_other}' onchange='addOtherField(this);showReset(this);'> " . htmlspecialchars_decode($answer) . "<label for='{$que_id}_{$op}'>
                                <span></span>
                                                            <span class='check'></span>
                                                            <span class='box'></span></label></label></li>";
                                $op++;
                            }
                        }
                    }
                }
                // if vertical
                else {
                    $op = 1;
                    foreach ($answers as $ans) {
                        foreach ($ans as $ans_id => $answer) {
                            // Replace Piping string with _blank_
                            $fullstring = $answer;
                            $occu = substr_count($fullstring, "{{Q");
                            $piping_seq = array();
                            for ($i = 0; $i < $occu; $i++) {
                                $sub_part = explode('{{Q', $fullstring)[1];
                                $current_piping_seq = explode('}}', $sub_part)[0];
                                $piping_seq .= explode('}}', $sub_part)[0] . ' ';
                                $fullstring = str_replace('{{Q' . trim($current_piping_seq) . '}}', ' <span class="que_pipe_' . $current_piping_seq . '"> </span>', $fullstring);
                            }
                            $answer = $fullstring;
                            // check if answer is other type of or not
                            $is_other = '';
                            $oAnswer = BeanFactory::getBean('bc_survey_answers', $ans_id);
                            if ($oAnswer->answer_type == 'other') {
                                $is_other = 'is_other_option';
                            }
                            $html .= "<li class='md-checkbox'><label><input type='checkbox' value='{$ans_id}' name='{$que_id}[]' id='{$que_id}_{$op}' class='{$que_id} md-check {$is_other}' onchange='addOtherField(this);showReset(this);'> " . htmlspecialchars_decode($answer) . "<label for='{$que_id}_{$op}'>
                                <span></span>
                                                            <span class='check'></span>
                                                            <span class='box'></span></label></label></li>";
                            $op++;
                        }
                    }
                }
            }

            $html .= "</ul></div>";
            return $html;
            break;
        case 'boolean':
            $html = "<div class='option boolean-list' id='{$que_id}_div'>";
            $html .= '<ul>';
            // check if answer is other type of or not
            $html .= "<li class='md-checkbox' style='display:inline;'><label><input type='checkbox' value='' id='{$que_id}' name='{$que_id}' class='{$que_id}  onchange='addOtherField(this);showReset(this);'> <label for='{$que_id}'>
                                <span></span>
                                <span class='check'></span>
                                <span class='box'></span><p style='margin: -30px;'>{$display_boolean_label}</p></label></label></li>";
            $html .= "</ui></div>";
            return $html;
            break;
        case 'radio-button':
            $placeholder_label_other = '';
            if (isset($list_lang_detail[$que_id . '_other_placeholder_label']) && $list_lang_detail[$que_id . '_other_placeholder_label']) {
                $placeholder_label_other = $list_lang_detail[$que_id . '_other_placeholder_label'];
            }
            $html = "<div class='option radio-list' id='{$que_id}_div'>"
                    . " <input type='hidden' name='placeholder_label_other_{$que_id}' value='{$placeholder_label_other}' />";
            if ($advancetype == 'Horizontal') {
                //changes for normal horizontal option by kairvi 22/11/2018
                if ($is_image_option) {
                    $html .= '<ul class="horizontal-options is_image_horizontal">';
                } else {
                    $html .= '<ul class="horizontal-options">';
                }
            } else {
                $html .= '<ul>';
            }
            // if sorting
            if ($is_sort == 1) {
                foreach ($answers as $ans) {
                    foreach ($ans as $ans_id => $answer) {
                        $OtherAnswerType = '';
                        $OtherAnswerQuery = "Select answer_type FROM bc_survey_answers WHERE id='{$ans_id}'";
                        $OtherAnswerQueryData = $db->fetchByAssoc($db->query($OtherAnswerQuery));
                        $OtherAnswerType = $OtherAnswerQueryData['answer_type'];
                        if ($OtherAnswerType != 'other') {
                            $options[$ans_id] = $answer;
                        } else {
                            $optionsOther[$ans_id] = $answer;
                        }
                    }
                }
                asort($options);
                if (!empty($optionsOther)) {
                    $options = $options + $optionsOther;
                }
                // if horizontal
                if ($advancetype == 'Horizontal') {
                    $op = 1;
                    if ($is_image_option) {
                        foreach ($options as $ans_id => $answer) {
                            // check if answer is other type of or not
                            $is_other = '';
                            $oAnswer = BeanFactory::getBean('bc_survey_answers', $ans_id);
                            if ($oAnswer->answer_type == 'other') {
                                $is_other = 'is_other_option';
                            }
                            // Replace Piping string with _blank_
                            $fullstring = $answer;
                            $occu = substr_count($fullstring, "{{Q");
                            $piping_seq = array();
                            for ($i = 0; $i < $occu; $i++) {
                                $sub_part = explode('{{Q', $fullstring)[1];
                                $current_piping_seq = explode('}}', $sub_part)[0];
                                $piping_seq .= explode('}}', $sub_part)[0] . ' ';
                                $fullstring = str_replace('{{Q' . trim($current_piping_seq) . '}}', ' <span class="que_pipe_' . $current_piping_seq . '"> </span>', $fullstring);
                            }
                            $answer = $fullstring;
                            $optionText = "<p>" . htmlspecialchars_decode($answer) . "</p>";
                            if (!$show_option_text) {
                                $optionText = '';
                            }
                            $html .= "<li class='md-radio' style='display:inline;'>"
                                    . "<label><img src='" . $oAnswer->radio_image . "'><input type='radio' id='{$que_id}_{$op}' value='{$ans_id}' name='{$que_id}[]' class='{$que_id} md-radiobtn {$is_other}' onchange='addOtherField(this);showReset(this);'> {$optionText} <label for='{$que_id}_{$op}'>
                                                            <span class='check'></span>
                                                            <span class='box'></span></label></label></li>";
                            $op++;
                        }
                    } else {
                        foreach ($options as $ans_id => $answer) {
                            // Replace Piping string with _blank_
                            $fullstring = $answer;
                            $occu = substr_count($fullstring, "{{Q");
                            $piping_seq = array();
                            for ($i = 0; $i < $occu; $i++) {
                                $sub_part = explode('{{Q', $fullstring)[1];
                                $current_piping_seq = explode('}}', $sub_part)[0];
                                $piping_seq .= explode('}}', $sub_part)[0] . ' ';
                                $fullstring = str_replace('{{Q' . trim($current_piping_seq) . '}}', ' <span class="que_pipe_' . $current_piping_seq . '"> </span>', $fullstring);
                            }
                            $answer = $fullstring;
                            // check if answer is other type of or not
                            $is_other = '';
                            $oAnswer = BeanFactory::getBean('bc_survey_answers', $ans_id);
                            if ($oAnswer->answer_type == 'other') {
                                $is_other = 'is_other_option';
                            }
                            $html .= "<li class='md-radio' style='display:inline;'><label><input type='radio' id='{$que_id}_{$op}' value='{$ans_id}' name='{$que_id}[]' class='{$que_id} md-radiobtn {$is_other}' onchange='addOtherField(this);showReset(this);'><p>" . htmlspecialchars_decode($answer) . "</p><label for='{$que_id}_{$op}'>
                                                            <span class='check'></span>
                                                            <span class='box'></span></label></label></li>";
                            $op++;
                        }
                    }
                }
                // if vertical
                else {
                    $op = 1;
                    foreach ($options as $ans_id => $answer) {
                        // Replace Piping string with _blank_
                        $fullstring = $answer;
                        $occu = substr_count($fullstring, "{{Q");
                        $piping_seq = array();
                        for ($i = 0; $i < $occu; $i++) {
                            $sub_part = explode('{{Q', $fullstring)[1];
                            $current_piping_seq = explode('}}', $sub_part)[0];
                            $piping_seq .= explode('}}', $sub_part)[0] . ' ';
                            $fullstring = str_replace('{{Q' . trim($current_piping_seq) . '}}', ' <span class="que_pipe_' . $current_piping_seq . '"> </span>', $fullstring);
                        }
                        $answer = $fullstring;
                        // check if answer is other type of or not
                        $is_other = '';
                        $oAnswer = BeanFactory::getBean('bc_survey_answers', $ans_id);
                        if ($oAnswer->answer_type == 'other') {
                            $is_other = 'is_other_option';
                        }
                        $html .= "<li class='md-radio'><label><input type='radio' value='{$ans_id}' name='{$que_id}[]' id='{$que_id}_{$op}' class='{$que_id} md-radiobtn {$is_other}' onchange='addOtherField(this);showReset(this);'> " . htmlspecialchars_decode($answer) . "<label for='{$que_id}_{$op}'>
                            <span></span>
                                                            <span class='check'></span>
                                                            <span class='box'></span></label></label></li>";
                        $op++;
                    }
                }
            }
            // if not sorting
            else {
                // if horizontal
                if ($advancetype == 'Horizontal') {
                    $op = 1;
                    if ($is_image_option) {
                        foreach ($answers as $ans) {
                            foreach ($ans as $ans_id => $answer) {
                                // check if answer is other type of or not
                                $is_other = '';
                                $oAnswer = BeanFactory::getBean('bc_survey_answers', $ans_id);
                                if ($oAnswer->answer_type == 'other') {
                                    $is_other = 'is_other_option';
                                }
                                // Replace Piping string with _blank_
                                $fullstring = $answer;
                                $occu = substr_count($fullstring, "{{Q");
                                $piping_seq = array();
                                for ($i = 0; $i < $occu; $i++) {
                                    $sub_part = explode('{{Q', $fullstring)[1];
                                    $current_piping_seq = explode('}}', $sub_part)[0];
                                    $piping_seq .= explode('}}', $sub_part)[0] . ' ';
                                    $fullstring = str_replace('{{Q' . trim($current_piping_seq) . '}}', ' <span class="que_pipe_' . $current_piping_seq . '"> </span>', $fullstring);
                                }
                                $answer = $fullstring;
                                $optionText = "<p>" . htmlspecialchars_decode($answer) . "</p>";
                                if (!$show_option_text) {
                                    $optionText = '';
                                }
                                $html .= "<li class='md-radio' style='display:inline;'><label><img src='" . $oAnswer->radio_image . "'><input type='radio' value='{$ans_id}' id='{$que_id}_{$op}' name='{$que_id}[]' class='{$que_id} md-radiobtn {$is_other}' onchange='addOtherField(this);showReset(this);'> {$optionText} <label for='{$que_id}_{$op}'>
                                <span></span>
                                                            <span class='check'></span>
                                                            <span class='box'></span></label></label></li>";
                            }
                            $op++;
                        }
                    } else {
                        foreach ($answers as $ans) {
                            foreach ($ans as $ans_id => $answer) {
                                // Replace Piping string with _blank_
                                $fullstring = $answer;
                                $occu = substr_count($fullstring, "{{Q");
                                $piping_seq = array();
                                for ($i = 0; $i < $occu; $i++) {
                                    $sub_part = explode('{{Q', $fullstring)[1];
                                    $current_piping_seq = explode('}}', $sub_part)[0];
                                    $piping_seq .= explode('}}', $sub_part)[0] . ' ';
                                    $fullstring = str_replace('{{Q' . trim($current_piping_seq) . '}}', ' <span class="que_pipe_' . $current_piping_seq . '"> </span>', $fullstring);
                                }
                                $answer = $fullstring;
                                // check if answer is other type of or not
                                $is_other = '';
                                $oAnswer = BeanFactory::getBean('bc_survey_answers', $ans_id);
                                if ($oAnswer->answer_type == 'other') {
                                    $is_other = 'is_other_option';
                                }
                                $html .= "<li class='md-radio' style='display:inline;'><label><input type='radio' value='{$ans_id}' id='{$que_id}_{$op}' name='{$que_id}[]' class='{$que_id} md-radiobtn {$is_other}' onchange='addOtherField(this);showReset(this);'><p>" . htmlspecialchars_decode($answer) . "</p><label for='{$que_id}_{$op}'>
                                <span></span>
                                                            <span class='check'></span>
                                                            <span class='box'></span></label></label></li>";
                            }
                            $op++;
                        }
                    }
                }
                // if vertical
                else {
                    $op = 1;
                    foreach ($answers as $ans) {

                        foreach ($ans as $ans_id => $answer) {
                            // Replace Piping string with _blank_
                            $fullstring = $answer;
                            $occu = substr_count($fullstring, "{{Q");
                            $piping_seq = array();
                            for ($i = 0; $i < $occu; $i++) {
                                $sub_part = explode('{{Q', $fullstring)[1];
                                $current_piping_seq = explode('}}', $sub_part)[0];
                                $piping_seq .= explode('}}', $sub_part)[0] . ' ';
                                $fullstring = str_replace('{{Q' . trim($current_piping_seq) . '}}', ' <span class="que_pipe_' . $current_piping_seq . '"> </span>', $fullstring);
                            }
                            $answer = $fullstring;
                            // check if answer is other type of or not
                            $is_other = '';
                            $oAnswer = BeanFactory::getBean('bc_survey_answers', $ans_id);
                            if ($oAnswer->answer_type == 'other') {
                                $is_other = 'is_other_option';
                            }
                            $html .= " <li class='md-radio'><label><input type='radio' value='{$ans_id}' name='{$que_id}[]' id='{$que_id}_{$op}' class='{$que_id} md-radiobtn {$is_other}' onchange='addOtherField(this);showReset(this);'>" . htmlspecialchars_decode($answer) . "<label for='{$que_id}_{$op}'>
                                <span></span>
                                                            <span class='check'></span>
                                                            <span class='box'></span></label></label></li>";
                        }
                        $op++;
                    }
                }
            }

            $html .= "</ul></div>";
            return $html;
            break;
        case 'dropdownlist':
            $placeholder_label_other = '';
            if (isset($list_lang_detail[$que_id . '_other_placeholder_label']) && $list_lang_detail[$que_id . '_other_placeholder_label']) {
                $placeholder_label_other = $list_lang_detail[$que_id . '_other_placeholder_label'];
            }
            $html = "<div class='option select-list two-col' id='{$que_id}_div'>"
                    . " <input type='hidden' name='placeholder_label_other_{$que_id}' value='{$placeholder_label_other}' />"
                    . "<ul><li><div class='styled-select'>";
            $html .= "<select name='{$que_id}[]' class='form-control required {$que_id}' onchange='addOtherField(this);showReset(this);'><option selected='' value=''>Select</option>";
            // if sorting
            if ($is_sort == 1) {
                foreach ($answers as $ans) {
                    foreach ($ans as $ans_id => $answer) {
                        $OtherAnswerType = '';
                        $OtherAnswerQuery = "Select answer_type FROM bc_survey_answers WHERE id='{$ans_id}'";
                        $OtherAnswerQueryData = $db->fetchByAssoc($db->query($OtherAnswerQuery));
                        $OtherAnswerType = $OtherAnswerQueryData['answer_type'];
                        if ($OtherAnswerType != 'other') {
                            $options[$ans_id] = $answer;
                        } else {
                            $optionsOther[$ans_id] = $answer;
                        }
                    }
                }
                asort($options);
                if (!empty($optionsOther)) {
                    $options = $options + $optionsOther;
                }
                foreach ($options as $ans_id => $answer) {
                    // Replace Piping string with _blank_
                    $fullstring = $answer;
                    $occu = substr_count($fullstring, "{{Q");
                    $piping_seq = array();
                    for ($i = 0; $i < $occu; $i++) {
                        $sub_part = explode('{{Q', $fullstring)[1];
                        $current_piping_seq = explode('}}', $sub_part)[0];
                        $piping_seq .= explode('}}', $sub_part)[0] . ' ';
                        $fullstring = str_replace('{{Q' . trim($current_piping_seq) . '}}', ' <span class="que_pipe_' . $current_piping_seq . '"> </span>', $fullstring);
                    }
                    $answer = $fullstring;
                    // check if answer is other type of or not
                    $is_other = '';
                    $oAnswer = BeanFactory::getBean('bc_survey_answers', $ans_id);
                    if ($oAnswer->answer_type == 'other') {
                        $is_other = 'is_other_option';
                    }
                    $html .= "<option value='{$ans_id}' class='{$is_other}'>" . htmlspecialchars_decode($answer) . "</option>";
                }
            }
            // if not sorting
            else {
                foreach ($answers as $ans) {
                    foreach ($ans as $ans_id => $answer) {
                        // Replace Piping string with _blank_
                        $fullstring = $answer;
                        $occu = substr_count($fullstring, "{{Q");
                        $piping_seq = array();
                        for ($i = 0; $i < $occu; $i++) {
                            $sub_part = explode('{{Q', $fullstring)[1];
                            $current_piping_seq = explode('}}', $sub_part)[0];
                            $piping_seq .= explode('}}', $sub_part)[0] . ' ';
                            $fullstring = str_replace('{{Q' . trim($current_piping_seq) . '}}', ' <span class="que_pipe_' . $current_piping_seq . '"> </span>', $fullstring);
                        }
                        $answer = $fullstring;
                        // check if answer is other type of or not
                        $is_other = '';
                        $oAnswer = BeanFactory::getBean('bc_survey_answers', $ans_id);
                        if ($oAnswer->answer_type == 'other') {
                            $is_other = 'is_other_option';
                        }
                        $html .= "<option value='{$ans_id}' class='{$is_other}'>" . htmlspecialchars_decode($answer) . "</option>";
                    }
                }
            }

            $html .= "</select></div></li></ul></div>";
            return $html;
            break;
        case 'textbox':
            $html = "<div class='option select-list two-col' id='{$que_id}_div'><ul><li>";
            $html .= "<input class='form-control {$que_id}' type='textbox' name='{$que_id}[]' class='{$que_id}'>";
            $html .= "</li></ul></div>";
            return $html;
            break;
        case 'commentbox':
            $html = "<div class='option select-list two-col' id='{$que_id}_div'><ul><li>";
            // rows & columns value given for comment box
            if (!empty($min) || !empty($max)) {
                $html .= "<textarea style='height:auto;width:auto;' class='form-control {$que_id}' rows='{$min}' cols='{$max}' name='{$que_id}[]'></textarea>";
            }
            //default commentbox
            else {
                $html .= "<textarea class='form-control {$que_id}' rows='4' cols='20' name='{$que_id}[]'></textarea>";
            }
            $html .= "</li></ul></div>";
            return $html;
            break;
        case 'rating':
            $html = "<div class='option select-list' id='{$que_id}_div'>";
            $html .= "<ul onMouseOut='resetRating(\"{$que_id}\")'>";
            // star count is given
            if (!empty($maxsize)) {
                $starCount = $maxsize;
            }
            //default 5 star
            else {
                $starCount = 5;
            }
            //generate star as per given star numbers
            for ($i = 1; $i <= $starCount; $i++) {
                $selected = "";
                $html .= "<li class='rating {$selected}' style='display: inline;font-size: x-large' onmouseover='highlightStar(this,\"{$que_id}\");' onclick='addRating(this,\"{$que_id}\");showReset(this);'>&#9733;</li>";
            }
            $html .= "</ul>";
            $html .= "</div>";
            $html .= "<input type='hidden'  name='{$que_id}[]' class='{$que_id}' id='{$que_id}_hidden'>";
            return $html;
            break;
        case 'contact-information':
            $placeholder_name = 'Name';
            if (!empty($list_lang_detail[$que_id . '_placeholder_label_Name'])) {
                $placeholder_name = $list_lang_detail[$que_id . '_placeholder_label_Name'];
            }
            $placeholder_email = 'Email Address';
            if (!empty($list_lang_detail[$que_id . '_placeholder_label_Email Address'])) {
                $placeholder_email = $list_lang_detail[$que_id . '_placeholder_label_Email Address'];
            }
            $placeholder_phone = 'Phone Number';
            if (!empty($list_lang_detail[$que_id . '_placeholder_label_Phone Number'])) {
                $placeholder_phone = $list_lang_detail[$que_id . '_placeholder_label_Phone Number'];
            }
            $placeholder_address = 'Street1';
            if (!empty($list_lang_detail[$que_id . '_placeholder_label_Address'])) {
                $placeholder_address = $list_lang_detail[$que_id . '_placeholder_label_Address'];
            }
            $placeholder_address2 = 'Street2';
            if (!empty($list_lang_detail[$que_id . '_placeholder_label_Address2'])) {
                $placeholder_address2 = $list_lang_detail[$que_id . '_placeholder_label_Address2'];
            }
            $placeholder_city = 'City/Town';
            if (!empty($list_lang_detail[$que_id . '_placeholder_label_City/Town'])) {
                $placeholder_city = $list_lang_detail[$que_id . '_placeholder_label_City/Town'];
            }
            $placeholder_state = 'State/Province';
            if (!empty($list_lang_detail[$que_id . '_placeholder_label_State/Province'])) {
                $placeholder_state = $list_lang_detail[$que_id . '_placeholder_label_State/Province'];
            }
            $placeholder_zip = 'ZIP/Postal Code';
            if (!empty($list_lang_detail[$que_id . '_placeholder_label_ZIP/Postal Code'])) {
                $placeholder_zip = $list_lang_detail[$que_id . '_placeholder_label_ZIP/Postal Code'];
            }
            $placeholder_country = 'Country';
            if (!empty($list_lang_detail[$que_id . '_placeholder_label_Country'])) {
                $placeholder_country = $list_lang_detail[$que_id . '_placeholder_label_Country'];
            }
            $placeholder_company = 'Company';
            if (!empty($list_lang_detail[$que_id . '_placeholder_label_Company'])) {
                $placeholder_company = $list_lang_detail[$que_id . '_placeholder_label_Company'];
            }


            // if is required is on and no any required fields selected then make name,email and phone as required fields 
            if ($is_required == 1 && empty($advancetype)) {

                $html = "<div class='option input-list two-col' id='{$que_id}_div'><ul>
                                <li><input placeholder='{$placeholder_name} *' class='form-control {$que_id}_name'  type='textbox' name='{$que_id}[{$que_id}][Name]'></li>
                                <li><input placeholder='{$placeholder_email} *'  class='form-control {$que_id}_email'  type='textbox' name='{$que_id}[{$que_id}][Email Address]'></li>
                                <li><input placeholder='{$placeholder_company}' class='form-control {$que_id}_company'  type='textbox' name='{$que_id}[{$que_id}][Company]'></li>
                                <li><input placeholder='{$placeholder_phone} *' class='form-control {$que_id}_phone'  type='textbox' name='{$que_id}[{$que_id}][Phone Number]'></li> 
                                <li><input placeholder='{$placeholder_address}' class='form-control {$que_id}_address'  type='textbox' name='{$que_id}[{$que_id}][Address]'></li>
                                <li><input placeholder='{$placeholder_address2}'class='form-control {$que_id}_address2'  type='textbox' name='{$que_id}[{$que_id}][Address2]'></li>
                                <li><input placeholder='{$placeholder_city}' class='form-control {$que_id}_city'  type='textbox' name='{$que_id}[{$que_id}][City/Town]'></li>
                                <li><input placeholder='{$placeholder_state}' class='form-control {$que_id}_state'  type='textbox' name='{$que_id}[{$que_id}][State/Province]'></li>
                                <li><input placeholder='{$placeholder_zip}' class='form-control {$que_id}_zip'  type='textbox' name='{$que_id}[{$que_id}][Zip/Postal Code]'></li>
                                <li><input placeholder='{$placeholder_country}' class='form-control {$que_id}_country'  type='textbox' name='{$que_id}[{$que_id}][Country]'></li>                                
                            </ul></div>";
            }
            // if is required is on and requred fields are given then make them require
            else if ($is_required == 1 && !empty($advancetype)) {
                $requireFields = explode(' ', $advancetype);
                $html = "<div class='option input-list two-col' id='{$que_id}_div'><ul>";
                if (in_array('Name', $requireFields)) {
                    $html .= "                <li><input placeholder='{$placeholder_name} *' class='form-control {$que_id}_name'  type='textbox' name='{$que_id}[{$que_id}][Name]'></li>";
                } else {
                    $html .= "                <li><input placeholder='{$placeholder_name} ' class='form-control {$que_id}_name'  type='textbox' name='{$que_id}[{$que_id}][Name]'></li>";
                }
                if (in_array('Email', $requireFields)) {
                    $html .= "                <li><input placeholder='{$placeholder_email} *'  class='form-control {$que_id}_email'  type='textbox' name='{$que_id}[{$que_id}][Email Address]'></li>";
                } else {
                    $html .= "                <li><input placeholder='{$placeholder_email} '  class='form-control {$que_id}_email'  type='textbox' name='{$que_id}[{$que_id}][Email Address]'></li>";
                }
                if (in_array('Company', $requireFields)) {
                    $html .= "                <li><input placeholder='{$placeholder_company} *' class='form-control {$que_id}_company'  type='textbox' name='{$que_id}[{$que_id}][Company]'></li>";
                } else {
                    $html .= "                <li><input placeholder='{$placeholder_company}' class='form-control {$que_id}_company'  type='textbox' name='{$que_id}[{$que_id}][Company]'></li>";
                }
                if (in_array('Phone', $requireFields)) {
                    $html .= "                <li><input placeholder='{$placeholder_phone} *' class='form-control {$que_id}_phone'  type='textbox' name='{$que_id}[{$que_id}][Phone Number]'></li> ";
                } else {
                    $html .= "                <li><input placeholder='{$placeholder_phone} ' class='form-control {$que_id}_phone'  type='textbox' name='{$que_id}[{$que_id}][Phone Number]'></li> ";
                }
                if (in_array('Address', $requireFields)) {
                    $html .= "                <li><input placeholder='{$placeholder_address} *' class='form-control {$que_id}_address'  type='textbox' name='{$que_id}[{$que_id}][Address]'></li>";
                } else {
                    $html .= "                <li><input placeholder='{$placeholder_address}' class='form-control {$que_id}_address'  type='textbox' name='{$que_id}[{$que_id}][Address]'></li>";
                }
                if (in_array('Address2', $requireFields)) {
                    $html .= "                <li><input placeholder='{$placeholder_address2} *'class='form-control {$que_id}_address2'  type='textbox' name='{$que_id}[{$que_id}][Address2]'></li>";
                } else {
                    $html .= "                <li><input placeholder='{$placeholder_address2}'class='form-control {$que_id}_address2'  type='textbox' name='{$que_id}[{$que_id}][Address2]'></li>";
                }
                if (in_array('City', $requireFields)) {
                    $html .= "                <li><input placeholder='{$placeholder_city} *' class='form-control {$que_id}_city'  type='textbox' name='{$que_id}[{$que_id}][City/Town]'></li>";
                } else {
                    $html .= "                <li><input placeholder='{$placeholder_city}' class='form-control {$que_id}_city'  type='textbox' name='{$que_id}[{$que_id}][City/Town]'></li>";
                }
                if (in_array('State', $requireFields)) {
                    $html .= "                <li><input placeholder='{$placeholder_state} *' class='form-control {$que_id}_state'  type='textbox' name='{$que_id}[{$que_id}][State/Province]'></li>";
                } else {
                    $html .= "                <li><input placeholder='{$placeholder_state}' class='form-control {$que_id}_state'  type='textbox' name='{$que_id}[{$que_id}][State/Province]'></li>";
                }
                if (in_array('Zip', $requireFields)) {
                    $html .= "                <li><input placeholder='{$placeholder_zip} *' class='form-control {$que_id}_zip'  type='textbox' name='{$que_id}[{$que_id}][Zip/Postal Code]'></li>";
                } else {
                    $html .= "                <li><input placeholder='{$placeholder_zip}' class='form-control {$que_id}_zip'  type='textbox' name='{$que_id}[{$que_id}][Zip/Postal Code]'></li>";
                }
                if (in_array('Country', $requireFields)) {
                    $html .= "                <li><input placeholder='{$placeholder_country} *' class='form-control {$que_id}_country'  type='textbox' name='{$que_id}[{$que_id}][Country]'></li>";
                } else {
                    $html .= "                <li><input placeholder='{$placeholder_country}' class='form-control {$que_id}_country'  type='textbox' name='{$que_id}[{$que_id}][Country]'></li>";
                }
                $html .= "            </ul></div>";
            }
            // otherwise no field is required
            else {
                $html = "<div class='option input-list two-col' id='{$que_id}_div'><ul>
                                <li><input placeholder='{$placeholder_name}' class='form-control {$que_id}_name'  type='textbox' name='{$que_id}[{$que_id}][Name]'></li>
                                <li><input placeholder='{$placeholder_email}'  class='form-control {$que_id}_email'  type='textbox'  name='{$que_id}[{$que_id}][Email Address]'></li>
                                <li><input placeholder='{$placeholder_company}' class='form-control {$que_id}_company'  type='textbox' name='{$que_id}[{$que_id}][Company]'></li>
                                <li><input placeholder='{$placeholder_phone}' class='form-control {$que_id}_phone'  type='textbox' name='{$que_id}[{$que_id}][Phone Number]'></li>                              
                                <li><input placeholder='{$placeholder_address}' class='form-control {$que_id}_address'  type='textbox' name='{$que_id}[{$que_id}][Address]'></li>
                                <li><input placeholder='{$placeholder_address2}' class='form-control {$que_id}_address2'  type='textbox'name='{$que_id}[{$que_id}][Address2]'></li>
                                <li><input placeholder='{$placeholder_city}' class='form-control {$que_id}_city'  type='textbox' name='{$que_id}[{$que_id}][City/Town]'></li>
                                <li><input placeholder='{$placeholder_state}' class='form-control {$que_id}_state'  type='textbox' name='{$que_id}[{$que_id}][State/Province]'></li>
                                <li><input placeholder='{$placeholder_zip}' class='form-control {$que_id}_zip'  type='textbox' name='{$que_id}[{$que_id}][Zip/Postal Code]'></li>
                                <li><input placeholder='{$placeholder_country}' class='form-control {$que_id}_country'  type='textbox' name='{$que_id}[{$que_id}][Country]'></li>                                                          
                                 </ul></div>";
            }
            return $html;
            break;
        case 'date-time':
            $html = "<div class='option select-list two-col' id='{$que_id}_div'><ul><li>";
            // if is date and time
            if ($is_datetime == 1) {
                //for allow future dates or not
                if ($allow_future_dates == 1) {
                    $html .= "<input class='form-control setdatetimeAllowfutureDate {$que_id}_datetime {$que_id}_setdatetimeAllowfutureDate' autocomplete='off' type='textbox' name='{$que_id}[]' class='{$que_id}'>";
                } else {
                    $html .= "<input class='form-control setdatetime {$que_id}_datetime {$que_id}_setdatetime' autocomplete='off' type='textbox' name='{$que_id}[]' class='{$que_id}'>";
                }
            }
            // only date
            else {
                //for allow future dates or not
                if ($allow_future_dates == 1) {
                    $html .= "<input class='form-control setdateAllowfutureDate {$que_id}_datetime {$que_id}_setdateAllowfutureDate' autocomplete='off' type='textbox' name='{$que_id}[]' class='{$que_id}'>";
                } else {
                    $html .= "<input class='form-control setdate {$que_id}_datetime {$que_id}_setdate' autocomplete='off' type='textbox' name='{$que_id}[]' class='{$que_id}'>";
                }
            }
            $html .= "</li></ul></div>";
            return $html;
            break;
        case 'image':
            $html = "<div class='option select-list' id='{$que_id}_div'><ul><li>";
            if ($que_title == "uploadImage") {
                $imgURL = $matrix_row;
            } else {
                $imgURL = $advancetype;
            }
            $html .= ""
                    . "<img src='{$imgURL}' class='  {$que_id}_datetime' alt='no-image'  name='{$que_id}[]' >";

            $html .= "</li></ul></div>";
            return $html;
            break;
        case 'video':
            $html = "<div class='option select-list' id='{$que_id}_div'><ul><li>";
            $html .= '<iframe width="420" height="315"
                                src="' . $advancetype . '">
                      </iframe>';
            if (!empty($description)) {
                $html .= "<p>" . $description . "</p>";
            }
            $html .= "</li></ul></div>";
            return $html;
            break;
        case 'scale':
            $lables = !empty($advancetype) ? explode('-', $advancetype) : '';
            $left = !empty($list_lang_detail[$que_id . '_display_label_left']) ? $list_lang_detail[$que_id . '_display_label_left'] : (!empty($lables) ? $lables[0] : '');
            $middle = !empty($list_lang_detail[$que_id . '_display_label_middle']) ? $list_lang_detail[$que_id . '_display_label_middle'] : (!empty($lables) ? $lables[1] : '');
            $right = !empty($list_lang_detail[$que_id . '_display_label_right']) ? $list_lang_detail[$que_id . '_display_label_right'] : (!empty($lables) ? $lables[2] : '');
            //display scale input field
            $html = "<div id='{$que_id}_div'>";
            $html .= '<div style="width:60%"> 
                        <span class="equal">' . $min . '</span> 
                        <span class="equal" ></span>
                        <span class="equal" style="text-align:right">' . $max . '</span>
                    </div>';
            $html .= '<br/><section style="width:60%;display:inline-block;" class=' . $que_id . ' onclick="showReset(this);"> 
                        <div id="slider"></div>
                    </section>';
            $html .= '<div style="width:60%;height:30px;"> 
                        <span class="equal">' . $left . '</span> 
                        <span class="equal" style="text-align:center">' . $middle . '</span>
                        <span class="equal" style="text-align:right">' . $right . '</span>
                    </div>';
            $html .= "</div>";
            return $html;
            break;
        case 'matrix':
            $display_type = $advancetype == 'checkbox' ? 'checkbox' : 'radio'; // display selection type for matrix
            $rows = array();
            $rows = json_decode($matrix_row);
            $cols = json_decode($matrix_col);

            // Initialize counter - count number of rows & columns
            $row_count = 1;
            $col_count = 1;
            // Do the loop
            foreach ($rows as $result) {
                // increment row counter
                $row_count++;
            }
            foreach ($cols as $result) {
                // increment  column counter
                $col_count++;
            }
            // adjusting div width as per column
            $width = 100 / ($col_count + 1);
            $margin_block = $width + 20 . '%';

            $html = '<div class="matrix-tbl-contner">';
            $html .= "<table class='survey_tmp_matrix' id='{$que_id}_div'>";
            $op = 0;
            for ($i = 1; $i <= $row_count; $i++) {

                $html .= '<tr class="row">';

                for ($j = 1; $j <= $col_count + 1; $j++) {
                    $row = $i - 1;
                    $col = $j - 1;
                    //First row & first column as blank
                    if ($j == 1 && $i == 1) {
                        $html .= "<th class='matrix-span' style='width:" . $width . "'>&nbsp;</th>";
                    }
                    // Rows Label
                    else if ($j == 1 && $i != 1) {
                        if (!empty($list_lang_detail[$que_id . '_matrix_row' . $row])) {
                            $row_header = $list_lang_detail[$que_id . '_matrix_row' . $row];
                        } else {
                            $row_header = $rows->$row;
                        }
                        $html .= "<th class='matrix-span' style='font-weight:bold; width:" . $width . ";text-align:left;'>" . $row_header . "</th>";
                    } else {
                        //Columns label
                        if ($j <= ($col_count + 1) && (isset($cols->$col) && $cols->$col != null) && !($j == 1 && $i == 1) && ($i == 1 || $j == 1)) {
                            if (!empty($list_lang_detail[$que_id . '_matrix_col' . $col])) {
                                $col_header = $list_lang_detail[$que_id . '_matrix_col' . $col];
                            } else {
                                $col_header = $cols->$col;
                            }
                            $html .= "<th class='matrix-span' style='font-weight:bold; width:" . $width . "'>" . $col_header . "</th>";
                            $col_details[$j] = $col_header;
                        }
                        //Display answer input (RadioButton or Checkbox)
                        else if ($j != 1 && $i != 1 && (isset($cols->$col) && $cols->$col != null)) {
                            $html .= "<td class='matrix-span' style='width:" . $width . "; '>"
                                    . "<span class='md-" . $display_type . "' style='margin-left:" . $margin_block . "'><input type='" . $display_type . "'  id='{$que_id}_{$op}' class='{$que_id} md-check' name='matrix" . $row . "' onclick='showReset(this);'/><label for='{$que_id}_{$op}'>
                                                            <span></span>
                                                            <span class='check'></span>
                                                            <span class='box'></span>";
                            $html .= "<span class='mobile_only'> " . $col_details[$j] . "</span>";
                            $html .= "</label></span></td>";
                        }
                        // If no value then display none
                        else {
                            $html .= "";
                        }
                    }
                    $op++;
                }
                $html .= "</tr>";
            }
            $html .= "</table></div>";
            return $html;
            break;
        case 'doc-attachment':
            $html = "<div class='option select-list two-col' id='{$que_id}_div'><ul><li>";
            $html .= "<div class='doc-attachment-btn'><span style='cursor:pointer;'>Choose File</span><input class='form-control upload {$que_id}' type='file' name='{$que_id}[]' class='{$que_id}'></div>";
            $html .= "</li></ul></div>";
            return $html;
            break;
        case 'richtextareabox':
            $html = "<div class='option select-list' id='{$que_id}_div'><ul><li style='cursor: default;'>";
            $richtextContent = html_entity_decode($richtextContent);
            $html .= "<div class='richContect'>{$richtextContent}</div>";
            $html .= "</li></ul></div>";
            return $html;
            break;
        case 'netpromoterscore':
            $lables = !empty($advancetype) ? explode('-', $advancetype) : '';
            $left = !empty($list_lang_detail[$que_id . '_display_label_left']) ? $list_lang_detail[$que_id . '_display_label_left'] : (!empty($lables) ? $lables[0] : '');
            $right = !empty($list_lang_detail[$que_id . '_display_label_right']) ? $list_lang_detail[$que_id . '_display_label_right'] : (!empty($lables) ? $lables[1] : '');
            if (empty($min) || empty($max)) {
                $min = 0;
                $max = 10;
            }
            //display scale input field
            $html .= "<div id='{$que_id}_div'>";
            $supported_survey_languageQuery = "SELECT supported_survey_language FROM bc_survey WHERE id='{$survey_id}'";
            $supported_survey_languageData = $db->fetchByAssoc($db->query($supported_survey_languageQuery));
            $supported_survey_language = $supported_survey_languageData['supported_survey_language'];
            
            $html .= "<div class='score_pannel_wrapper' id='score_pannel_{$que_id}'>
                        <table class='nps_submission_table' >
                        <tr>";
            
            foreach ($answers as $ansData => $ans) {
                foreach ($ans as $ans_id => $answer) {
                    if ($answer < 7) {
                        $html .= "<th><div onclick='applyNPSSelectedColor(this); showReset(this);' class='score_pannel' id='$ans_id' value='$answer' style='background-color:#ff5353'>" . $answer . "</div></th>";
                    } else if ($answer >= 7 && $answer < 9) {
                        $html .= "<th><div class='score_pannel' onclick='applyNPSSelectedColor(this); showReset(this);' id='$ans_id' value='$answer'style='background-color:#e9e817'>" . $answer . "</div></th>";
                    } else if ($answer >= 9 && $answer <= 10) {
                        $html .= "<th><div  class='score_pannel' onclick='applyNPSSelectedColor(this); showReset(this);' id='$ans_id' value='$answer' style='background-color:#92d51a'>" . $answer . "</div></th>";
                    }
                }
            }
            $html .= "</tr>
                        </table>";
            $html .= '<div class="score_pannel_result"> 
                        <span class="equal" style="word-break:break-word;">' . $left . '</span> 
                        <span class="equal" style="text-align:right;word-break:break-word;">' . $right . '</span>
                    </div></div>';
            $html .= "</div>";
            return $html;
            break;
        case 'emojis':
            //display scale input field
            $html .= "<div id='{$que_id}_div'>";
            $html .= "<div class='emojis_class' id='emojis_{$que_id}'>";
            $op = 1;
            $emojisImges = array(
                1 => "custom/include/images/ext-unsatisfy.png",
                2 => "custom/include/images/unsatisfy.png",
                3 => "custom/include/images/nuteral.png",
                4 => "custom/include/images/satisfy.png",
                5 => "custom/include/images/ext-satisfy.png",
            );
            $emojisImgesGrey = array(
                1 => "custom/include/images/ext-unsatisfy-grey.png",
                2 => "custom/include/images/unsatisfy-grey.png",
                3 => "custom/include/images/nuteral-grey.png",
                4 => "custom/include/images/satisfy-grey.png",
                5 => "custom/include/images/ext-satisfy-grey.png",
            );
            $html .= '<ul>';
            foreach ($answers as $ans) {
                foreach ($ans as $ans_id => $answer) {
                    // Replace Piping string with _blank_
                    $fullstring = $answer;
                    $occu = substr_count($fullstring, "{{Q");
                    $piping_seq = array();
                    for ($i = 0; $i < $occu; $i++) {
                        $sub_part = explode('{{Q', $fullstring)[1];
                        $current_piping_seq = explode('}}', $sub_part)[0];
                        $piping_seq .= explode('}}', $sub_part)[0] . ' ';
                        $fullstring = str_replace('{{Q' . trim($current_piping_seq) . '}}', ' <span class="que_pipe_' . $current_piping_seq . '"> </span>', $fullstring);
                    }
                    $answer = $fullstring;
                    $html .= "<div  class='md-emojis'  onclick='switchEmojis(this,\"{$op}\",\"{$que_id}\");showReset(this);'><li class='md-radio' style='display:inline;'><label>
                                 <img class='Grey_Emoji' id='Grey_emojis_" . $op . "' src='{$emojisImgesGrey[$op]}' height='40' width='40' style='display:inline-block;' value='Grey_emojis_" . $op . ".png_{$que_id}'>
                                    <img class='Emoji' id='emojis_" . $op . "' src='{$emojisImges[$op]}' height='40' width='40' style='display:none;' value='emojis_" . $op . ".png_{$que_id}' );'>
                                        <input type='radio' id='{$que_id}_{$op}' value='{$ans_id}' name='{$que_id}[]' class='{$que_id} md-radiobtn ' >
                                            <div class='emoji_text'>" . htmlspecialchars_decode($answer) . "</div>
                           <label for='{$que_id}_{$op}'>
                                <span></span>
                                <span style='display:none;' class='check'></span>
                                <span style='display:none;' class='box'></span></label></label></li>
                            </div>";
                    $op++;
                }
            }
            $html .= "</ul></div></div>";
            return $html;
            break;
    }
}

if (isset($_REQUEST['btnsend'])) {
    if (!empty($survey->survey_thanks_page) && $survey->survey_thanks_page != '&lt;p&gt;&lt;br data-mce-bogus=&quot;1&quot;&gt;&lt;/p&gt;' && $survey->survey_thanks_page != '&lt;p&gt;&amp;nbsp;&lt;br&gt;&lt;/p&gt;') {
        $msg .= '<ul class="bxslider"><div class="container">
                            <div class="survey-form form-desc">';
        $msg .= '     <div class="form-body thanks-page" style="margin-top:20px; margin-bottom:20px;">' . html_entity_decode_utf8($survey->survey_thanks_page) . '</div>';

        $msg .= '   </div>
                          </div></ul>';
        $msg .= '<div class="action-block">
                      <div style="display: inline-block;float: right;"> <input class="bx-prev button showBtn" type="button" value="Prev" name="btnprev" id="btnprev">
                </div>';
        if ($survey->footer_content != "") {
            $msg .= '<div class="survey-footer">';
            $msg .= '      <center>' . html_entity_decode($survey->footer_content) . '</center>';
            $msg .= '</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>   
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo $favicon; ?>" type="image/x-icon">
        <?php if ($survey->survey_type == 'poll') { ?>
            <title>Poll</title>
        <?php } else { ?>
            <title>Survey</title>
        <?php } ?>
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
        <!--<script src="custom/include/js/survey_js/jquery.datetimepicker.js"></script>-->
        <script src="custom/include/js/survey_js/daterangepicker.js"></script>

        <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />
        <!--<link rel="stylesheet" type="text/css" href="custom/include/css/survey_css/jquery.datetimepicker.css">-->
        <link rel="stylesheet" type="text/css" href="custom/include/css/survey_css/daterangepicker.css">

        <link href="<?php echo $dotb_config['site_url'] . '/custom/include/css/survey_css/survey-form.css' ?>" rel="stylesheet">
        <link href="<?php echo $dotb_config['site_url'] . '/custom/include/css/survey_css/jquery.bxslider.css' ?>" rel="stylesheet">
        <link href="<?php echo $dotb_config['site_url'] . '/custom/include/css/survey_css/custom-form.css' ?>" rel="stylesheet">
        <?php
        if (!empty($survey->survey_background_image)) {
            $sql = "SELECT background_image_lb FROM bc_survey WHERE id='{$survey->id}'";

            // the result of the query
            $result = $db->query($sql);

            // set the header for the image
            while ($row = $db->fetchRow($result)) {
                $base64BG = base64_encode($row['background_image_lb']);
            }
        }

        if (isset($_REQUEST['selected-theme'])) {
            $theme = $_REQUEST['selected-theme'];
        } else {
            $theme = $survey->survey_theme;
        }

        if ($survey->survey_theme == 'theme0' || $theme == 'theme0') {
            ?>

            <link href="<?php echo $dotb_config['site_url'] . '/themes/default/less/dotb.less'; ?>" rel="stylesheet">
            <link href="<?php echo $dotb_config['site_url'] . '/styleguide/assets/css/bootstrap.css'; ?>" rel="stylesheet">
            <link href="<?php echo $dotb_config['site_url'] . '/themes/Dotb/css/style.css'; ?>" rel="stylesheet">
            <link href="<?php echo $dotb_config['site_url'] . '/themes/default/css/bootstrap.css'; ?>" rel="stylesheet">
            <link href="<?php echo $dotb_config['site_url'] . '/styleguide/less/dotb-specific/print.less'; ?>" rel="stylesheet"> 
            <link href="<?php echo $dotb_config['site_url'] . '/themes/default/css/bootstrap.css'; ?>" rel="stylesheet">
        <?php } ?>
        <link href="<?php echo $dotb_config['site_url'] . '/custom/include/css/survey_css/' . $theme . '.css'; ?>" rel="stylesheet">

        <script src="<?php echo $dotb_config['site_url'] . '/custom/include/js/survey_js/jquery.bxslider.min.js' ?>"></script>
        <script src="<?php echo $dotb_config['site_url'] . '/custom/include/js/survey_js/rate.js' ?>"></script>
        <script src="<?php echo $dotb_config['site_url'] . '/custom/include/js/survey_js/custom_code.js' ?>"></script>
        <style type="text/css">
            .hideBtn{
                visibility:hidden;
            }
            .showBtn{
                visibility:visible;
            }
        </style>

        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery('#<?php echo $theme; ?>').find('.recentlinks').addClass('selected-theme-survey');
                /*  BugFix :: Words cut off in survey form :: Resolved : START */
                setTimeout(function () {
                    $(".bx-viewport").css("height", $('.active-slide').css('height'));
                }, 1000);
                /*  BugFix :: Words cut off in survey form :: Resolved : END */

                // set background image
<?php if (!empty($base64BG)) { ?>
                    $('.bg').css('background', 'url("data:image/png;base64,<?php echo $base64BG; ?>")');
<?php } else { ?>
                    $('.bg').css('filter', 'blur(5px)');
<?php } ?>
<?php if ($theme != 'theme0') { ?>
                    $('link[rel=stylesheet][href~="<?php echo $dotb_config['site_url'] . '/themes/default/less/dotb.less'; ?>"]').remove();
                    $('link[rel=stylesheet][href~="<?php echo $dotb_config['site_url'] . '/styleguide/assets/css/bootstrap.css'; ?>"]').remove();
                    $('link[rel=stylesheet][href~="<?php echo $dotb_config['site_url'] . '/themes/Dotb/css/style.css'; ?>"]').remove();
                    $('link[rel=stylesheet][href~="<?php echo $dotb_config['site_url'] . '/themes/default/css/bootstrap.css'; ?>"]').remove();
                    $('link[rel=stylesheet][href~="<?php echo $dotb_config['site_url'] . '/styleguide/less/dotb-specific/print.less'; ?>"]').remove();
                    $('link[rel=stylesheet][href~="<?php echo $dotb_config['site_url'] . '/themes/default/css/bootstrap.css'; ?>"]').remove();
<?php } ?>
                $('#overlay').fadeOut();
                var maxWidth = 0;
                $('.ew-ul li').width('auto').each(function () {
                    maxWidth = $(this).width() > maxWidth ? $(this).width() : maxWidth;
                }).width(maxWidth);
                //initially active first page
                $('.progress-bar').children('li:nth-child(1)').addClass('active');
                // ajax call for getting survey detail
                var survey_detail = Array();
                var min, max, maxsize, precision, scale_slot = 0;
                $.ajax({
                    url: "index.php?entryPoint=preview_survey",
                    type: "POST",
                    data: {'method': 'get_survey', 'record_id': '<?php echo $survey_id; ?>', 'cid': ''},
                    success: function (result) {

                        if (result)
                        {
                            result = JSON.parse(result);
                            survey_detail = result['survey_details'];
                            var lang_detail = result['lang_survey_details'];
                            var slider_detail = new Object();
                            var not_allowed_future_date_detail = new Object();
                            $.each(survey_detail, function (pindex, page_data) {
                                $.each(page_data, function (qindex, que_data) {
                                    if (qindex == 'page_questions') {
                                        $.each(que_data, function (qi, q_data) {
                                            if (q_data['que_type'] == 'scale')
                                            {
                                                var detail = new Object();
                                                // if min-max-slot value is not set then set default value
                                                if (!q_data['min'] || !q_data['max']) {
                                                    detail['min'] = 0;
                                                    detail['max'] = 10;
                                                    detail['scale_slot'] = 1;
                                                } else {
                                                    detail['min'] = q_data['min'];
                                                    detail['max'] = q_data['max'];
                                                    detail['scale_slot'] = q_data['scale_slot'];
                                                }
                                                slider_detail[q_data['que_id']] = detail;
                                            } else if (q_data['que_type'] == 'date-time')
                                            {
                                                if (q_data['allow_future_dates'] == 'No')
                                                    not_allowed_future_date_detail[q_data['que_id']] = q_data['que_id'];
                                            }
                                        });
                                    }
                                });
                            });
                            $.each(survey_detail, function (pindex, page_data) {
                                $.each(page_data['page_questions'], function (qindex, que_data) {
                                    var todayDate = "";

                                    if (que_data['que_type'] == 'date-time') {
                                        if (que_data['max'] != "" || que_data['min'] != "") {
                                            if (que_data['max'] != "") {
                                                var todayDate = que_data['max'];
                                                var maxYear = que_data['max'].split('/')['2'];
                                            } else {
                                                var todayDate = new Date();
                                                var maxYear = todayDate.getFullYear();
                                                todayDate = (todayDate.getMonth() + 1) + "/" + todayDate.getDate() + "/" + todayDate.getFullYear();
                                            }

                                            if (que_data['min'] != "") {
                                                var minDate = que_data['min'];
                                                var minYear = que_data['max'].split('/')['2'];
                                            } else {
                                                var minDate = "";
                                                var mDate = new Date();
                                                var minYear = mDate.getFullYear();
                                            }
                                        } else {
                                            var todayDate = new Date();
                                            todayDate = (todayDate.getMonth() + 1) + "/" + todayDate.getDate() + "/" + todayDate.getFullYear();
                                        }
                                        //set datetime picker for datetime question type
                                        $('.setdatetime.' + que_data['que_id'] + '_datetime').click(function (el) {
                                        }).daterangepicker({
                                            singleDatePicker: true,
                                            timePicker: true,
                                            showDropdowns: true,
                                            autoUpdateInput: false,
                                            maxDate: todayDate,
                                            minDate: minDate,
                                            timePicker24Hour: true,
                                            minYear: minYear,
                                            maxYear: maxYear,
                                        });
                                        $('.setdatetime.' + que_data['que_id'] + '_datetime').on('apply.daterangepicker', function (ev, picker) {
                                            $(this).val(picker.startDate.format('YYYY/MM/DD hh:mm'));
                                        });
                                        $('.setdatetime.' + que_data['que_id'] + '_datetime').on('cancel.daterangepicker', function (ev, picker) {
                                            $(this).val('');
                                        });
                                        //set datetime picker for datetime and allow future date question type
                                        $('.setdatetimeAllowfutureDate.' + que_data['que_id'] + '_datetime').click(function (el) {
                                        }).daterangepicker({
                                            singleDatePicker: true,
                                            timePicker: true,
                                            showDropdowns: true,
                                            autoUpdateInput: false,
                                            maxDate: "",
                                            minDate: minDate,
                                            timePicker24Hour: true,
                                            minYear: minYear,
                                            maxYear: maxYear,
                                        });
                                        $('.setdatetimeAllowfutureDate.' + que_data['que_id'] + '_datetime').on('apply.daterangepicker', function (ev, picker) {
                                            $(this).val(picker.startDate.format('YYYY/MM/DD hh:mm'));
                                        });
                                        $('.setdatetimeAllowfutureDate.' + que_data['que_id'] + '_datetime').on('cancel.daterangepicker', function (ev, picker) {
                                            $(this).val('');
                                        });
                                        //set date picker for date question type
                                        $('.setdate.' + que_data['que_id'] + '_datetime').click(function (el) {
                                        }).daterangepicker({
                                            singleDatePicker: true,
                                            showDropdowns: true,
                                            autoUpdateInput: false,
                                            maxDate: todayDate,
                                            minDate: minDate,
                                            timePicker24Hour: true,
                                            minYear: minYear,
                                            maxYear: maxYear,
                                        });
                                        $('.setdate.' + que_data['que_id'] + '_datetime').on('apply.daterangepicker', function (ev, picker) {
                                            $(this).val(picker.startDate.format('YYYY/MM/DD'));
                                        });
                                        $('.setdate.' + que_data['que_id'] + '_datetime').on('cancel.daterangepicker', function (ev, picker) {
                                            $(this).val('');
                                        });
                                        //set date picker for date and allow future date question type
                                        $('.setdateAllowfutureDate.' + que_data['que_id'] + '_datetime').click(function (el) {
                                        }).daterangepicker({
                                            singleDatePicker: true,
                                            showDropdowns: true,
                                            autoUpdateInput: false,
                                            maxDate: "",
                                            minDate: minDate,
                                            timePicker24Hour: true,
                                            minYear: minYear,
                                            maxYear: maxYear,
                                        });
                                        $('.setdateAllowfutureDate.' + que_data['que_id'] + '_datetime').on('apply.daterangepicker', function (ev, picker) {
                                            $(this).val(picker.startDate.format('YYYY/MM/DD'));
                                        });
                                        $('.setdateAllowfutureDate.' + que_data['que_id'] + '_datetime').on('cancel.daterangepicker', function (ev, picker) {
                                            $(this).val('');
                                        });
                                    }
                                });
                            }
                            );

                            //bind next prev button click function
                            $(".bx-next").click(function () {

                                var currentSlidePage = slider.getCurrentSlide() + 1;
                                var totalPageCount = slider.getSlideCount();
                                if (currentSlidePage == totalPageCount - 1) {
                                    $(this).removeClass('showBtn').addClass('hideBtn');
                                } else {
                                    $("#btnprev").removeClass('hideBtn').addClass('showBtn');
                                }
                                slider.goToNextSlide();
                                $('html, body').animate({scrollTop: 0}, 800);
                                if ($(this).hasClass('hideBtn')) {
                                    $("#btnsend").show();
                                    $("#btnprev").removeClass('hideBtn').addClass('showBtn');
                                }

                            });
                            $(".bx-prev").click(function () {
                                $('#btnnext').show();
                                $('.validation-tooltip').fadeOut();
                                var currentSlidePage = slider.getCurrentSlide();
                                if (currentSlidePage == 1) {
                                    $(this).removeClass('showBtn').addClass('hideBtn');
                                    $("#btnnext").removeClass('hideBtn').addClass('showBtn');
                                } else {
                                    $("#btnnext").removeClass('hideBtn').addClass('showBtn');
                                }
                                slider.goToPrevSlide();
                                $('html, body').animate({scrollTop: 0}, 800);
                                $("#btnsend").hide();
                            });
                            //setting slider
                            $(function () {
                                var que_id = '';
                                $.each(slider_detail, function (qid, slider_data) {
                                    var answer = parseInt(slider_data.answer) ? parseInt(slider_data.answer) : '';
                                    // scale slider
                                    var slider = $('.' + qid).find("#slider").slider({
                                        slide: function (event, ui) {
                                            $(ui.handle).find('.tooltip-score').html('<div>' + ui.value + '</div>');
                                            showReset($(ui.handle));
                                        },
                                        range: "min",
                                        value: answer,
                                        min: parseInt(slider_data.min),
                                        max: parseInt(slider_data.max),
                                        step: parseInt(slider_data.scale_slot),
                                        create: function (event, ui) {
                                            var tooltip = $('<div class="tooltip-score" >' + answer + '</div>');
                                            $(event.target).find('.ui-slider-handle').append(tooltip);
                                            $(event.target).find('.ui-slider-handle').css("left", "0%");
                                            $(event.target).find('.ui-slider-range').css("width", "0%");
                                        },
                                        change: function (event, ui) {
                                            $('#hidden').attr('value', ui.value);
                                            showReset($(ui.handle));
                                        }
                                    });
                                });
                            });
                        }
                    }
                });
                var slider = jQuery('.bxslider').bxSlider({
                    touchEnabled: false,
                    adaptiveHeight: true,
                    infiniteLoop: false,
                    hideControlOnEnd: true,
                    mode: 'fade',
                    pager: true,
                    controls: false,
                    nextSelector: '#btnnext',
                    prevSelector: '#btnprev',
                    onSliderLoad: function (currentIndex) {
                        $('.bx-viewport').find('.bxslider').children().eq(currentIndex).addClass('active-slide');
                        //hide propgress bar at welcomepage
                        if ($('.active-slide').find('.welcome-form').length != 0)
                        {
                            //    $('.progress-bar').hide();
                            $('.form-desc').hide();
                            $('.agreement_section').hide();
                        } else {
                            //    $('.progress-bar').show();
                            $('.form-desc').show();
                        }
                    },
                    onSlideBefore: function ($slideElement) {

                        $('#btnnext').show();
                        $('.bx-viewport').find('.bxslider').children().removeClass('active-slide');
                        $slideElement.addClass('active-slide');
                        var total_pages = parseInt($('.page-no').length);
                        var page_no = parseInt($('.active-slide').find('.page-no > i').html());
                        if (!page_no) {
                            $('.progress-bar').hide();
                            $('.btn-submit').hide();
                            $('#btnnext').attr('value', 'Next');
                        } else if (total_pages == page_no && $('.thanks-page').length != 0)
                        {
                            if ($('#submit_button_label').length != 0 && $('#submit_button_label').val())
                            {
                                $('#btnnext').attr('value', $('#submit_button_label').val());
                            } else {
                                $('#btnnext').attr('value', 'End Survey');
                            }
                        } else if ($('.thanks-page').length != 0) {
                            if ($('#next_button_label').length != 0 && $('#next_button_label').val())
                            {
                                $('#btnnext').attr('value', $('#next_button_label').val());
                            } else {
                                $('#btnnext').attr('value', 'Next');
                            }
                        } else if (total_pages == page_no && $('.thanks-page').length == 0) {
                            $('#btnnext').hide();
                        }
                        page_no = page_no - 1;
                        var progress_percentage = Math.floor((page_no * 100) / total_pages);
                        // page progress bar
                        for (var i = 1; i <= total_pages; i++) {
                            if (i < page_no)
                            {
                                $('.progress-bar').children('li:nth-child(' + i + ')').addClass('completed');
                                $('.progress-bar').children('li:nth-child(' + i + ')').removeClass('active');
                            } else if (i == page_no) {
                                $('.progress-bar').children('li:nth-child(' + i + ')').addClass('active');
                                $('.progress-bar').children('li:nth-child(' + i + ')').removeClass('completed');
                            } else {
                                $('.progress-bar').children('li:nth-child(' + i + ')').removeClass('completed');
                                $('.progress-bar').children('li:nth-child(' + i + ')').removeClass('active');
                            }
                        }


                        var progress = $("#progress").slider({
                            range: "min",
                            value: progress_percentage,
                            disabled: true,
                        });
                        //add extra div for designing
                        $('#progress').find('.tooltip-score').html('<div>' + progress_percentage + '<div>');
                        $('#pagecount').html(page_no + "/" + total_pages);
                        $('#progress-percentage').html(progress_percentage + "%");
                        //hide propgress bar at welcomepage
                        if ($('.active-slide').find('.welcome-form').length != 0)
                        {
                            // $('.progress-bar').hide();
                            $('.form-desc').hide();
                            $('.agreement_section').hide();
                        } else {
                            //   $('.progress-bar').show();
                            $('.form-desc').show();
                            $('.agreement_section').hide();
                        }
                        if ($('.active-slide').find('.welcome-form').length == 0 && isNaN(page_no)) {
                            $('#btnnext').hide();
                            $('.agreement_section').hide();
                        }
                    },
                    onSlideAfter: function () {

                        var currentSlidePage = slider.getCurrentSlide() + 1;
                        var totalPageCount = slider.getSlideCount();
                        if (currentSlidePage == 1) {
                            $("#btnprev").removeClass('showBtn').addClass('hideBtn');
                            $('#btnnext').removeClass('hideBtn').addClass('showBtn');
                            $("#btnsend").hide();
                        } else if (currentSlidePage == totalPageCount) {
                            $("#btnsend").show();
                            $("#btnprev").removeClass('hideBtn').addClass('showBtn');
                            $('#btnnext').removeClass('showBtn').addClass('hideBtn');
                        } else {
                            $("#btnprev").removeClass('hideBtn').addClass('showBtn');
                            $('#btnnext').removeClass('hideBtn').addClass('showBtn');
                            $("#btnsend").hide();
                        }

                        if ($('.thanks-page').length != 0 && currentSlidePage == (totalPageCount - 1)) {
                            $('.agreement_section').show();
                        } else if ($('.thanks-page').length == 0 && currentSlidePage == totalPageCount) {
                            $('.agreement_section').show();
                        } else {
                            $('.agreement_section').hide();
                        }
                    },
                });
                var total_pages = parseInt($('.page-no').length);
                var page_no = 0;
                var progress_percentage = Math.floor((page_no * 100) / total_pages);
                //page progress bar
                var progress = $("#progress").slider({
                    range: "min",
                    value: progress_percentage,
                    disabled: true,
                    create: function (event, ui) {

                        var tooltip = $('<div></div><div class="tooltip-score"><div>' + progress_percentage + '<div></div>');
                        $(event.target).find('.ui-slider-handle').append(tooltip);
                    },
                });
                $('#pagecount').html(page_no + "/" + total_pages);
                $('#progress-percentage').html(progress_percentage + "%");
                $('.setdatetime').keypress(function (e) {
                    //if the letter is  digit then display error and don't type anything
                    if (e.which != 8 && e.which != 0 && (e.which > 48 || e.which < 57)) {

                        return false;
                    }
                });
                $('.setdatetimeAllowfutureDate').keypress(function (e) {
                    //if the letter is  digit then display error and don't type anything
                    if (e.which != 8 && e.which != 0 && (e.which > 48 || e.which < 57)) {

                        return false;
                    }
                });
                $('.setdate').keypress(function (e) {
                    //if the letter is  digit then display error and don't type anything
                    if (e.which != 8 && e.which != 0 && (e.which > 48 || e.which < 57)) {

                        return false;
                    }
                });
                $('.setdateAllowfutureDate').keypress(function (e) {
                    //if the letter is  digit then display error and don't type anything
                    if (e.which != 8 && e.which != 0 && (e.which > 48 || e.which < 57)) {

                        return false;
                    }
                });
                $('#selected_lang').change(function () {
                    // change survey language
                    if (confirm('Are you sure want to change survey language ?'))
                    {
                        $('#selectedLanguage').val($('#selected_lang option:selected').val());
                        var url = window.location.href;
                        url = window.location.href.split('&selected_lang=');
                        $('#survey_theme').val('<?php echo $theme; ?>');
                        window.location.assign(url[0] + '&selected_lang=' + $('#selected_lang').val() + '&selected-theme=' + $('#survey_theme').val());
                    } else {
                        var previousSelected = $("#selectedLanguage").val();
                        $('#selected_lang').val(previousSelected);
                    }
                });
                if ($('#text_direction').val() == 'right_to_left')
                {
                    $.each($('.form-body').find('input[type=text]'), function () {
                        $(this).css('direction', 'RTL');
                    });
                }

            });
            function applyNPSSelectedColor(el) {
                var selected_id = $(el).attr('id');
//                    var split_selected_id = selected_id.split("_");
                var question_id = $('#' + selected_id).parent().parent().parent().parent().parent().parent().attr('id');
                var split_que_id = question_id.split("_");
                var selected_value = $('#' + selected_id).attr('value');
                var previous_nps_selected_id_hidden = $('#hidden_selected_values_id_' + split_que_id[0]).val();
                var selected_nps_value_hidden = $('#hidden_selected_values_' + split_que_id[0]).val();
                $("#hidden_selected_values_id_" + split_que_id[0]).remove();
                $("#hidden_selected_values_" + split_que_id[0]).remove();
                $('#score_pannel_' + split_que_id[0]).append('<input type="hidden" class="nps_hidden_selected_values_id" value="' + selected_id + '" id="hidden_selected_values_id_' + split_que_id[0] + '"/>')
                $('#score_pannel_' + split_que_id[0]).append('<input type="hidden" class="nps_hidden_selected_values" value="' + selected_value + '" id="hidden_selected_values_' + split_que_id[0] + '"/>')

                if (selected_id != previous_nps_selected_id_hidden && selected_value != selected_nps_value_hidden) {
                    $('#' + selected_id).css('background-color', '#a1cbff');
                    if (selected_nps_value_hidden < 7) {
                        $('#' + previous_nps_selected_id_hidden).css('background-color', '#ff5353');
                    } else if (selected_nps_value_hidden >= 7 && selected_nps_value_hidden <= 8) {
                        $('#' + previous_nps_selected_id_hidden).css('background-color', '#e9e817');
                    } else if (selected_nps_value_hidden > 8 && selected_nps_value_hidden <= 10) {
                        $('#' + previous_nps_selected_id_hidden).css('background-color', '#92d51a');
                    }
                    $('#previous_nps_selected_id_hidden_' + split_que_id[0]).val(selected_id);
                }
                $('#' + selected_id).css('background-color', '#a1cbff');
            }

            function switchEmojis(el, op, queID) {
                var id = $(el).find('.Grey_Emoji').attr('id')
                $(el).parents('.emojis_class').find('.Emoji').hide();
                $(el).parents('.emojis_class').find('.Grey_Emoji').show();
                $(el).parents('.emojis_class').find('input[type=radio]').removeAttr('checked');
                if (id == 'Grey_emojis_' + op) {
                    $(el).find('#' + queID + '_' + op).prop('checked', 'true');
                    $(el).find('#emojis_' + op).show();
                    $(el).find('#Grey_emojis_' + op).hide();
                } else {
                    $(el).find('#Grey_emojis_' + op).show();
                    $(el).find('#emojis_' + op).hide();
                }
            }
            function addOtherField(el) {
                var que_id = $(el).parents('.form-body').find('.questionHiddenField').val();
                var placeholder_label = $('[name=placeholder_label_other_' + que_id + ']').val();
                if (!placeholder_label)
                {
                    placeholder_label = 'Other';
                }

                var isOtherSelected = false;
                // Radio type of answer
                if (el.type == 'radio')
                {
                    var value_selected = $(el).attr('class');
                }
                // Dropdown type of answer
                else if (el.type == 'select-one')
                {
                    var value_selected = $('[value=' + $(el).val() + ']').attr('class');
                }
                // Multi select list 
                else if (el.type == 'select-multiple') {
                    var selected_ans_ids = $(el).val();
                    var value_selected = '';
                    $.each(selected_ans_ids, function (id)
                    {
                        value_selected += $('[value=' + $(el).val() + ']').attr('class');
                    });
                }
                // other than check box type than get value from array of selected values
                if (el.type != 'checkbox' && value_selected.includes('is_other_option'))
                {
                    isOtherSelected = true;
                }
                // if check box then retrieve value from all selected values by class id
                else if (el.type == 'checkbox')
                {
                    value_selected = el.classList[0];
                    var sel_array = new Array();
                    $.each($('.' + value_selected + ':checked'), function () {
                        if (this.className.includes('is_other_option'))
                        {
                            isOtherSelected = true;
                        }
                    });
                }
                // if othet input field not exists and other option selected then show it
                if (isOtherSelected && $(el).parents('.option').find('.other_option_input').length == 0)
                {
                    if (el.type == 'select-one' && $('#survey_theme').val() == 'theme0')
                    {
                        var add = 'style="width:55%;margin-top:10px;margin-left:20px;';
                    } else if (el.type == 'select-one')
                    {
                        var add = 'style="width:55%;margin-top:10px;';
                    } else if (el.type == 'select-multiple') {
                        var add = 'style="margin-top:20px;width:55%;';
                    } else {
                        var add = 'style="margin-top:10px;width:55%;';
                    }
                    if ($('#survey_theme').val() == 'theme0')
                    {
                        add += 'margin-top:10px;width:55%;margin-left:20px;';
                    }
                    add += '"';
                    $(el).parents('.option').append("<input " + add + " class='form-control other_option_input' type='textbox' placeholder='" + placeholder_label + "'>");
                    var newHeight = $('.bx-viewport').height() + $(el).parents('.option').find('.other_option_input').height() + 15;
                    $('.bx-viewport').height(newHeight);
                }
                // other option not selected and if other input field exists then remove it
                else if (!isOtherSelected) {
                    if ($(el).parents('.option').find('.other_option_input').length != 0)
                    {
                        var newHeight = $('.bx-viewport').height() - ($('.other_option_input').height() + 15);
                        $('.bx-viewport').height(newHeight);
                    }
                    $(el).parents('.option').find('.other_option_input').remove();
                }
            }
            //Changes Regarding survey selection theme side pannel By Govind Sir
            function toggleLeftPane() {
                jQuery(".sidebar").toggleClass("active");
                jQuery(".main-container-preview").toggleClass("active");
                jQuery(".active-leftpane-icon").toggleClass("active");
            }
            function clearSelection(el, question_id, question_type) {
                if (question_type == "scale") {
                    //setting slider
                    $(function () {
                        var answer = '';
                        $(el).parent().parent().find('.ui-slider-handle').find('.tooltip-score').find('div').remove();
                        // scale slider
                        var slider = $('.' + question_id).find("#slider").slider({
                            slide: function (event, ui) {
                                $(ui.handle).find('.tooltip-score').html('<div>' + ui.value + '</div>');
                                $('.' + question_id + '_scale').val(ui.value);
                            },
                            range: "min",
                            value: answer,
                            create: function (event, ui) {
                                var tooltip = $('<div class="tooltip-score">' + answer + '</div>');
                                $(event.target).parent().parent().parent().find('.ui-slider-handle').append(tooltip);
                            },
                            change: function (event, ui) {
                                $('#hidden').attr('value', ui.value);
                            }
                        });
                    });
                    $(el).parents('.form-body').find('#reloadScale').css('display', 'none');
                    $(el).parents('.form-body').find(".ui-slider-range").css("width", "0%");
                    $(el).parents('.form-body').find('.ui-slider-handle').css("left", "0%");
                } else if (question_type == "rating") {
                    $(el).parent().parent().find('li').removeClass('selected');
                    $(el).parent().parent().find('li').removeClass('highlight');
                    $('#' + question_id + '_hidden').val('');
                    $(el).parents('.form-body').find('#reloadScale').css('display', 'none');
                } else if (question_type == "radio-button") {
                    var checkOtherClass = $(el).parent().parent().find('ul').find("input[name='" + question_id + "[]']:checked").attr('class');
                    var checkOtherSplit = checkOtherClass.split(" ");
                    if (checkOtherSplit[2] == "is_other_option") {
                        var newHeight = $('.bx-viewport').height() - ($('.other_option_input').height() + 15);
                        $('.bx-viewport').height(newHeight);
                        $(el).parent().parent().find('.other_option_input').remove();
                    }
                    $(el).parent().parent().find('ul').find("input[name='" + question_id + "[]']:checked").attr('checked', false)
                    $(el).parents('.form-body').find('#reloadScale').css('display', 'none');
                } else if (question_type == "emojis") {
                    var colorEmojiId = $(el).parent().parent().find('ul').find("input[name='" + question_id + "[]']:checked").parent().find('img:last').attr('id');
                    $("#" + colorEmojiId).css('display', 'none');
                    $("#Grey_" + colorEmojiId).css('display', 'inline-block');
                    $(el).parent().parent().find('ul').find("input[name='" + question_id + "[]']:checked").attr('checked', false)
                    $(el).parents('.form-body').find('#reloadScale').css('display', 'none');
                } else if (question_type == "netpromoterscore") {
                    var numberSelectedId = $(el).parent().parent().find('.nps_hidden_selected_values_id').val();
                    var numberSelected = $(el).parent().parent().find('.nps_hidden_selected_values').val();
                    if (parseInt(numberSelected) >= 0 && parseInt(numberSelected) < 7) {
                        $(el).parent().parent().find('#' + numberSelectedId).css('background-color', '#ff5353');
                        $(el).parent().parent().find('.nps_hidden_selected_values_id').remove();
                        $(el).parent().parent().find('.nps_hidden_selected_values').remove();
                    } else if (parseInt(numberSelected) > 6 && parseInt(numberSelected) < 9) {
                        $(el).parent().parent().find('#' + numberSelectedId).css('background-color', '#e9e817');
                        $(el).parent().parent().find('.nps_hidden_selected_values_id').remove();
                        $(el).parent().parent().find('.nps_hidden_selected_values').remove();
                    } else if (parseInt(numberSelected) > 8 && parseInt(numberSelected) < 11) {
                        $(el).parent().parent().find('#' + numberSelectedId).css('background-color', '#92d51a');
                        $(el).parent().parent().find('.nps_hidden_selected_values_id').remove();
                        $(el).parent().parent().find('.nps_hidden_selected_values').remove();
                    }
                    $(el).parents('.form-body').find('#reloadScale').css('display', 'none');
                } else if (question_type == "matrix") {
                    $(el).parent().parent().find('.survey_tmp_matrix').find('.' + question_id + ':checked').attr('checked', false);
                    $(el).parents('.form-body').find('#reloadScale').css('display', 'none');
                }
            }
            function showReset(el) {
                $(el).parents('.form-body').find('#reloadScale').show();
            }
        </script>
    </head>
    <div id="overlay" class="overlay">
        <div id="formProcessLoader" align="center"><img src="themes/default/images/sqsWait.gif" alt="Loading"><b>Please wait...</b></div>
        <div id="formLoaderDisabledScreenDiv" class=""  style="background:none repeat scroll 0 0 #000000; opacity: 0.15;z-index: 999;position: fixed;top: 0;left: 0;right: 0;bottom: 0; height:auto;">&nbsp;</div>
    </div>
    <body>

        <?php
        if (!empty($text_direction)) {
            ?>
            <input type="hidden" id="text_direction" value="<?php echo $text_direction; ?>"/>
            <?php
        }
        if ($survey->survey_theme == 'theme0') {
            require_once 'include/utils/autoloader.php';
            $file_custom = 'custom/themes/default/images/company_logo.png';
            $file_default = 'themes/default/images/company_logo.png';
            if (DotbAutoloader::fileExists($file_custom)) {
                $company_logo = $file_custom;
            } else if (DotbAutoloader::fileExists($file_default)) {
                $company_logo = $file_default;
            }
        }
        // Set Dotb Header
        ?>


        <input type="hidden" id="survey_theme" name="survey_theme" value="<?php echo $survey->survey_theme; ?>">

        <div id='tooltipDiv'></div>
        <a id="buttontoggle" class="active-leftpane-icon" onclick="toggleLeftPane(this);"><span></span></a>
        <div id="sidebar_container" class="">
            <div class="sidebar">
                <?php
                $themeArray = array(
                    'theme0' => array('themeName' => 'Dotb Default', 'imgName' => 'default-theme.jpg'),
                    'theme1' => array('themeName' => 'Innovative', 'imgName' => 'theme-1-hover.png'),
                    'theme2' => array('themeName' => 'Ultimate', 'imgName' => 'theme-2-hover.jpg'),
                    'theme3' => array('themeName' => 'Incredible', 'imgName' => 'theme-3-hover.jpg'),
                    'theme4' => array('themeName' => 'Agile', 'imgName' => 'theme-4-hover.png'),
                    'theme5' => array('themeName' => 'Contemporary', 'imgName' => 'theme-5-hover.png'),
                    'theme6' => array('themeName' => 'Creative', 'imgName' => 'theme-6-hover.png'),
                    'theme7' => array('themeName' => 'Professional', 'imgName' => 'theme-7-hover.png'),
                    'theme8' => array('themeName' => 'Elegant', 'imgName' => 'theme-8-hover.jpg'),
                    'theme9' => array('themeName' => 'Automated', 'imgName' => 'theme-9-hover.png'),
                    'theme10' => array('themeName' => 'Exclusive', 'imgName' => 'theme-10-hover.png'),
                );
                ?>
                <h3>Select Theme</h3>
                <div class="side_pannelThemes">
                    <form action="preview_survey.php?survey_id=<?php echo $survey_id; ?>" method="POST" id="survey_prev_theme_form"> 
                        <input type="hidden" name="survey_id" value="<?php echo $survey_id; ?>">
                        <div id="recentlyViewedSidebar" class="recentlyViewedSidebar">
                            <ul class="nav nav-pills nav-stacked">
                                <!--Check to ensure that recently viewed emails or email addresses are not displayed in the recently viewed panel.-->
                                <?php
                                foreach ($themeArray as $themeCode => $themeDetailArray) {
                                    $sel = '';
                                    if ($theme == $themeCode) {
                                        $sel = 'checked';
                                    }
                                    ?>
                                    <div style="display:none;z-index: 1;padding: 8px;border: 1px solid #dddddd;background: white;"  class="hover-img" id="<?php echo 'hover_' . $themeCode; ?>" ><img width="200" height="200" src="custom/include/survey-img/<?php echo $themeDetailArray['imgName']; ?>" alt="image"></div>
                                    <div id="<?php echo $themeCode; ?>" class="recently_viewed_link_container_sidebar" onclick=" $(this).find('input[name=selected-theme]').attr('checked', true);
                                                $('#survey_prev_theme_form').submit();" style="cursor:pointer">
                                        <li class="recentlinks" role="presentation">
                                            <span class="input-theme-class"><input type="radio" name="selected-theme" value="<?php echo $themeCode; ?>" <?php echo $sel; ?> /><strong><?php
                                                    echo $themeDetailArray['themeName'];
                                                    $i++
                                                    ?></strong></span>
                                            <span class="img-theme-class"><img alt="theme"  id="<?php echo 'themeCode_' . $themeCode; ?>" onmouseout="hideImage(this)" onmouseover="showImage(this)" src="custom/include/survey-img/<?php echo $themeDetailArray['imgName']; ?>" class="zoom" height="40px" width="40px"></span>
                                        </li>
                                    </div>
                                <?php } ?>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--<form method="post" name="survey_submisssion" action="" id="survey_submisssion" >-->
        <div class="bg"></div>
        <?php if (isset($available_lang) && count($available_lang) != 0) {
            ?>
            <div id="lang_selection">
                <p>
                    Language : <select id="selected_lang">
                        <option value="<?php echo $dotb_config['default_language']; ?>"><?php echo $langValues[$dotb_config['default_language']]; ?></option>
                        <?php
                        foreach ($available_lang as $key => $lang) {
                            $selected = '';

                            if ($key == $selected_lang) {
                                $selected = 'selected';
                            }
                            ?>
                            <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $lang ?> </option>
                            <?php
                        }
                        ?>
                    </select>
                </p>
            </div><input type="hidden" value="<?php echo $selected_lang; ?>" id="selectedLanguage" name="selectedLanguage"/>
            <input type="hidden" value="<?php echo $theme; ?>" id="selected-theme" name="selected-theme"/>
        <?php } ?>
        <div class="main-container-preview">
            <div class="main-container preview-main">


                <?php
                if ($theme != 'theme0') {
                    // Set Dotb Header
                    ?>
                    <div class="clip">
                        <span class="clip-0"><img src="custom/include/survey-img/paperclip-last.png" alt=""></span>
                        <span class="clip-1"><img src="custom/include/survey-img/paperclip.png" alt=""></span>
                        <span class="clip-2"><img src="custom/include/survey-img/paperclip.png" alt=""></span>

                    </div>
                    <?php
                }
                $totalpages = count($survey_details);
                if ($survey->id) {

                    $sql = "SELECT image FROM bc_survey WHERE id='{$survey->id}'";

                    // the result of the query
                    $result = $db->query($sql);

                    // set the header for the image
                    while ($row = $db->fetchRow($result)) {
                        $base64 = base64_encode($row['image']);
                    }
                }
                ?>
                <div class="top-section">
                    <div class="header">
                        <div class="">
                            <?php
                            if ($theme != 'theme0') {
                                // Set Dotb Header
                                ?>
                                <h1 class="logo">
                                <?php } else { ?>
                                    <h1 class="survey-logo">
                                        <?php
                                    }

                                    if (!empty($base64)) {
                                        ?>
                                        <img src="data:image/png;base64,<?php echo $base64; ?>" alt=""/>
                                    <?php } ?>
                                </h1>


                                <div class="survey-header"><h2>
                                        <?php
                                        if (!empty($list_lang_detail[$survey_id . '_survey_title'])) {
                                            echo $list_lang_detail[$survey_id . '_survey_title'];
                                        } else {
                                            echo $survey->name;
                                        }
                                        ?></h2></div>
                        </div>
                    </div>
                </div>
                <?php
                if ($survey->survey_theme == 'theme0') {
                    // Set Dotb Header
                    ?>
                <?php } ?>
                <div class="survey-container">
                    <?php
                    if (isset($msg) && $msg != '') {
                        echo $msg;
                        exit;
                    }
                    ?>
                    <div class="container">
                        <div class="survey-form form-desc">
                            <?php if ($totalpages > 1) { ?>
                                <ul class="progress-bar">
                                    <!--    setting number & page title designing for page completion status-->
                                    <?php
                                    // Setting Page Header
                                    if ($is_progress_indicator != 1) {
                                        foreach ($survey_details as $page_sequence => $detail) {
                                            if ($survey->survey_theme == 'theme2' || $survey->survey_theme == 'theme6' || $survey->survey_theme == 'theme7' || $survey->survey_theme == 'theme8') {
                                                ?>

                                                <li class="hexagon" style='cursor: default'><span class="pro-text"><?php echo 'Page ' . $page_sequence; ?></span><a style='cursor: default'><?php echo $page_sequence; ?></a></li> 

                                                <?php
                                            } else {
                                                ?>

                                                <li class="hexagon" style='cursor: default'><span class="pro-text"><?php echo 'Page'; ?></span><a style='cursor: default'><?php echo $page_sequence; ?></a></li> 

                                                <?php
                                            }
                                        }
                                    } else {
                                        ?>
                                        <section style = "width:100%">

                                            <div id="pagecount" class="equal text"  style="width:5%"></div>
                                            <div id="progress" class="equal" style="width:85%"></div>
                                            <div id="progress-percentage" class="equal text last" style="width:5%"></div>
                                        </section>
                                    <?php } ?>
                                    <div class="shape">
                                        <span class="arr-right"></span>
                                    </div>

                                </ul>
                            <?php } else {
                                ?>
                                <br/>
                            <?php } ?>
                            <div class="form-body">
                                <?php
                                if (!empty($list_lang_detail[$survey_id . '_survey_description'])) {
                                    echo nl2br($list_lang_detail[$survey_id . '_survey_description']);
                                } else {
                                    echo nl2br($survey->description);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <ul class="bxslider">
                        <?php
                        $addClass = '';
                        $totalpages = count($survey_details);
                        if ($totalpages <= 1 && (empty($survey->survey_welcome_page) || $survey->survey_welcome_page == '&lt;p&gt;&lt;br data-mce-bogus=&quot;1&quot;&gt;&lt;/p&gt;' || $survey->survey_welcome_page == '&lt;p&gt;&amp;nbsp;&lt;br&gt;&lt;/p&gt;')) {
                            $addClass = 'hideBtn';
                        }
                        $img_flag = false;
                        $que_no = 0;

// set up WELCOME Page
                        if (!empty($survey->survey_welcome_page) && $survey->survey_welcome_page != '&lt;p&gt;&lt;br data-mce-bogus=&quot;1&quot;&gt;&lt;/p&gt;' && $survey->survey_welcome_page != '&lt;p&gt;&amp;nbsp;&lt;br&gt;&lt;/p&gt;') {
                            ?>				
                            <li>
                                <div class="survey-form welcome-form">
                                    <?php
                                    if (!empty($list_lang_detail['survey_welcome_page'])) {
                                        $welcome_content = base64_decode($list_lang_detail['survey_welcome_page']);
                                    } else {
                                        $welcome_content = $survey->survey_welcome_page;
                                    }
                                    echo '<div class="form-body">' . html_entity_decode_utf8($welcome_content) . '</div>';
                                    ?>

                                </div>
                            </li>
                            <?php
                        }
                        foreach ($survey_details as $page_sequence => $detail) {
                            ?>				
                            <li>
                                <div class="survey-form">
                                    <div class="form-header">
                                        <h1><?php echo $detail['page_title']; ?></h1>
                                        <span class="page-no"><i><?php echo $page_sequence ?></i></span>
                                    </div>
                                    <?php
                                    foreach ($detail['page_questions'] as $que_sequence => $question) {
                                        $separator_css = '';
                                        if ($question['is_question_seperator'] == 1) {
                                            $separator_css = 'border-bottom: 1px solid #dddddd !important';
                                        }
                                        ?>
                                        <?php
                                        if ($question['disabled_question'] != 1) {
                                            ?>
                                            <div class="form-body <?php echo $question['que_type']; ?>" style="<?php echo $separator_css; ?>">
                                                <input type="hidden" class="questionHiddenField" name="questions[]" value="<?php echo $question['que_id'] ?>"  >
                                                <?php
                                                if ($question['que_type'] == 'section-header') {
                                                    $que_class = 'section-header-div';
                                                    echo '<div class="question-section">' . $question['que_title'] . '</div>';
                                                } else if ($question['que_type'] == 'additional-text') {
                                                    echo '<div style="font-size:14px;">' . nl2br($question['description']) . '</div>';
                                                } else {
                                                    $que_class = '';
                                                    ?>

                                                    <h3 class="questions <?php echo $que_class ?>">
                                                        <?php
                                                        if ($question['que_type'] == 'image' || $question['que_type'] == 'video') {
                                                            echo $question['question_help_comment'];
                                                        } else if ($question['que_type'] == 'section-header') {
                                                            echo '<div class="question-section">' . $question['que_title'] . '</div>';
                                                        } else if ($question['que_type'] == 'additional-text' || $question['que_type'] == 'richtextareabox') {
                                                            // nothing display here
                                                        } else {
                                                            $que_no++;
                                                            $img_flag = false;
                                                            echo $que_no . '.&nbsp;';

                                                            $fullstring = $question['que_title'];
                                                            $occu = substr_count($fullstring, "{{Q");
                                                            $piping_seq = array();
                                                            for ($i = 0; $i < $occu; $i++) {
                                                                $sub_part = explode('{{Q', $fullstring)[1];
                                                                $current_piping_seq = explode('}}', $sub_part)[0];
                                                                $piping_seq .= explode('}}', $sub_part)[0] . ' ';
                                                                $fullstring = str_replace('{{Q' . trim($current_piping_seq) . '}}', ' <span class="que_pipe_' . $current_piping_seq . '"> </span>', $fullstring);
                                                            }
                                                            $que_title = $fullstring;
                                                            echo '<input type="hidden" class="current_piping_sequence_' . $question['piping_sequence'] . '" name="current_piping_sequence" value="' . $question['piping_sequence'] . '" /><div style="display:inline;" class="que-title">' . $que_title . '</div>';
                                                            ?>  <?php if ($question['is_required'] == 1) { ?>
                                                                <span class="is_required" style="color:red;">   *</span>
                                                                <?php
                                                            }
                                                        }
                                                        if ($question['que_type'] == 'image' || $question['que_type'] == 'video') {
                                                            // do not display help comment on top-right side
                                                        } else if (!empty($question['question_help_comment'])) {
                                                            $extracss = '';
                                                            if ($oSurvey->survey_theme != 'theme0') {
                                                                $extracss = 'padding-right: 35px;';
                                                            }
                                                            ?> <div class="queHelpIconDiv" style="display: inline-block;float:right !important; position:absolute;<?php echo $extracss; ?>"><img alt="" class="questionImgIcon" onmouseout="removeHelpTipPopUpDiv();" onmouseover="openHelpTipsPopUpSurvey(this, '<?php echo $question['question_help_comment']; ?>');" src="custom/include/survey-img/question.png" ></div>
                                                        <?php } ?>
                                                        <?php if ($question['que_type'] == 'scale' || $question['que_type'] == 'rating' || $question['que_type'] == "radio-button" || ($question['que_type'] == "matrix" && $question['advance_type'] == "radio") || $question['que_type'] == "netpromoterscore" || $question['que_type'] == "emojis") { ?>
                                                            <div style="display:none;" class="btn btn-primary" data-queid="<?php echo $question['que_id']; ?>" data-button-clicked="Reset Slider" id="reloadScale" title="Reset Answer" onclick="clearSelection(this, '<?php echo $question['que_id']; ?>', '<?php echo $question['que_type']; ?>')"><i><img alt="" src="custom/include/images/reset.png"></i></div> 
                                                        <?php } ?></h3>
                                                    <?php
                                                }
                                                $richtextContent = '';
                                                if ($question['que_type'] == 'richtextareabox') {
                                                    $richtextContent = $question['richtextContent'];
                                                }
                                                $elementHTML = getMultiselectHTML($question, $list_lang_detail, $richtextContent, $survey_id);
                                                echo $elementHTML;
                                                ?>                    
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </li>

                            <?php
                        }
// set up Thanks Page
                        if (!empty($survey->survey_thanks_page) && $survey->survey_thanks_page != '&lt;p&gt;&lt;br data-mce-bogus=&quot;1&quot;&gt;&lt;/p&gt;') {
                            ?>				
                            <li>
                                <div class="survey-form thanks-page">
                                    <?php
                                    if (!empty($list_lang_detail['survey_thanks_page'])) {
                                        $thanks_content = base64_decode($list_lang_detail['survey_thanks_page']);
                                    } else {
                                        $thanks_content = $survey->survey_thanks_page;
                                    }
                                    echo '<div class="form-body">' . html_entity_decode_utf8($thanks_content) . '</div>';
                                    ?>

                                </div>
                            </li>
                            <?php
                        }
                        if (!empty($list_lang_detail['next_button'])) {
                            $next_button_label = $list_lang_detail['next_button'];
                            ?>
                            <input type="hidden" id="next_button_label" value="<?php echo $list_lang_detail['next_button']; ?>"/>
                            <?php
                        } else {
                            $next_button_label = 'Next';
                        }
                        if (!empty($list_lang_detail['prev_button'])) {
                            $prev_button_label = $list_lang_detail['prev_button'];
                        } else {
                            $prev_button_label = 'Prev';
                        }
                        if (!empty($list_lang_detail['submit_button'])) {
                            ?>
                            <input type="hidden" id="submit_button_label" value="<?php echo $list_lang_detail['submit_button']; ?>"/>
                            <?php
                            $submit_button_label = $list_lang_detail['submit_button'];
                        } else {
                            $submit_button_label = 'Prev';
                        }
                        ?>
                    </ul>
                    <?php // if ($totalpages > 1) {      ?>
                    <div class="seperator-class" style=""></div>


                </div>
                <div class="survey-footer">
                    <?php
                    // Agreement
                    if ($survey->enable_agreement == 1 && !empty($survey->agreement_content)) {
                        $required_agrement = '';
                        if ($survey->is_required_agreement == 1) {
                            $required_agrement = 'required';
                        }
                        $displaySection = 'style="display:none"';
                        if (empty($survey->survey_thanks_page) && empty($survey->survey_welcome_page) && $totalpages == 1) {
                            $displaySection = '';
                        }
                        $agreement_html = '<div class="form-body agreement_section" ' . $displaySection . '><div class="form-body">';
                        $agreement_html .= "<li class='md-checkbox'><label><input type='checkbox'  id='agreement_survey' class='agreement_survey'>{$survey->agreement_content}<label for='agreement_survey'>
                                                        <span></span>
                                                            <span class='check'></span>
                                                            <span class='box'></span></label></label></li>";
//                                    $agreement_html .= "<input type='checkbox' {$required_agrement} id='agreement_survey' />&nbsp;";
//                                    $agreement_html .= "<span>{$survey->agreement_content}</span>";
                        $agreement_html .= '</div></div>';
                        echo $agreement_html;
                    }
                    ?>
                    <div class = "action-block">
                        <div style="display: inline-block;float: right;"> <input class='bx-prev button hideBtn'  type='button' value='<?php echo $prev_button_label; ?>' name="btnprev" id="btnprev">
                            <input class='bx-next button <?php echo $addClass; ?>'  type='button' value='<?php echo $next_button_label; ?>' name="btnnext" id="btnnext"></div>
                    </div>
                    <?php if ($survey->footer_content != "") { ?>
                        <center><?php echo html_entity_decode($survey->footer_content); ?></center>
                <?php } ?>
                <?php
                if ($survey->survey_theme != 'theme0') {
                    // Bottom Link
                    ?>

                <?php } else { ?>
                <?php } ?>
            </div></div>

    </div>

</body>
</html>
