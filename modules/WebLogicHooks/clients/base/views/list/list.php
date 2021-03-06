<?php



$viewdefs['WebLogicHooks']['base']['view']['list'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'enabled' => true,
                    'sortable' => true,
                    'link' => true,
                ),
                array(
                    'name' => 'url',
                    'enabled' => true,
                    'sortable' => true,
                ),
                array(
                    'name' => 'webhook_target_module',
                    'enabled' => true,
                    'sortable' => true,
                ),
                array(
                    'name' => 'trigger_event',
                    'enabled' => true,
                    'sortable' => true,
                ),
                array(
                    'name' => 'request_method',
                    'enabled' => true,
                    'sortable' => true,
                ),
            )
        ),
    ),
    'dependencies' => array(
        array(
            'hooks' => array('all'),
            'trigger' => 'true',
            'triggerFields' => array('trigger_event'),
            'onload' => true,
            'actions' => array(
                array(
                    'action' => 'SetVisibility',
                    'params' => array(
                        'target' => 'webhook_target_module',
                        'value' => 'not(isInList($trigger_event, createList("after_login", "after_logout", "login_failed")))'
                    )
                ),
                array(
                    'action' => 'SetValue',
                    'params' => array(
                        'target' => 'webhook_target_module',
                        'value' => 'ifElse(isInList($trigger_event, createList("after_login", "after_logout", "login_failed")), "Users", $webhook_target_module)'
                    )
                )
            )
        )
    )
);
