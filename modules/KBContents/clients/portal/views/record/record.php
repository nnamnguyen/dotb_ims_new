<?php

$viewdefs['KBContents']['portal']['view']['record'] = array(
    'buttons' => array(
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
    'panels' => array(
        array(
            'name' => 'panel_header',
            'header' => true,
            'fields' => array(
                array(
                    'name' => 'picture',
                    'type' => 'avatar',
                    'size' => 'large',
                    'dismiss_label' => true,
                    'readonly' => true,
                ),
                array(
                    'name' => 'name',
                    'related_fields' => array(
                        'useful',
                        'notuseful',
                        'usefulness_user_vote',
                    ),
                ),
            ),
        ),
        array(
            'name' => 'panel_body',
            'label' => 'LBL_RECORD_BODY',
            'columns' => 2,
            'labelsOnTop' => true,
            'placeholders' => true,
            'fields' => array(
                'kbdocument_body' => array(
                    'name' => 'kbdocument_body',
                    'type' => 'html',
                    'span' => 12,
                ),
                'attachment_list' => array(
                    'name' => 'attachment_list',
                    'label' => 'LBL_ATTACHMENTS',
                    'type' => 'attachments',
                    'link' => 'attachments',
                    'module' => 'Notes',
                    'modulefield' => 'filename',
                    'bLable' => 'LBL_ADD_ATTACHMENT',
                    'bIcon' => 'fa-paperclip',
                    'span' => 12,
                ),
                'category_name' => array(
                    'name' => 'category_name',
                    'label' => 'LBL_CATEGORY_NAME',
                ),
                'language' => array(
                    'name' => 'language',
                    'type' => 'enum-config',
                    'key' => 'languages',
                ),
                'date_entered' => array(
                    'name' => 'date_entered',
                ),
                'active_date' => array(
                    'name' => 'active_date',
                ),
            ),
        ),
    ),
    'moreLessInlineFields' => array(
        'usefulness' => array(
            'name' => 'usefulness',
            'type' => 'usefulness',
            'span' => 6,
            'cell_css_class' => 'pull-right usefulness',
            'readonly' => true,
            'fields' => array(
                'usefulness_user_vote',
                'useful',
                'notuseful',
            ),
        ),
    ),
);
