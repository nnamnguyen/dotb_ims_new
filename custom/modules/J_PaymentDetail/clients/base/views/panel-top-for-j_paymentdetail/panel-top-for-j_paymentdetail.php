<?php

$viewdefs['J_PaymentDetail']['base']['view']['panel-top-for-j_paymentdetail'] = array(
    'type' => 'panel-top',
    'template' => 'panel-top',

    'buttons' => array(
        array(
            'type' => 'button',
            'name' => 'create_j_paymentdetail',
            'icon' => 'fa-plus',
            'css_class' => 'btn',
            'label'=>'Create',
            'event' => 'button:create_j_paymentdetail:click',
            'acl_module' => 'J_PaymentDetail',
            'acl_action' => 'create',
        ),

    ),

);
