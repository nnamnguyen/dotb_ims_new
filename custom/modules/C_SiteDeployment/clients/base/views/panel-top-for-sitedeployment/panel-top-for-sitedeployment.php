<?php

$viewdefs['C_SiteDeployment']['base']['view']['panel-top-for-sitedeployment'] = array(
    'type' => 'panel-top',
    'template' => 'panel-top',

    'buttons' => array(
        array(
            'type' => 'button',
            'name' => 'create_sitedeployment',
            'icon' => 'fa-plus',
            'css_class' => 'btn',
            'label'=>'Create',
            'event' => 'button:create_sitedeployment:click',
            'acl_module' => 'C_SiteDeployment',
            'acl_action' => 'create',
        ),

    ),

);
