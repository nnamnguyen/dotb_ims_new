<?php



$viewdefs['pmse_Emails_Templates']['base']['layout']['emailtemplates'] = array(
    'components' => array(
        array(
            'layout' => array(
                'type' => 'default',
                'name' => 'sidebar',
                'components' => array(
                    array(
                        'layout' => array(
                            'type' => 'base',
                            'name' => 'main-pane',
                            'css_class' => 'main-pane span8',
                            'components' => array(
                                array(
                                    'view' => 'compose',
                                    'primary' => true,
                                ),
                                array(
                                    'layout' => 'extra-info',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
