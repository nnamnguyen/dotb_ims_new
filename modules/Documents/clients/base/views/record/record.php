<?php


/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

$viewdefs['Documents']['base']['view']['record'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'header' => true,
            'fields' => array(
                array(
                    'name'          => 'picture',
                    'type'          => 'avatar',
                    'size'          => 'large',
                    'dismiss_label' => true,
                    'readonly'      => true,
                ),
                array (
                    'name' => 'filename',
                    'displayParams' =>
                    array (
                      'link' => 'filename',
                      'id' => 'document_revision_id',
                    ),
                    'readonly' => true,
                    'span' => 12,
                    'label' => '',
                ),
                array(
                    'name' => 'favorite',
                    'label' => 'LBL_FAVORITE',
                    'type' => 'favorite',
                    'dismiss_label' => true,
                ),
                array(
                    'name' => 'follow',
                    'label'=> 'LBL_FOLLOW',
                    'type' => 'follow',
                    'readonly' => true,
                    'dismiss_label' => true,
                ),
            )
        ),
        array(
            'name' => 'panel_body',
            'label' => 'LBL_RECORD_BODY',
            'columns' => 2,
            'labelsOnTop' => true,
            'placeholders' => true,
            'fields' => array(
                'document_name',
                'status',
                'revision',
                'template_type',
                'is_template',
                'active_date',
                'category_id',
                'exp_date',
                'subcategory_id',
                'description',
                'related_doc_name',
                'related_doc_rev_number',
                'assigned_user_name',
                'team_name',
            ),
        ),
        array(
            'name' => 'panel_hidden',
            'label' => 'LBL_RECORD_SHOWMORE',
            'columns' => 2,
            'hide' => true,
            'labelsOnTop' => true,
            'placeholders' => true,
            'fields' => array(
                'last_rev_created_name',
                'last_rev_create_date',
            )
        )
    ),
);
