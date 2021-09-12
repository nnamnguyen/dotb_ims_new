<?php

$viewdefs['DRI_Workflow_Templates']['base']['view']['template-import-headerpane'] = array(
    'template' => 'headerpane',
    'title' => 'LBL_IMPORT',
    'buttons' => array(
        array(
            'name'    => 'project_cancel_button',
            'type'    => 'button',
            'label'   => 'LBL_CANCEL_BUTTON_LABEL',
            'css_class' => 'btn-invisible btn-link',
        ),
        array(
            'name'    => 'project_finish_button',
            'type'    => 'button',
            'label'   => 'LBL_CUSTOMER_JOURNEY_TEMPLATE_IMPORT_BUTTON_LABEL',
            'acl_action' => 'create',
            'css_class' => 'btn-primary',
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
