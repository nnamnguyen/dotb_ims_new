<?php
$viewdefs['base']['layout']['help'] = array(
    'components' => array(
        array(
            'view' => 'help-header',
        ),
        array(
            'layout' => array(
                'type' => 'base',
                'css_class' => 'helplet-list-container',
                'components' => array(
                    array(
                        'view' => array(
                            'type' => 'helplet',
                            'resources' => array(
                                'support' => array(
                                    'color' => 'red',
                                    'icon' => 'fa-info-circle',
                                    'url' => 'https://support.dotb.vn',
                                    'link' => 'LBL_LEARNING_RESOURCES_SUPPORT_LINK',
                                )
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
