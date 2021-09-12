<?php
/**
 * Create By: Hiếu Phạm
 * DateTime: 9:35 PM 03/04/2019
 * To:
 */


$viewdefs['J_Payment']['base']['view']['panel-top-for-students'] = array(
    'type' => 'panel-top',
    'template' => 'panel-top',
    'buttons' => array(
        array(
            'type' => 'button',
            'name' => 'student_create_payment',
            'css_class' => 'btn',
            'label' => 'LBL_CREATE_PAYMENT',
            'event' => 'button:student_create_payment:click',
            'primary' => false,
        ),

    ),

);
