<?php



$viewdefs['base']['layout']['preview'] = array(
    'lazy_loaded' => 'true',
    'components' => array(
        array(
            'view' => 'preview-header',
        ),
//        array(
//            'view' => 'preview',
//        ),
        array(
            'layout' => 'preview-activitystream',
            'context' => array(
                'module' => 'Activities',
                'forceNew' => true,
            ),
        ),
    ),
);

