<?php
/**
 * Create By: Hiếu Phạm
 * DateTime: 9:35 PM 03/04/2019
 * To:
 */


$viewdefs['J_Loyalty']['base']['view']['panel-top-for-loyalty_link'] = array(
    'type' => 'panel-top',
    'template' => 'panel-top',
    'buttons' => array(
        array(
            'type' => 'button',
            'name' => 'add_loyalty',
            'icon' => 'fa-plus',
            'css_class' => 'btn',
            'label' => 'LBL_ADD_LOYALTY',
            'event' => 'button:add_loyalty:click'
        ),
    )
);
