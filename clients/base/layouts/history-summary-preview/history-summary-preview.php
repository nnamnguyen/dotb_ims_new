<?php

$viewdefs['base']['layout']['history-summary-preview'] = array(
    'type' => 'preview',
    'lazy_loaded' => true,
    'components' => array(
        array(
            'view' => 'history-summary-preview-header',
        ),
        array(
            'view' => 'history-summary-preview',
        ),
        array(
            'layout' => 'preview-activitystream',
            'context' => array(
                'module' => 'Activities',
                'forceNew' => true,
            ),
        ),
    ),
);
