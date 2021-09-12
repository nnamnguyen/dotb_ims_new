<?php
//add by TKT 27-2-2019
$admin_option_defs = array();
$admin_option_defs['Administration']['default_preset_import'] = array(
    'Administration',
    'LBL_LINK_AUTO_SET_PRESET_IMPORT',
    'LBL_LINK_AUTO_SET_PRESET_IMPORT',
    'javascript:void(parent.DOTB.App.router.navigate("C_AdminConfig/layout/default-preset-import", {trigger: true}));',
);
$admin_group_header[] = array('LBL_SECTION_GENERAL_SETTING', '', false, $admin_option_defs, 'LBL_SECTION_GENERAL_SETTING');