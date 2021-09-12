<?php

$admin_option_defs = array();
$admin_option_defs['DRI_Workflows']['dri_customer_journey_templates'] = array (
    'DRI_Workflow_Templates',
    'LBL_DRI_CUSTOMER_JOURNEY_TEMPLATES_LINK_NAME',
    'LBL_DRI_CUSTOMER_JOURNEY_TEMPLATES_LINK_DESC',
    'javascript:parent.DOTB.App.router.navigate("DRI_Workflow_Templates", {trigger: true});',
);

$admin_option_defs['Administration']['dri_customer_journey_settings'] = array (
    'Administration',
    'LBL_DRI_CUSTOMER_JOURNEY_SETTINGS_LINK_NAME',
    'LBL_DRI_CUSTOMER_JOURNEY_SETTINGS_LINK_DESC',
    'javascript:parent.DOTB.App.router.navigate("DRI_Workflows/layout/configuration", {trigger: true});',
);

$admin_option_defs['Administration']['dri_customer_journey_configure_modules'] = array (
    'Administration',
    'LBL_DRI_CUSTOMER_JOURNEY_CONFIGURE_MODULES_LINK_NAME',
    'LBL_DRI_CUSTOMER_JOURNEY_CONFIGURE_MODULES_LINK_DESC',
    'javascript:parent.DOTB.App.router.navigate("DRI_Workflows/layout/configure-modules", {trigger: true});',
);

$admin_group_header[] = array(
    'LBL_DRI_CUSTOMER_JOURNEY_SETTINGS_TITLE',
    '',
    false,
    $admin_option_defs,
    'LBL_DRI_CUSTOMER_JOURNEY_SETTINGS_DESC',
);
