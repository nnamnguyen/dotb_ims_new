<?php

$viewdefs['Emails']['base']['view']['compose-email'] = array(
    'template' => 'record',
    'buttons' => array(
        array(
            'name' => 'cancel_button',
            'type' => 'button',
            'label' => 'LBL_CANCEL_BUTTON_LABEL',
            'tooltip' => 'LBL_CANCEL_BUTTON_LABEL',
            'icon' => 'fa-times',
            'css_class' => 'btn ',
            'events' => array(
                'click' => 'button:cancel_button:click',
            ),
        ),
        array(
            'name' => 'save_button',
            'type' => 'button',
            'label' => 'LBL_SAVE_AS_DRAFT_BUTTON_LABEL',
            'tooltip' => 'LBL_SAVE_AS_DRAFT_BUTTON_LABEL',
            'icon' => 'fa-save',
            'css_class' => 'btn ',
            'events' => array(
                'click' => 'button:save_button:click',
            ),
        ),
        array(
            'name' => 'send_button',
            'type' => 'button',
            'label' => 'LBL_SEND_BUTTON_LABEL',
            'tooltip' => 'LBL_SEND_BUTTON_LABEL',
            'icon' => 'fa-paper-plane',
            'css_class' => 'btn ',
            'primary' => true,
            'events' => array(
                'click' => 'button:send_button:click',
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
                    'name' => 'recipients',
                    'type' => 'recipients-fieldset',
                    'css_class' => 'email-recipients',
                    'dismiss_label' => true,
                    'fields' => array(
                        array(
                            'name' => 'outbound_email_id',
                            'type' => 'outbound-email',
                            'label' => 'LBL_FROM',
                            'span' => 12,
                            'css_class' => 'inherit-width',
                            'searchBarThreshold' => -1,
                        ),
                        array(
                            'name' => 'to_collection',
                            'type' => 'email-recipients',
                            'label' => 'LBL_TO_ADDRS',
                            'span' => 12,
                            'max_num' => -1,
                            'fields' => array(
                                'email_address_id',
                                'email_address',
                                'parent_type',
                                'parent_id',
                                'parent_name',
                                'invalid_email',
                                'opt_out',
                            ),
                        ),
                        array(
                            'name' => 'cc_collection',
                            'type' => 'email-recipients',
                            'label' => 'LBL_CC',
                            'span' => 12,
                            'max_num' => -1,
                            'fields' => array(
                                'email_address_id',
                                'email_address',
                                'parent_type',
                                'parent_id',
                                'parent_name',
                                'invalid_email',
                                'opt_out',
                            ),
                        ),
                        array(
                            'name' => 'bcc_collection',
                            'type' => 'email-recipients',
                            'label' => 'LBL_BCC',
                            'span' => 12,
                            'max_num' => -1,
                            'fields' => array(
                                'email_address_id',
                                'email_address',
                                'parent_type',
                                'parent_id',
                                'parent_name',
                                'invalid_email',
                                'opt_out',
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'name',
                    'label' => 'LBL_SUBJECT',
                    'dismiss_label' => true,
                    'placeholder' => 'LBL_SUBJECT',
                    'span' => 12,
                    'css_class' => 'ellipsis_inline',
                    'related_fields' => array(
                        'state',
                    ),
                ),
                array(
                    'name' => 'description_html',
                    'dismiss_label' => true,
                    'span' => 12,
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
                    'max_num' => -1,
                    'fields' => array(
                        'name',
                        'filename',
                        'file_size',
                        'file_source',
                        'file_mime_type',
                        'file_ext',
                        'upload_id',
                    ),
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
                    'name' => 'tag',
                    'span' => '12',
                ),
            ),
        ),
    ),
);
