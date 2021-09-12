<?php

$viewdefs['DRI_SubWorkflows']['mobile']['layout']['subpanels'] = array(
    'components' => array(
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_TASKS',
            'context' => array(
                'link' => 'tasks'
            ),
            'linkable' => false,
            'creatable' => false,
            'unlinkable' => false
        ),
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_CALLS',
            'context' => array(
                'link' => 'calls'
            ),
            'linkable' => false,
            'creatable' => false,
            'unlinkable' => false
        ),
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_MEETINGS',
            'context' => array(
                'link' => 'meetings'
            ),
            'linkable' => false,
            'creatable' => false,
            'unlinkable' => false
        )
    )
);
