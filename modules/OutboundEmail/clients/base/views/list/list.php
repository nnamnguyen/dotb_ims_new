<?php

$viewdefs['OutboundEmail']['base']['view']['list'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'enabled' => true,
                    'default' => true,
                    'link' => true,
                    'related_fields' => array(
                        'type',
                    ),
                ),
                array(
                    'name' => 'email_address',
                    'type' => 'email-address',
                    'enabled' => true,
                    'default' => true,
                    'link' => false,
                ),
                array(
                    'name' => 'mail_smtpserver',
                    'enabled' => true,
                    'default' => true,
                    'readonly' => true,
                ),
                array(
                    'name' => 'mail_smtpuser',
                    'enabled' => true,
                    'default' => true,
                    'readonly' => true,
                ),
            ),
        ),
    ),
);
