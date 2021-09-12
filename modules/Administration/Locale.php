<?php



global $current_user, $dotb_config;
if (!is_admin($current_user)) {
    dotb_die("Unauthorized access to administration.");
}



echo getClassicModuleTitle(
    "Administration",
    array(
        "<a href='index.php?module=Administration&action=index'>" . translate(
            'LBL_MODULE_NAME',
            'Administration'
        ) . "</a>",
        $mod_strings['LBL_MANAGE_LOCALE'],
    ),
    false
);

$cfg = new Configurator();
$dotb_smarty = new Dotb_Smarty();
$errors = array();

///////////////////////////////////////////////////////////////////////////////
////	HANDLE CHANGES
if (isset($_REQUEST['process']) && $_REQUEST['process'] == 'true') {

    $previousDefaultLanguage = $dotb_config['default_language'];

    if (isset($_REQUEST['collation']) && !empty($_REQUEST['collation'])) {
        //kbrill Bug #14922
        if (array_key_exists(
                'collation',
                $dotb_config['dbconfigoption']
            ) && $_REQUEST['collation'] != $dotb_config['dbconfigoption']['collation']
        ) {
            $GLOBALS['db']->disconnect();
            $GLOBALS['db']->connect();
        }

        $GLOBALS['db']->setCollation($_REQUEST['collation']);
        $cfg->config['dbconfigoption']['collation'] = $_REQUEST['collation'];
    }
    $cfg->populateFromPost();
    $cfg->handleOverride();
    if ($locale->invalidLocaleNameFormatUpgrade()) {
        $locale->removeInvalidLocaleNameFormatUpgradeNotice();
    }

    // Metadata sections that have to be refreshed on `Save`.
    $refreshSections = array(
        MetaDataManager::MM_CURRENCIES,
        MetaDataManager::MM_LABELS,
        MetaDataManager::MM_ORDEREDLABELS,
    );
    $mm = MetaDataManager::getManager();
    $mm->refreshSectionCache($refreshSections);

    // Call `ping` API to refresh the metadata.
    echo "
        <script>
        var app = window.parent.DOTB.App;
        app.api.call('read', app.api.buildURL('ping'));
        app.router.navigate('#bwc/index.php?module=Administration&action=index', {trigger:true, replace:true});
        </script>
    ";
} else {

///////////////////////////////////////////////////////////////////////////////
////	DB COLLATION
    $collationOptions = $GLOBALS['db']->getCollationList();
    if (!empty($collationOptions)) {
        if (!isset($dotb_config['dbconfigoption']['collation'])) {
            $dotb_config['dbconfigoption']['collation'] = $GLOBALS['db']->getDefaultCollation();
        }
        $dotb_smarty->assign(
            'collationOptions',
            get_select_options_with_id(
                array_combine($collationOptions, $collationOptions),
                $dotb_config['dbconfigoption']['collation']
            )
        );
    }
////	END DB COLLATION
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
////	PAGE OUTPUT
    $dotb_smarty->assign('MOD', $mod_strings);
    $dotb_smarty->assign('APP', $app_strings);
    $dotb_smarty->assign('APP_LIST', $app_list_strings);
    $dotb_smarty->assign('LANGUAGES', get_languages());
    $dotb_smarty->assign("JAVASCRIPT", get_set_focus_js());
    $dotb_smarty->assign('config', $dotb_config);
    $dotb_smarty->assign('error', $errors);
    $dotb_smarty->assign(
        "exportCharsets",
        get_select_options_with_id($locale->getCharsetSelect(), $dotb_config['default_export_charset'])
    );

    $dotb_smarty->assign('NAMEFORMATS', $locale->getUsableLocaleNameOptions($dotb_config['name_formats']));

    if ($locale->invalidLocaleNameFormatUpgrade()) {
        $dotb_smarty->assign('upgradeInvalidLocaleNameFormat', 'bad name format upgrade');
    } else {
        $dotb_smarty->clear_assign('upgradeInvalidLocaleNameFormat');
    }

    $dotb_smarty->assign('getNameJs', $locale->getNameJs());

    $dotb_smarty->display('modules/Administration/Locale.tpl');

}
