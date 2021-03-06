<?php

/**
 * The file used to handle relationship for survey 
 *
 * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
 * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
 * agreed to the terms and conditions of the License, and you may not use this file except in compliance
 * with the License.
 *
 * @author     Biztech Consultancy
 */
$dictionary["bc_survey_pages_bc_survey_questions"] = array(
    'true_relationship_type' => 'one-to-many',
    'relationships' =>
    array(
        'bc_survey_pages_bc_survey_questions' =>
        array(
            'lhs_module' => 'bc_survey_pages',
            'lhs_table' => 'bc_survey_pages',
            'lhs_key' => 'id',
            'rhs_module' => 'bc_survey_questions',
            'rhs_table' => 'bc_survey_questions',
            'rhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'join_table' => 'bc_survey_pages_bc_survey_questions_c',
            'join_key_lhs' => 'bc_survey_pages_bc_survey_questionsbc_survey_pages_ida',
            'join_key_rhs' => 'bc_survey_pages_bc_survey_questionsbc_survey_questions_idb',
        ),
    ),
    'table' => 'bc_survey_pages_bc_survey_questions_c',
    'fields' =>
    array(
        'id' =>
        array(
            'name' => 'id',
            'type' => 'varchar',
            'len' => 36,
        ),
        'date_modified' =>
        array(
            'name' => 'date_modified',
            'type' => 'datetime',
        ),
        'deleted' =>
        array(
            'name' => 'deleted',
            'type' => 'bool',
            'len' => '1',
            'default' => '0',
            'required' => true,
        ),
        'bc_survey_pages_bc_survey_questionsbc_survey_pages_ida' =>
        array(
            'name' => 'bc_survey_pages_bc_survey_questionsbc_survey_pages_ida',
            'type' => 'varchar',
            'len' => 36,
        ),
        'bc_survey_pages_bc_survey_questionsbc_survey_questions_idb' =>
        array(
            'name' => 'bc_survey_pages_bc_survey_questionsbc_survey_questions_idb',
            'type' => 'varchar',
            'len' => 36,
        ),
    ),
    'indices' =>
    array(
        
        array(
            'name' => 'bc_survey_pages_bc_survey_questionsspk',
            'type' => 'primary',
            'fields' =>
            array(
                0 => 'id',
            ),
        ),
        
        array(
            'name' => 'bc_survey_pages_bc_survey_questions_ida1',
            'type' => 'index',
            'fields' =>
            array(
                0 => 'bc_survey_pages_bc_survey_questionsbc_survey_pages_ida',
            ),
        ),
       
        array(
            'name' => 'bc_survey_pages_bc_survey_questions_alt',
            'type' => 'alternate_key',
            'fields' =>
            array(
                0 => 'bc_survey_pages_bc_survey_questionsbc_survey_questions_idb',
            ),
        ),
    ),
);
