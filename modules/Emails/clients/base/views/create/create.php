<?php

$viewdefs['Emails']['base']['view']['create'] = array(
    'template' => 'record',
    'buttons' => array(
        array(
            'name' => 'cancel_button',
            'type' => 'button',
            'label' => 'LBL_CANCEL_BUTTON_LABEL',
            'tooltip' => 'LBL_CANCEL_BUTTON_LABEL',
            'css_class' => 'btn ',
            'icon' => 'fa-window-close',
            'events' => array(
                'click' => 'button:cancel_button:click',
            ),
        ),
        array(
            'name' => 'save_button',
            'type' => 'button',
            'label' => 'LBL_ARCHIVE',
            'tooltip' => 'LBL_ARCHIVE',
            'primary' => true,
            'css_class' => 'btn ',
            'icon' => 'fa-archive',
            'showOn' => 'create',
            'events' => array(
                'click' => 'button:save_button:click',
            ),
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
    'panels' => array(
        array(
            'name' => 'panel_body',
            'label' => 'LBL_SHORTCUT_EMAIL_SEND',
            'columns' => 1,
            'labels' => true,
            'labelsOnTop' => true,
            'placeholders' => true,
            'fields' => array(
                array(
                    'name' => 'date_sent',
                    'type' => 'datetimecombo',
                    'label' => 'LBL_DATE_SENT',
                    'span' => 12,
                    'required' => true,
                ),
                array(
                    'name' => 'from_collection',
                    'type' => 'from',
                    'label' => 'LBL_FROM',
                    'span'  => 12,
                    'required' => true,
                ),
                array(
                    'name' => 'to_collection',
                    'type' => 'email-recipients',
                    'label' => 'LBL_TO_ADDRS',
                    'span' => 12,
                    'decorate_opt_out' => false,
                ),
                array(
                    'name' => 'cc_collection',
                    'type' => 'email-recipients',
                    'label' => 'LBL_CC',
                    'span' => 12,
                    'decorate_opt_out' => false,
                ),
                array(
                    'name' => 'bcc_collection',
                    'type' => 'email-recipients',
                    'label' => 'LBL_BCC',
                    'span' => 12,
                    'decorate_opt_out' => false,
                ),
                array(
                    'name' => 'name',
                    'label' => 'LBL_SUBJECT',
                    'span' => 12,
                    'required' => true,
                ),
                array(
                    'name' => 'description_html',
                    'dismiss_label' => true,
                    'span' => 12,
                    'fieldSelector' => 'archive_html_body',
                    'tinyConfig' => array(
                        'toolbar' => 'code | bold italic underline strikethrough | bullist numlist | ' .
                            'alignleft aligncenter alignright alignjustify | forecolor backcolor | ' .
                            'fontsizeselect | formatselect | fontselect | dotbattachment dotbsignature dotbtemplate',
                    ),
                ),
                array(
                    'name' => 'attachments_collection',
                    'type' => 'email-attachments',
                    'dismiss_label' => true,
                    'span' => 12,
                ),
            ),
        ),
        array(
            'name' => 'panel_hidden',
            'hide' => true,
            'columns' => 1,
            'labelsOnTop' => true,
            'placeholders' => true,
            'fields' => array(
                array(
                    'type' => 'teamset',
                    'name' => 'team_name',
                    'span' => 12,
                ),
                array(
                    'name' => 'parent_name',
                    'span' => 12,
                ),
                array(
                    'name' => 'assigned_user_name',
                    'type' => 'relate',
                    'span' => 12,
                ),
                array(
                    'name' => 'tag',
                    'span' => 12,
                ),
            ),
        ),
    ),
);
