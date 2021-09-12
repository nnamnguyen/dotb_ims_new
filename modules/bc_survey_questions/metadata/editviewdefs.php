<?php

/**
 * The file used to handle metadata for survey questions
 *
 * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
 * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
 * agreed to the terms and conditions of the License, and you may not use this file except in compliance
 * with the License.
 *
 * @author     Biztech Consultancy
 */
$module_name = 'bc_survey_questions';
$viewdefs [$module_name] = array(
            'EditView' =>
            array(
                'templateMeta' =>
                array(
                    'maxColumns' => '2',
                    'widths' =>
                    array(
                        0 =>
                        array(
                            'label' => '10',
                            'field' => '30',
                        ),
                        1 =>
                        array(
                            'label' => '10',
                            'field' => '30',
                        ),
                    ),
                ),
                'panels' =>
                array(
                    'default' =>
                    array(
                        0 =>
                        array(
                            0 => 'name',
                            1 => 'assigned_user_name',
                        ),
                        1 =>
                        array(
                            0 => 'description',
                            1 =>
                            array(
                                'name' => 'bc_survey_template_bc_survey_questions_name',
                            ),
                        ),
                        2 =>
                        array(
                            0 =>
                            array(
                                'name' => 'bc_survey_bc_survey_questions_name',
                            ),
                            1 =>
                            array(
                                'name' => 'bc_survey_pages_bc_survey_questions_name',
                            ),
                        ),
                    ),
                ),
            ),
);
?>