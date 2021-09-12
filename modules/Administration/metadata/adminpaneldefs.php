<?php


    use Dotbcrm\Dotbcrm\IdentityProvider\Authentication;

    global $current_user, $admin_group_header;

    //users and security.
    $admin_option_defs = array();
    $admin_option_defs['Users']['user_management'] = array('user', 'LBL_MANAGE_USERS_TITLE', 'LBL_MANAGE_USERS', './index.php?module=Users&action=index');
    $admin_option_defs['Users']['roles_management'] = array('sitemap', 'LBL_MANAGE_ROLES_TITLE', 'LBL_MANAGE_ROLES', './index.php?module=ACLRoles&action=index');
    $admin_option_defs['Users']['teams_management'] = array('users', 'LBL_MANAGE_TEAMS_TITLE', 'LBL_MANAGE_TEAMS', './index.php?module=Teams&action=index');

    $idpConfig = new Authentication\Config(\DotbConfig::getInstance());
    $idmModeConfig = $idpConfig->getIDMModeConfig();
    if ($idpConfig->isIDMModeEnabled()) {
        $passwordManagerUrl = $idpConfig->buildCloudConsoleUrl('passwordManagement');
        $passwordManagerTarget = '_blank';
        $passwordManagerOnClick = sprintf(
            'onclick = "app.alert.show(\'disabled-for-idm-mode\', {level: \'warning\', messages: \'%s\'});"',
            $GLOBALS['app_strings']['ERR_DISABLED_FOR_IDM_MODE']
        );
    } else {
        $passwordManagerUrl = './index.php?module=Administration&action=PasswordManager';
        $passwordManagerTarget = '_self';
        $passwordManagerOnClick = null;
    }

    $admin_option_defs['Administration']['password_management'] = array('unlock', 'LBL_MANAGE_PASSWORD_TITLE', 'LBL_MANAGE_PASSWORD', $passwordManagerUrl, null, $passwordManagerOnClick, $passwordManagerTarget,);
    $admin_option_defs['Users']['tba_management'] = array('user-md', 'LBL_TBA_CONFIGURATION', 'LBL_TBA_CONFIGURATION_DESC', './index.php?module=Teams&action=tba');
    $admin_group_header[] = array('LBL_USERS_TITLE', '', false, $admin_option_defs, 'LBL_USERS_DESC');

    //system.
    if ($current_user->id == '1') {
        $admin_option_defs = array();
        $admin_option_defs['Administration']['configphp_settings'] = array('cogs', 'LBL_CONFIGURE_SETTINGS_TITLE', 'LBL_CONFIGURE_SETTINGS', './index.php?module=Configurator&action=EditView');
        $admin_option_defs['Administration']['locale'] = array('globe', 'LBL_MANAGE_LOCALE', 'LBL_LOCALE', './index.php?module=Administration&action=Locale&view=default');
        $admin_option_defs['Administration']['currencies_management'] = array('money-check-edit-alt', 'LBL_MANAGE_CURRENCIES', 'LBL_CURRENCY', 'javascript:parent.DOTB.App.router.navigate("Currencies", {trigger: true});');
        $admin_option_defs['Administration']['languages'] = array('flag', 'LBL_MANAGE_LANGUAGES', 'LBL_LANGUAGES', './index.php?module=Administration&action=Languages&view=default');
        $admin_option_defs['Administration']['repair'] = array('wrench', 'LBL_UPGRADE_TITLE', 'LBL_UPGRADE', './index.php?module=Administration&action=Upgrade');
        $admin_option_defs['Administration']['global_search'] = array('search', 'LBL_GLOBAL_SEARCH_SETTINGS', 'LBL_GLOBAL_SEARCH_SETTINGS_DESC', './index.php?module=Administration&action=GlobalSearchSettings');
        $admin_option_defs['Administration']['connector_settings'] = array('link', 'LBL_CONNECTOR_SETTINGS', 'LBL_CONNECTOR_SETTINGS_DESC', './index.php?module=Connectors&action=ConnectorSettings');
        $admin_option_defs['Administration']['tracker_settings'] = array('download', 'LBL_TRACKER_SETTINGS', 'LBL_TRACKER_SETTINGS_DESC', './index.php?module=Trackers&action=TrackerSettings');
        $admin_option_defs['Administration']['scheduler'] = array('alarm-clock', 'LBL_DOTB_SCHEDULER_TITLE', 'LBL_DOTB_SCHEDULER', './index.php?module=Schedulers&action=index');
        $admin_option_defs['Administration']['pdfmanager'] = array('file-pdf', 'LBL_PDFMANAGER_SETTINGS', 'LBL_PDFMANAGER_SETTINGS_DESC', './index.php?module=PdfManager&action=index');
        $admin_option_defs['Administration']['web_logic_hooks'] = array('random', 'LBL_WEB_LOGIC_HOOKS', 'LBL_WEB_LOGIC_HOOKS_DESC', 'javascript:parent.DOTB.App.router.navigate("WebLogicHooks", {trigger: true});');
        if (DotbOAuthServer::enabled()) {
            $admin_option_defs['Administration']['oauth'] = array('key', 'LBL_OAUTH_TITLE', 'LBL_OAUTH', './index.php?module=OAuthKeys&action=index');
        }
        $admin_group_header[] = array('LBL_ADMINISTRATION_HOME_TITLE', '', false, $admin_option_defs, 'LBL_ADMINISTRATION_HOME_DESC');
    }

    //email manager.

    $admin_option_defs = array();
    $admin_option_defs['Emails']['mass_Email_config'] = array('envelope-open-text', 'LBL_MASS_EMAIL_CONFIG_TITLE', 'LBL_MASS_EMAIL_CONFIG_DESC', './index.php?module=EmailMan&action=config');
    $admin_option_defs['Campaigns']['campaignconfig'] = array('rocket', 'LBL_CAMPAIGN_CONFIG_TITLE', 'LBL_CAMPAIGN_CONFIG_DESC', './index.php?module=EmailMan&action=campaignconfig');
    $admin_option_defs['Emails']['mailboxes'] = array('download', 'LBL_MANAGE_MAILBOX', 'LBL_MAILBOX_DESC', './index.php?module=InboundEmail&action=index');
    $admin_option_defs['Campaigns']['mass_Email'] = array('upload', 'LBL_MASS_EMAIL_MANAGER_TITLE', 'LBL_MASS_EMAIL_MANAGER_DESC', './index.php?module=EmailMan&action=index');
    $admin_option_defs['Emails']['history_contacts_emails'] = array('paperclip', 'LBL_HISTORY_CONTACTS_EMAILS', 'LBL_HISTORY_CONTACTS_EMAILS_DESC', './index.php?module=Configurator&action=historyContactsEmails');
    $admin_option_defs['Campaigns']['register_snip'] = array('envelope', 'LBL_CONFIGURE_SNIP', 'LBL_CONFIGURE_SNIP_DESC', './index.php?module=SNIP&action=ConfigureSnip');
    $admin_group_header[] = array('LBL_EMAIL_TITLE', '', false, $admin_option_defs, 'LBL_EMAIL_DESC');


    //studio.
    if ($current_user->id == '1') {
        $admin_option_defs = array();
        $admin_option_defs['studio']['studio'] = array('magic', 'LBL_STUDIO', 'LBL_STUDIO_DESC', './index.php?module=ModuleBuilder&action=index&type=studio');
        if (isset($GLOBALS['beanFiles']['iFrame'])) {
            $admin_option_defs['Administration']['portal'] = array('iFrames', 'LBL_IFRAME', 'DESC_IFRAME', './index.php?module=iFrames&action=index');
        }
        $admin_option_defs['Administration']['rename_tabs'] = array('edit', 'LBL_RENAME_TABS', 'LBL_CHANGE_NAME_MODULES', "./index.php?action=wizard&module=Studio&wizard=StudioWizard&option=RenameTabs");
        $admin_option_defs['Administration']['moduleBuilder'] = array('puzzle-piece', 'LBL_MODULEBUILDER', 'LBL_MODULEBUILDER_DESC', './index.php?module=ModuleBuilder&action=index&type=mb');
        $admin_option_defs['Administration']['configure_tabs'] = array('eye', 'LBL_CONFIGURE_TABS_AND_SUBPANELS', 'LBL_CONFIGURE_TABS_AND_SUBPANELS_DESC', './index.php?module=Administration&action=ConfigureTabs');
        $admin_option_defs['Administration']['module_loader'] = array('hourglass-end', 'LBL_MODULE_LOADER_TITLE', 'LBL_MODULE_LOADER', './index.php?module=Administration&action=UpgradeWizard&view=module');
        $admin_option_defs['any']['workflow_management'] = array('chart-network', 'LBL_MANAGE_WORKFLOW', 'LBL_WORKFLOW_DESC', './index.php?module=WorkFlow&action=ListView');
        $admin_option_defs['Administration']['api_platforms'] = ['qrcode', 'LBL_CONFIGURE_CUSTOM_API_PLATFORMS', 'LBL_CUSTOM_API_PLATFORMS_DESC', './index.php?module=Administration&action=apiplatforms',];
        $admin_option_defs['Administration']['config_icon_module'] = array('cogs', 'LBL_CONFIG_ICON_MODULE', 'LBL_CONFIG_ICON_MODULE', 'javascript:void(parent.DOTB.App.router.navigate("C_AdminConfig/layout/change_module_icon", {trigger: true}));',);
        $admin_group_header[] = array('LBL_STUDIO_TITLE', '', false, $admin_option_defs, 'LBL_TOOLS_DESC');
    }

    //product catalog.
    $admin_option_defs = array();
    $admin_option_defs['Products']['product_catalog'] = array('th-large', 'LBL_PRODUCTS_TITLE', 'LBL_PRODUCTS', 'javascript:parent.DOTB.App.router.navigate("ProductTemplates", {trigger: true});');
    $admin_option_defs['Products']['product_types'] = array('adjust', 'LBL_PRODUCT_TYPES_TITLE', 'LBL_PRODUCT_TYPES', 'javascript:parent.DOTB.App.router.navigate("ProductTypes", {trigger: true});');
    $admin_option_defs['Products']['product_categories'] = array('folders', 'LBL_PRODUCT_CATEGORIES_TITLE', 'LBL_PRODUCT_CATEGORIES', 'javascript:parent.DOTB.App.router.navigate("ProductCategories", {trigger: true});');
    $admin_option_defs['Quotes']['tax_rates'] = array('badge-percent', 'LBL_TAXRATES_TITLE', 'LBL_TAXRATES', 'javascript:parent.DOTB.App.router.navigate("TaxRates", {trigger: true});');
    $admin_option_defs['Products']['shipping_providers'] = array('truck', 'LBL_SHIPPERS_TITLE', 'LBL_SHIPPERS', 'javascript:parent.DOTB.App.router.navigate("Shippers", {trigger: true});');
    $admin_option_defs['Products']['manufacturers'] = array('building', 'LBL_MANUFACTURERS_TITLE', 'LBL_MANUFACTURERS', 'javascript:parent.DOTB.App.router.navigate("Manufacturers", {trigger: true});');

    $admin_option_defs['Quotes']['units'] = array('box-check', 'LBL_UNIT_TITLE', 'LBL_UNIT_TITLE', 'javascript:parent.DOTB.App.router.navigate("J_Unit", {trigger: true});');
    $admin_option_defs['Quotes']['unit_groups'] = array('boxes', 'LBL_UNIT_GROUP_TITLE', 'LBL_UNIT_GROUP_TITLE', 'javascript:parent.DOTB.App.router.navigate("J_GroupUnit", {trigger: true});');
    $admin_option_defs['Quotes']['discount'] = array('badge-percent', 'LBL_DISCOUNT_TITLE', 'LBL_DISCOUNT_TITLE', 'javascript:parent.DOTB.App.router.navigate("J_Discount", {trigger: true});');
    $admin_option_defs['Quotes']['voucher'] = array('badge-percent', 'LBL_VOUCHER_TITLE', 'LBL_VOUCHER_TITLE', 'javascript:parent.DOTB.App.router.navigate("J_Voucher", {trigger: true});');
    $admin_option_defs['Quotes']['loyalty'] = array('badge-percent', 'LBL_LOYALTY_TITLE', 'LBL_LOYALTY_TITLE', 'javascript:parent.DOTB.App.router.navigate("J_Loyalty", {trigger: true});');
//    $admin_option_defs['Quotes']['quotes_config'] = array('money-check-alt', 'LBL_MANAGE_QUOTES_TITLE', 'LBL_MANAGE_QUOTES', 'javascript:void(parent.DOTB.App.router.navigate("Quotes/config", {trigger: true}));',);
//    $admin_option_defs['Contracts']['contract_type_management'] = array('money-check', 'LBL_MANAGE_CONTRACTEMPLATES_TITLE', 'LBL_CONTRACT_TYPES', 'javascript:parent.DOTB.App.router.navigate("ContractTypes", {trigger: true});');
//    $admin_option_defs['any']['dropdowneditor'] = array('list-ol', 'LBL_DROPDOWN_EDITOR', 'DESC_DROPDOWN_EDITOR', './index.php?module=ModuleBuilder&action=index&type=dropdowns');
	//Add Holiday config
//    $admin_option_defs['Administration']['holidays']=array('calendar','Public Holiday','Set Public Holiday','./index.php?module=Holidays');
	$admin_group_header[] = array('LBL_PRICE_LIST_TITLE', '', false, $admin_option_defs, 'LBL_PRICE_LIST_DESC');

    //pmse
    if ($current_user->id == '1') {
        $admin_option_defs = array(
            'pmse_Project' => array(
                'Settings' => array('cog', 'LBL_PMSE_ADMIN_TITLE_SETTINGS', 'LBL_PMSE_ADMIN_DESC_SETTINGS', 'javascript:parent.DOTB.App.router.navigate("pmse_Inbox/layout/config", {trigger: true});',),
                'CasesList' => array('project-diagram', 'LBL_PMSE_ADMIN_TITLE_CASESLIST', 'LBL_PMSE_ADMIN_DESC_CASESLIST', 'javascript:parent.DOTB.App.router.navigate("pmse_Inbox/layout/casesList", {trigger: true});',),
                'EngineLogs' => array('quote-left', 'LBL_PMSE_ADMIN_TITLE_ENGINELOGS', 'LBL_PMSE_ADMIN_DESC_ENGINELOGS', 'javascript:parent.DOTB.App.router.navigate("pmse_Inbox/layout/logView", {trigger: true});',),
            )
        );
        $admin_group_header [] = array('LBL_PMSE_ADMIN_TITLE_MODULE', '', false, $admin_option_defs, 'LBL_PMSE_ADMIN_DESC_MODULE');
    }

    /**
     * Added by Hieu Pham
     * On 10/03/2019
     * To add send SMS config for admin
     */

    $admin_option_defs = array();
    $admin_option_defs['Administration']['config_sms_gateway'] = array('sms', 'LBL_SMS_GATEWAY_HEADER', "LBL_SMS_GATEWAY_DESCRIPTION", './index.php?module=Administration&action=smsConfig');
    $admin_group_header[] = array('LBL_SMS_CONFIG_HEADER', '', false, $admin_option_defs, 'LBL_SMS_CONFIG_DESCRIPTION');


    if ($current_user->id == '1') {
        $admin_option_defs = array();
        $admin_option_defs['DRI_Workflows']['dri_customer_journey_templates'] = array('copy', 'LBL_DRI_CUSTOMER_JOURNEY_TEMPLATES_LINK_NAME', 'LBL_DRI_CUSTOMER_JOURNEY_TEMPLATES_LINK_DESC', 'javascript:parent.DOTB.App.router.navigate("DRI_Workflow_Templates", {trigger: true});',);
        $admin_option_defs['Administration']['dri_customer_journey_configure_modules'] = array('cog', 'LBL_DRI_CUSTOMER_JOURNEY_CONFIGURE_MODULES_LINK_NAME', 'LBL_DRI_CUSTOMER_JOURNEY_CONFIGURE_MODULES_LINK_DESC', 'javascript:parent.DOTB.App.router.navigate("DRI_Workflows/layout/configure-modules", {trigger: true});',);
        $admin_group_header[] = array('LBL_DRI_CUSTOMER_JOURNEY_SETTINGS_TITLE', '', false, $admin_option_defs, 'LBL_DRI_CUSTOMER_JOURNEY_SETTINGS_DESC',);
    }


    $admin_option_defs = array();
    $admin_option_defs['Administration']['fte_custom_config'] = array('cog', 'LBL_FTE_UT_ACTION_NAME', 'LBL_FTE_UT_ACTION_DESCRIPTION', 'javascript:parent.DOTB.App.router.navigate("fte-config", {trigger: true});',);
    $admin_option_defs['opportunities']['opportunities_setup'] = array('cart-plus', 'LBL_MANAGE_OPPORTUNITIES_TITLE', 'LBL_MANAGE_OPPORTUNITIES_DESC', 'javascript:void(parent.DOTB.App.router.navigate("Opportunities/config", {trigger: true}));');
    $admin_option_defs['Forecasts']['forecast_setup'] = array('user-chart', 'LBL_MANAGE_FORECASTS_TITLE', 'LBL_MANAGE_FORECASTS', 'javascript:void(parent.DOTB.App.router.navigate("Forecasts/config", {trigger: true}));');
    $admin_option_defs['Administration']['default_preset_import'] = array('clipboard', 'LBL_LINK_AUTO_SET_PRESET_IMPORT', 'LBL_LINK_AUTO_SET_PRESET_IMPORT', 'javascript:void(parent.DOTB.App.router.navigate("C_AdminConfig/layout/default-preset-import", {trigger: true}));',);
    $admin_option_defs['Administration']['license'] = array('fingerprint', 'LBL_LICENSE_INFO', 'LBL_LICENSE_INFO', 'javascript:void(parent.DOTB.App.router.navigate("C_AdminConfig/layout/license", {trigger: true}));',);
    $admin_option_defs['Administration']['config_call_center'] = array('phone', 'LBL_CONFIG_CALL_CENTER', 'LBL_CONFIG_CALL_CENTER', 'javascript:void(parent.DOTB.App.router.navigate("C_AdminConfig/layout/callcenter_config", {trigger: true}));',);
    $admin_option_defs['Administration']['translate_languages'] = array('language', 'LBL_TRANSLATE_LANGUAGE', 'LBL_TRANSLATE_LANGUAGE', 'javascript:void(parent.DOTB.App.router.navigate("C_AdminConfig/layout/translate_languages", {trigger: true}));',);
    $admin_group_header[] = array('LBL_FTE_UT_SECTION_HEADER', '', false, $admin_option_defs, 'LBL_FTE_UT_SECTION_DESCRIPTION');

/**
 * servey
 */
$admin_option_defs = array();
$admin_option_defs['Administration']['healty_check'] = array('rocket', 'LBL_HEALTH_CHECK', 'LBL_HEALTH_CHECK_DESC', 'index.php?module=Administration&action=health_check');
$admin_option_defs['Administration']['survey_automizer'] = array('rocket', 'LBL_SURVEY_AUTOMIZER', 'LBL_SURVEY_AUTOMIZER_DESC', 'javascript:parent.DOTB.App.router.navigate("bc_survey_automizer", {trigger: true});');
$admin_option_defs['Administration']['survey_smtp'] = array('rocket', 'LBL_SURVEY_SMTP_SETTING', 'LBL_SURVEY_SMTP_SETTING_DESC', 'index.php?module=Administration&action=surveysmtp');
$admin_option_defs['Administration']['survey_sms'] = array('rocket', 'LBL_SURVEY_SMS_SETTING', 'LBL_SURVEY_SMS_SETTING_DESC', 'index.php?module=Administration&action=surveysms');
$admin_group_header[] = array('LBL_SURVEY_CONF_TITLE', '', false, $admin_option_defs, 'LBL_SURVEY_LICENSE_CONFIGURATION_TITLE');

    //For users with MLA access we need to find which entries need to be shown.
    //lets process the $admin_group_header and apply all the access control rules.
    $access = $current_user->getDeveloperModules();
    foreach ($admin_group_header as $key => $values) {
        $module_index = array_keys($values[3]);  //get the actual links..
        foreach ($module_index as $mod_key => $mod_val) {
            if (is_admin($current_user) ||
            in_array($mod_val, $access) ||
            $mod_val == 'studio' ||
            ($mod_val == 'Forecasts') ||
            ($mod_val == 'any')
            ) {
                if (!is_admin($current_user) && isset($values[3]['Administration'])) {
                    unset($values[3]['Administration']);
                }
                if (displayStudioForCurrentUser() == false) {
                    unset($values[3]['studio']);
                }

                if (displayWorkflowForCurrentUser() == false) {
                    unset($values[3]['any']['workflow_management']);
                }

                // Need this check because Quotes and Products share the header group
                if (!in_array('Quotes', $access) && isset($values[3]['Quotes'])) {
                    unset($values[3]['Quotes']);
                }
                if (!in_array('Products', $access) && isset($values[3]['Products'])) {
                    unset($values[3]['Products']);
                }

                // Need this check because Emails and Campaigns share the header group
                if (!in_array('Campaigns', $access) && isset($values[3]['Campaigns'])) {
                    unset($values[3]['Campaigns']);
                }

                // Unless a user is a system admin, or module admin, they cannot see Forecasts config links
                if ($mod_val == 'Forecasts'
                && !($current_user->isAdmin() || $current_user->isDeveloperForModule('Forecasts'))
                && isset($values[3]['Forecasts'])) {
                    unset($admin_group_header[$key][3][$mod_val]);
                }
                // Unless a user is a system admin, or module admin, they cannot see TBACLs config links
                if ($mod_val == 'Users'
                && !$current_user->isAdminForModule('Users')
                && isset($values[3]['Users']['tba_management'])
                ) {
                    unset($admin_group_header[$key][3][$mod_val]['tba_management']);
                }

                // Maintain same access for Opps as we have for Forecasts
                // Unless a user is a system admin, or module admin, they cannot see Forecasts config links
                if ($mod_val == 'Opportunities'
                && !($current_user->isAdmin() || $current_user->isDeveloperForModule('Opportunities'))
                && isset($values[3]['Opportunities'])) {
                    unset($admin_group_header[$key][3][$mod_val]);
                }

            } else {
                //hide the link
                unset($admin_group_header[$key][3][$mod_val]);
            }

        }
    }
?>
