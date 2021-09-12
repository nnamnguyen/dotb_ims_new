<?php


$viewdefs['Reports']['base']['view']['drillthrough-headerpane'] = array(
    'template' => 'headerpane',
    'fields' => array(
        array(
            'name' => 'title',
            'type' => 'label',
        ),
        array(
            'name' => 'drillthrough-collection-count',
            'type' => 'drillthrough-collection-count',
        ),
        array(
            'name' => 'drillthrough-labels',
            'type' => 'drillthrough-labels',
        ),
    ),
    'buttons' => array(
        array(
            'name' => 'close',
            'type' => 'button',
            'label' => 'LBL_CANCEL_BUTTON_LABEL',
            'events' => array(
                'click' => 'drillthrough:closedrawer:fire',
            ),
            'css_class' => 'btn-invisible btn-link',
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
