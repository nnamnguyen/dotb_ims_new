<?php


use Dotbcrm\Dotbcrm\IdentityProvider\Authentication;

/**
 * This helper handles the rest of the fields for the Users Edit and Detail views.
 * There are a lot of fields on those views that do not map directly to being used on the metadata based UI, so they are handled here.
 */
class UserViewHelper {
    /**
     * The smarty template handler for the template
     * @var DotbSmarty
     */
    protected $ss;
    /**
     * The bean that we are viewing.
     * @var DotbBean
     */
    protected $bean;
    /**
     * What type of view we are looking at, valid values are 'EditView' and 'DetailView'
     * @var string
     */
    protected $viewType;
    /**
     * Is the current user an admin for the Users module
     * @var bool
     */
    protected $is_current_admin;
    /**
     * Is the current user a system wide admin
     * @var bool
     */
    protected $is_super_admin;
    /**
     * The current user type
     * One of: REGULAR ADMIN GROUP PORTAL_ONLY
     * @var string
     */
    public $usertype;


    /**
     * Constructor, pass in the smarty template, the bean and the viewtype
     */
    public function __construct(Dotb_Smarty &$smarty, DotbBean &$bean, $viewType = 'EditView' ) {
        $this->ss = $smarty;
        $this->bean = $bean;
        $this->viewType = $viewType;
    }

    /**
     * Factory method with custom override capability
     *
     * @param Dotb_Smarty $smarty Smarty template object
     * @param DotbBean $bean Bean context
     * @param string $viewType View type as in 'EditView', 'DetailView', ...
     * @return UserViewHelper
     */
    public static function create(Dotb_Smarty $smarty, DotbBean $bean, $viewType)
    {
        DotbAutoLoader::requireWithCustom('modules/Users/UserViewHelper.php', true);
        $className = DotbAutoLoader::customClass('UserViewHelper');
        return new $className($smarty, $bean, $viewType);
    }

    /**
     * This function populates the smarty class that was passed in through the constructor
     */
    public function setupAdditionalFields() {
        $this->assignUserTypes();
        $this->setupButtonsAndTabs();
        $this->setupUserTypeDropdown();
        $this->setupPasswordTab();
        $this->setupEmailSettings();
        $this->setupAdvancedTab();

    }

    protected function assignUserTypes() {
        global $current_user, $app_list_strings;

        // There is a lot of extra stuff that needs to go in here to properly render
        $this->is_current_admin=is_admin($current_user)
            ||$current_user->isAdminForModule('Users');
        $this->is_super_admin = is_admin($current_user);

        $this->usertype='REGULAR';
        if($this->is_super_admin){
            $this->usertype='Administrator';
        }


        // check if the user has access to the User Management
        $this->ss->assign('USER_ADMIN',$current_user->isAdminForModule('Users')&& !is_admin($current_user));


        if ($this->is_current_admin) {
            $this->ss->assign('IS_ADMIN','1');
        } else {
            $this->ss->assign('IS_ADMIN', '0');
        }

        if ($this->is_super_admin) {
            $this->ss->assign('IS_SUPER_ADMIN','1');
        } else {
            $this->ss->assign('IS_SUPER_ADMIN', '0');
        }

        $this->ss->assign('IS_PORTALONLY', '0');
        if((!empty($this->bean->portal_only) && $this->bean->portal_only) || (isset($_REQUEST['usertype']) && $_REQUEST['usertype']=='portal')){
            $this->ss->assign('IS_PORTALONLY', '1');
            $this->usertype='PORTAL_ONLY';
        }
        $this->ss->assign('IS_GROUP', '0');
        if((!empty($this->bean->is_group) && $this->bean->is_group)  || (isset($_REQUEST['usertype']) && $_REQUEST['usertype']=='group')){
            $this->ss->assign('IS_GROUP', '1');
            $this->usertype='GROUP';
        }



        $edit_self = $current_user->id == $this->bean->id;
        $admin_edit_self = is_admin($current_user) && $edit_self;


        $this->ss->assign('IS_FOCUS_ADMIN', is_admin($this->bean));

        if($edit_self) {
            $this->ss->assign('EDIT_SELF','1');
        }
        if($admin_edit_self) {
            $this->ss->assign('ADMIN_EDIT_SELF','1');
        }

    }

    protected function setupButtonsAndTabs() {
        global $current_user;

        if (isset($GLOBALS['dotb_config']['show_download_tab'])) {
            $enable_download_tab = $GLOBALS['dotb_config']['show_download_tab'];
        }else{
            $enable_download_tab = true;
        }

        $this->ss->assign('SHOW_DOWNLOADS_TAB', $enable_download_tab);

        $the_query_string = 'module=Users&action=DetailView';
        if(isset($_REQUEST['record'])) {
            $the_query_string .= '&record='.$_REQUEST['record'];
        }
        $buttons_header = array();
        $buttons_footer = array();
        if (!$this->bean->is_group){
            if ($this->bean->id == $current_user->id) {
                $reset_pref_warning = translate('LBL_RESET_PREFERENCES_WARNING','Users');
            }
            else {
                $reset_pref_warning = translate('LBL_RESET_PREFERENCES_WARNING_USER','Users');
            }

            //bug 48170
            $user_preference_url = "module=Users&action=resetPreferences";
            if (isset($_REQUEST['record'])
                && ($_REQUEST['record'] == $current_user->id || $current_user->isAdminForModule('Users'))
            ) {
                $user_preference_url .= "&record=".$_REQUEST['record'];
                $buttons_header[]="<input type='button' class='button' id='reset_user_preferences_header' onclick='if(confirm(\"{$reset_pref_warning}\"))window.location=\"".$_SERVER['PHP_SELF'] .'?'.$user_preference_url."&reset_preferences=true\";' value='".translate('LBL_RESET_PREFERENCES','Users')."' />";
                $buttons_footer[]="<input type='button' class='button' id='reset_user_preferences_footer' onclick='if(confirm(\"{$reset_pref_warning}\"))window.location=\"".$_SERVER['PHP_SELF'] .'?'.$user_preference_url."&reset_preferences=true\";' value='".translate('LBL_RESET_PREFERENCES','Users')."' />";
            }
        }
        //Add Button Log In as Another User - By Lap Nguyen
        if (!$this->bean->portal_only && !$this->bean->is_group && is_admin($current_user) && ($this->bean->id != $current_user->id)){
                $lsTitle = translate('LBL_LOGIN_AS','Users').$this->bean->user_name;
                $lsWarning = translate('LBL_LOGIN_AS_WARNING_USER','Users').$this->bean->user_name.' ?';
                $lsUrl = $_SERVER['PHP_SELF']."?module=Users&action=impersonateUser&record=".$_REQUEST['record'];

                $buttons_header[]="<input type='button' class='button' id='login_as_header' onclick='if(confirm(\"$lsWarning\"))window.location=\"$lsUrl\";' value='$lsTitle' title='$lsTitle' />";
                $buttons_footer[]="<input type='button' class='button' id='login_as_footer' onclick='if(confirm(\"$lsWarning\"))window.location=\"$lsUrl\";' value='$lsTitle' title='$lsTitle' />";

        }
        //END - By Lap Nguyen

        if (isset($buttons_header)) $this->ss->assign("BUTTONS_HEADER", $buttons_header);
        if (isset($buttons_footer)) $this->ss->assign("BUTTONS_FOOTER", $buttons_footer);



        if (isset($this->bean->id)) {
            $this->ss->assign('ID',$this->bean->id);
        }

    }


    /**
     * setupUserTypeDropdown
     *
     * This function handles setting up the user type dropdown field.  It determines which user types are available for the current user.
     * At the end of the function two Smarty variables (USER_TYPE_DROPDOWN and USER_TYPE_READONLY) are assigned.
     *
     */
    public function setupUserTypeDropdown() {
        global $current_user;


        //if this is an existing bean and the type is empty, then populate user type
        if(!empty($this->bean->id) && empty($this->bean->user_type))
	    {
            $this->setUserType($this->bean);
            $userType = $this->bean->user_type;
        } else {
            $userType = $this->usertype;
        }

        $availableUserTypes = array();
        $userTypes = array(
            'RegularUser' => array(
                'label' => translate('LBL_REGULAR_USER','Users'),
                'description' => translate('LBL_REGULAR_DESC','Users'),
            ),
            'GROUP' => array(
                'label' => translate('LBL_GROUP_USER','Users'),
                'description' => translate('LBL_GROUP_DESC','Users'),
            ),
            'PORTAL_ONLY' => array(
                'label' => translate('LBL_PORTAL_ONLY_USER','Users'),
                'description' => translate('LBL_PORTAL_ONLY_DESC','Users'),
            ),
            'Administrator' => array(
                'label' => translate('LBL_ADMIN_USER','Users'),
                'description' => translate('LBL_ADMIN_DESC','Users'),
            ),
        );

        if ( $userType == 'GROUP' || $userType == 'PORTAL_ONLY' ) {
            $availableUserTypes = array($this->usertype);
        } else {
            if ( $this->ss->get_template_vars('USER_ADMIN') ) {
                $availableUserTypes = array('RegularUser');
            } elseif($this->ss->get_template_vars('ADMIN_EDIT_SELF')) {
                $availableUserTypes = array('Administrator');
            } elseif($this->ss->get_template_vars('IS_SUPER_ADMIN')) {
                $availableUserTypes = array(
                    'RegularUser',
                    'Administrator',
                    );
            } else {
                $availableUserTypes = array($userType);
            }
        }

        $userTypeDropdown = '<select id="UserType" name="UserType" onchange="user_status_display(this);" ';
        if ( count($availableUserTypes) == 1 ) {
            $userTypeDropdown .= ' disabled ';
        }
        $userTypeDropdown .= '>';

        $userTypeDescription = '';

        $setSelected = !empty($this->bean->id);

        foreach ( $availableUserTypes as $currType ) {
            if ($setSelected && $currType == $userType ) {
                $userTypeDropdown .= '<option value="'.$currType.'" SELECTED>'.$userTypes[$currType]['label'].'</option>';
            } else {
                $userTypeDropdown .= '<option value="'.$currType.'">'.$userTypes[$currType]['label'].'</option>';
            }
        }
        $userTypeDropdown .= '</select><div id="UserTypeDesc">&nbsp;</div>';

        $this->ss->assign('USER_TYPE_DROPDOWN',$userTypeDropdown);
        $this->ss->assign('USER_TYPE_READONLY',$userTypes[$userType]['label'] . "<input type='hidden' id='UserType' value='{$userType}'><div id='UserTypeDesc'>&nbsp;</div>");

    }

    protected function setupPasswordTab() {
        global $current_user;

        $this->ss->assign('PWDSETTINGS', isset($GLOBALS['dotb_config']['passwordsetting']) ? $GLOBALS['dotb_config']['passwordsetting'] : array());
        if ( isset($GLOBALS['dotb_config']['passwordsetting']) && isset($GLOBALS['dotb_config']['passwordsetting']['customregex']) ) {
            $pwd_regex=str_replace( "\\","\\\\",$GLOBALS['dotb_config']['passwordsetting']['customregex']);
            $this->ss->assign("REGEX",$pwd_regex);
        }


        $enable_syst_generate_pwd=false;
        if(isset($GLOBALS['dotb_config']['passwordsetting']) && isset($GLOBALS['dotb_config']['passwordsetting']['SystemGeneratedPasswordON'])){
            $enable_syst_generate_pwd=$GLOBALS['dotb_config']['passwordsetting']['SystemGeneratedPasswordON'];
        }

        // If new regular user without system generated password or new portal user
        if (((isset($enable_syst_generate_pwd) && !$enable_syst_generate_pwd && $this->usertype!='GROUP') ||
        $this->usertype =='PORTAL_ONLY') && (empty($this->bean->id) || (isset($_REQUEST['Duplicate']) &&
        $_REQUEST['Duplicate'] == "Copy"))) {
            $this->ss->assign('REQUIRED_PASSWORD','1');
        } else {
            $this->ss->assign('REQUIRED_PASSWORD','0');
        }

        // If my account page or portal only user or regular user without system generated password or a duplicate user
        $idpConfig = new Authentication\Config(\DotbConfig::getInstance());
        if ((($current_user->id == $this->bean->id)
                        || $this->usertype=='PORTAL_ONLY'
                        || (($this->usertype=='REGULAR'
                            || $this->usertype == 'Administrator'
                            || (isset($_REQUEST['isDuplicate'])
                                && $_REQUEST['isDuplicate'] == 'true'
                                && $this->usertype!='GROUP'))
                            && !$enable_syst_generate_pwd)
                )
                && !$this->bean->external_auth_only
                && !$idpConfig->isIDMModeEnabled()) {
            $this->ss->assign('CHANGE_PWD', '1');
        } else {
            $this->ss->assign('CHANGE_PWD', '0');
        }

        if (User::isTrialDemoUser($this->bean->user_name)) {
            $this->ss->assign('DISABLED', 'disabled');
        } else {
            $this->ss->assign('DISABLED', '');
        }

        // Make sure group users don't get a password change prompt
        if ( $this->usertype == 'GROUP' ) {
            $this->ss->assign('CHANGE_PWD', '0');
        }

        $configurator = new Configurator();
        if ( isset($configurator->config['passwordsetting'])
             && ($configurator->config['passwordsetting']['SystemGeneratedPasswordON']
                 || $configurator->config['passwordsetting']['forgotpasswordON'])
             && $this->usertype != 'GROUP' && $this->usertype != 'PORTAL_ONLY' ) {
            $this->ss->assign('REQUIRED_EMAIL_ADDRESS','1');
        } else {
            $this->ss->assign('REQUIRED_EMAIL_ADDRESS','0');
        }
        if($this->usertype=='GROUP' || $this->usertype=='PORTAL_ONLY') {
            $this->ss->assign('HIDE_FOR_GROUP_AND_PORTAL', 'none');
            $this->ss->assign('HIDE_CHANGE_USERTYPE','none');
        } else {
            $this->ss->assign('HIDE_FOR_NORMAL_AND_ADMIN','none');
            if (!$this->is_current_admin) {
                $this->ss->assign('HIDE_CHANGE_USERTYPE','none');
            } else {
                $this->ss->assign('HIDE_STATIC_USERTYPE','none');
            }
        }

    }

    protected function setupAdvancedTab() {
        $this->setupAdvancedTabUserSettings();
        $this->setupAdvancedTabTeamSettings();
        $this->setupAdvancedTabNavSettings();
        $this->setupAdvancedTabLocaleSettings();
        $this->setupAdvancedTabPdfSettings();
    }

    protected function setupAdvancedTabUserSettings()
    {
        global $current_user, $locale, $app_strings, $app_list_strings, $dotb_config;
        // This is for the "Advanced" tab, it's not controlled by the metadata UI so we have to do more for it.

        $this->ss->assign('EXPORT_DELIMITER', $this->bean->getPreference('export_delimiter'));

        if($this->bean->receive_notifications ||(!isset($this->bean->id) && $admin->settings['notify_send_by_default'])) $this->ss->assign("RECEIVE_NOTIFICATIONS", "checked");

        //jc:12293 - modifying to use the accessor method which will translate the
        //available character sets using the translation files
        $export_charset = $locale->getExportCharset('', $this->bean);
        $export_charset_options = $locale->getCharsetSelect();
        $this->ss->assign('EXPORT_CHARSET', get_select_options_with_id($export_charset_options, $export_charset));
        $this->ss->assign('EXPORT_CHARSET_DISPLAY', $export_charset);
        //end:12293

        if( $this->bean->getPreference('use_real_names') == 'on'
            || ( empty($this->bean->id)
                 && isset($GLOBALS['dotb_config']['use_real_names'])
                 && $GLOBALS['dotb_config']['use_real_names']
                 && $this->bean->getPreference('use_real_names') != 'off') ) {
            $this->ss->assign('USE_REAL_NAMES', 'CHECKED');
        }

        if($this->bean->getPreference('mailmerge_on') == 'on') {
            $this->ss->assign('MAILMERGE_ON', 'checked');
        }

        $reminder_time = $this->bean->getPreference('reminder_time');
        if (empty($reminder_time)) {
            $reminder_time = -1;
        }
        $email_reminder_time = $this->bean->getPreference('email_reminder_time');
        if (empty($email_reminder_time)) {
            $email_reminder_time = -1;
        }

        $this->ss->assign("REMINDER_TIME_OPTIONS", $app_list_strings['reminder_time_options']);
        $this->ss->assign("EMAIL_REMINDER_TIME_OPTIONS", $app_list_strings['reminder_time_options']);
        $this->ss->assign("REMINDER_TIME", $reminder_time);
        $this->ss->assign("EMAIL_REMINDER_TIME", $email_reminder_time);
        $this->ss->assign("REMINDER_TABINDEX", "12");

        $publish_key = $this->bean->getPreference('calendar_publish_key' );
        $this->ss->assign('CALENDAR_PUBLISH_KEY', $publish_key);

        $publish_url = $dotb_config['site_url'].'/vcal_server.php';
        $token = "/";
        //determine if the web server is running IIS
        //if so then change the publish url
        if(isset($_SERVER) && !empty($_SERVER['SERVER_SOFTWARE'])){
            $position = strpos(strtolower($_SERVER['SERVER_SOFTWARE']), 'iis');
            if($position !== false){
                $token = '?parms=';
            }
        }

        $publish_url .= $token."type=vfb&source=outlook&key=<span id=\"cal_pub_key_span\">$publish_key</span>";
        if (! empty($this->bean->email1)) {
            $publish_url .= '&email='.$this->bean->email1;
        } else {
            $publish_url .= '&user_name='.$this->bean->user_name;
        }

        $ical_url = $dotb_config['site_url']."/ical_server.php?type=ics&key=<span id=\"ical_pub_key_span\">$publish_key</span>&user_id=".$this->bean->id;

        $this->ss->assign("CALENDAR_PUBLISH_URL", $publish_url);
        $this->ss->assign("CALENDAR_SEARCH_URL", $dotb_config['site_url']."/vcal_server.php/type=vfb&key=<span id=\"search_pub_key_span\">$publish_key</span>&email=%NAME%@%SERVER%");
        $this->ss->assign("CALENDAR_ICAL_URL", $ical_url);


        $this->ss->assign("SETTINGS_URL", $dotb_config['site_url']);

    }

    protected function setupAdvancedTabTeamSettings() {
        global $dotb_config;

        $authclass = '';
        if(!empty($dotb_config['authenticationClass'])){
            $this->ss->assign('EXTERNAL_AUTH_CLASS_1', $dotb_config['authenticationClass']);
            $this->ss->assign('EXTERNAL_AUTH_CLASS', $dotb_config['authenticationClass']);
            $authclass = $dotb_config['authenticationClass'];
        }else{
            if(!empty($GLOBALS['system_config']->settings['system_ldap_enabled'])){
                $this->ss->assign('EXTERNAL_AUTH_CLASS_1', translate('LBL_LDAP','Users'));
                $this->ss
                        ->assign('EXTERNAL_AUTH_CLASS', translate('LBL_LDAP_AUTHENTICATION','Users'));
                $authclass = 'IdMLDAPAuthenticate';
            }
        }
        if(!empty($this->bean->external_auth_only)) {
            $this->ss->assign('EXTERNAL_AUTH_ONLY_CHECKED', 'CHECKED');
        }

        if($this->is_super_admin && !empty($authclass)) {
            $this->ss->assign('DISPLAY_EXTERNAL_AUTH',true);
        }

        if(!empty($this->bean->id)) {

            // Display only the teams the user we're editing belongs to
            $teamsWidget = new EmailDotbFieldTeamsetCollection($this->bean, $this->bean->field_defs, 'get_non_private_teams_array', $this->viewType);
            $teamsWidget->user_id = $this->bean->id;

            $this->ss->assign('DEFAULT_TEAM_OPTIONS', $teamsWidget->get_code());

            $this->ss->assign("DEFAULT_TEAM_LIST", TeamSetManager::getFormattedTeamsFromSet($this->bean, true));
        }

        $this->ss->assign('SHOW_TEAM_SELECTION', !empty($this->bean->id));
        $this->ss->assign('IS_PORTALONLY', '0');

        if (isset($dotb_config['enable_web_services_user_creation']) && $dotb_config['enable_web_services_user_creation'] &&
            (!empty($this->bean->portal_only) && $this->bean->portal_only) || (isset($_REQUEST['usertype']) && $_REQUEST['usertype']=='portal')) {
            $this->ss->assign('IS_PORTALONLY', '1');
            $this->usertype='PORTAL_ONLY';
        }
    }

    protected function setupAdvancedTabNavSettings() {
        global $app_list_strings;

        /* Module Tab Chooser */
        require_once('include/templates/TemplateGroupChooser.php');
        $chooser = new TemplateGroupChooser();
        $controller = new TabController();


        if($this->is_current_admin || $controller->get_users_can_edit()) {
            $chooser->display_hide_tabs = true;
        } else {
            $chooser->display_hide_tabs = false;
        }

        $chooser->args['id'] = 'edit_tabs';
        $chooser->args['values_array'] = $controller->get_tabs($this->bean);
        //Remove 'Home' module from tab configuration UI (we add it back in at top of display tabs on save)
        if(isset($chooser->args['values_array'][0]['Home'])){
            unset($chooser->args['values_array'][0]['Home']);
        }
        if(isset($chooser->args['values_array'][1]['Home'])){
            unset($chooser->args['values_array'][1]['Home']);
        }
        if(isset($chooser->args['values_array'][2]['Home'])){
            unset($chooser->args['values_array'][2]['Home']);
        }

        foreach($chooser->args['values_array'][0] as $key=>$value) {
            $chooser->args['values_array'][0][$key] = $app_list_strings['moduleList'][$key];
        }

        foreach($chooser->args['values_array'][1] as $key=>$value) {
            $chooser->args['values_array'][1][$key] = $app_list_strings['moduleList'][$key];
        }

        foreach($chooser->args['values_array'][2] as $key=>$value) {
            $chooser->args['values_array'][2][$key] = $app_list_strings['moduleList'][$key];
        }

        $chooser->args['left_name'] = 'display_tabs';
        $chooser->args['right_name'] = 'hide_tabs';

        $chooser->args['left_label'] =  translate('LBL_DISPLAY_TABS','Users');
        $chooser->args['right_label'] =  translate('LBL_HIDE_TABS','Users');
        require_once('include/DotbSmarty/plugins/function.dotb_help.php');
        $chooser->args['title'] =  translate('LBL_EDIT_TABS','Users').smarty_function_dotb_help(array("text"=>translate('LBL_CHOOSE_WHICH','Users')),$ss);

        $this->ss->assign('TAB_CHOOSER', $chooser->display());
        $this->ss->assign('CHOOSER_SCRIPT','set_chooser();');
        $this->ss->assign('CHOOSE_WHICH', translate('LBL_CHOOSE_WHICH','Users'));

    }

    protected function setupAdvancedTabLocaleSettings() {
        global $locale, $dotb_config, $app_list_strings;

        ///////////////////////////////////////////////////////////////////////////////
        ////	LOCALE SETTINGS
        ////	Date/time format
        $dformat = $locale->getPrecedentPreference($this->bean->id?'datef':'default_date_format', $this->bean);
        $tformat = $locale->getPrecedentPreference($this->bean->id?'timef':'default_time_format', $this->bean);
        $nformat = $locale->getPrecedentPreference('default_locale_name_format', $this->bean);
        if (!array_key_exists($nformat, $dotb_config['name_formats'])) {
            $nformat = $dotb_config['default_locale_name_format'];
        }
        $timeOptions = get_select_options_with_id($dotb_config['time_formats'], $tformat);
        $dateOptions = get_select_options_with_id($dotb_config['date_formats'], $dformat);
        $nameOptions = get_select_options_with_id($locale->getUsableLocaleNameOptions($dotb_config['name_formats']), $nformat);
        $this->ss->assign('TIMEOPTIONS', $timeOptions);
        $this->ss->assign('DATEOPTIONS', $dateOptions);
        $this->ss->assign('NAMEOPTIONS', $nameOptions);
        $this->ss->assign('DATEFORMAT', $dotb_config['date_formats'][$dformat]);
        $this->ss->assign('TIMEFORMAT', $dotb_config['time_formats'][$tformat]);
        $this->ss->assign('NAMEFORMAT', $dotb_config['name_formats'][$nformat]);

        //// Timezone
        if(empty($this->bean->id)) { // remove default timezone for new users(set later)
            $this->bean->user_preferences['timezone'] = '';
        }

        $userTZ = $this->bean->getPreference('timezone');

        if(empty($userTZ) && !$this->bean->is_group && !$this->bean->portal_only) {
            $userTZ = TimeDate::guessTimezone();
            $this->bean->setPreference('timezone', $userTZ);
        }

        if(!$this->bean->getPreference('ut')) {
            $this->ss->assign('PROMPTTZ', '');
        }
        $this->ss->assign('TIMEZONE_CURRENT', $userTZ);
        $this->ss->assign('TIMEZONEOPTIONS', TimeDate::getTimezoneList());
        $this->ss->assign("TIMEZONE", TimeDate::tzName($userTZ));


        // FG - Bug 4236 - Managed First Day of Week
        $fdowDays = array();
        foreach ($app_list_strings['dom_cal_day_long'] as $d) {
            if ($d != "") {
                $fdowDays[] = $d;
            }
        }
        $this->ss->assign("FDOWOPTIONS", $fdowDays);
        $currentFDOW = $this->bean->get_first_day_of_week();

        if (!isset($currentFDOW)) {$currentFDOW = 1;}
        $this->ss->assign("FDOWCURRENT", $currentFDOW);
        $this->ss->assign("FDOWDISPLAY", $fdowDays[$currentFDOW]);

        //// Numbers and Currency display
        $currency = new ListCurrency();

        // 10/13/2006 Collin - Changed to use Localization.getConfigPreference
        // This was the problem- Previously, the "-99" currency id always assumed
        // to be defaulted to US Dollars.  However, if someone set their install to use
        // Euro or other type of currency then this setting would not apply as the
        // default because it was being overridden by US Dollars.
        $cur_id = $locale->getPrecedentPreference('currency', $this->bean);
        if($cur_id) {
            $selectCurrency = $currency->getSelectOptions($cur_id);
            $this->ss->assign("CURRENCY", $selectCurrency);
        } else {
            $selectCurrency = $currency->getSelectOptions();
            $this->ss->assign("CURRENCY", $selectCurrency);
        }

        // convert base currency values to user preferred
        $this->ss->assign("currency_show_preferred", $locale->getPrecedentPreference('currency_show_preferred', $this->bean));
        $this->ss->assign(
            "currency_create_in_preferred",
            $locale->getPrecedentPreference('currency_create_in_preferred', $this->bean)
        );

        $currencyList = array();
        foreach($locale->currencies as $id => $val ) {
            $currencyList[$id] = $val['symbol'];
        }
        $currencySymbolJSON = json_encode($currencyList);
        $this->ss->assign('currencySymbolJSON', $currencySymbolJSON);

        $currencyDisplay = BeanFactory::newBean('Currencies');
        if(isset($cur_id) ) {
            $currencyDisplay->retrieve($cur_id);
            $this->ss->assign('CURRENCY_DISPLAY', $currencyDisplay->iso4217 .' '.$currencyDisplay->symbol );
        } else {
            $this->ss->assign("CURRENCY_DISPLAY", $currencyDisplay->getDefaultISO4217() .' '.$currencyDisplay->getDefaultCurrencySymbol() );
        }

        // fill significant digits dropdown
        $significantDigits = $locale->getPrecedentPreference('default_currency_significant_digits', $this->bean);
        $sigDigits = '';
        for($i=0; $i<=6; $i++) {
            if($significantDigits == $i) {
                $sigDigits .= "<option value=\"$i\" selected=\"true\">$i</option>";
            } else {
                $sigDigits .= "<option value=\"$i\">{$i}</option>";
            }
        }

        $this->ss->assign('sigDigits', $sigDigits);
        $this->ss->assign('CURRENCY_SIG_DIGITS', $significantDigits);

        $num_grp_sep = $this->bean->getPreference('num_grp_sep');
        $dec_sep = $this->bean->getPreference('dec_sep');
        $this->ss->assign("NUM_GRP_SEP",(empty($num_grp_sep) ? $GLOBALS['dotb_config']['default_number_grouping_seperator'] : $num_grp_sep));
        $this->ss->assign("DEC_SEP",(empty($dec_sep) ? $GLOBALS['dotb_config']['default_decimal_seperator'] : $dec_sep));
        $this->ss->assign('getNumberJs', $locale->getNumberJs());

        //// Name display format
        $this->ss->assign('default_locale_name_format', $locale->getLocaleFormatMacro($this->bean));
        $this->ss->assign('getNameJs', $locale->getNameJs());
        $this->ss->assign('NAME_FORMAT', $this->bean->getLocaleFormatDesc());
        ////	END LOCALE SETTINGS
    }

    protected function setupAdvancedTabPdfSettings() {
        ///////////////////////////////////////////////////////////////////////////////
        /////////  PDF SETTINGS
        global $focus_user;
        $focus_user = $this->bean;
        if ( !isset($this->bean->id) ) {
            if ( !defined('DOTBPDF_USE_DEFAULT_SETTINGS') ) {
                define('DOTBPDF_USE_DEFAULT_SETTINGS', true);
            }
        }
        if ( !defined('DOTBPDF_USE_FOCUS') ) {
            define('DOTBPDF_USE_FOCUS', true);
        }
        include_once('include/Dotbpdf/dotbpdf_config.php');
        if ( PDF_CLASS == 'TCPDF' ) {
            $this->ss->assign('SHOW_PDF_OPTIONS',true);
            $this->ss->assign('PDF_CLASS',PDF_CLASS);
            $this->ss->assign('PDF_UNIT',PDF_UNIT);
            $this->ss->assign('PDF_PAGE_FORMAT_LIST',get_select_options_with_id(array_combine(explode(",",PDF_PAGE_FORMAT_LIST), explode(",",PDF_PAGE_FORMAT_LIST)), PDF_PAGE_FORMAT));
            $this->ss->assign('PDF_PAGE_ORIENTATION_LIST',get_select_options_with_id(array("P"=>translate("LBL_PDF_PAGE_ORIENTATION_P",'Users'),"L"=>translate("LBL_PDF_PAGE_ORIENTATION_L",'Users')),PDF_PAGE_ORIENTATION));
            $this->ss->assign('PDF_MARGIN_HEADER',PDF_MARGIN_HEADER);
            $this->ss->assign('PDF_MARGIN_FOOTER',PDF_MARGIN_FOOTER);
            $this->ss->assign('PDF_MARGIN_TOP',PDF_MARGIN_TOP);
            $this->ss->assign('PDF_MARGIN_BOTTOM',PDF_MARGIN_BOTTOM);
            $this->ss->assign('PDF_MARGIN_LEFT',PDF_MARGIN_LEFT);
            $this->ss->assign('PDF_MARGIN_RIGHT',PDF_MARGIN_RIGHT);

            $fontManager = new FontManager();
            $fontlist = $fontManager->getSelectFontList();
            $this->ss->assign('PDF_FONT_NAME_MAIN',get_select_options_with_id($fontlist, PDF_FONT_NAME_MAIN));
            $this->ss->assign('PDF_FONT_NAME_MAIN_DISPLAY',$fontlist[PDF_FONT_NAME_MAIN]);
            $this->ss->assign('PDF_FONT_SIZE_MAIN',PDF_FONT_SIZE_MAIN);
            $this->ss->assign('PDF_FONT_NAME_DATA',get_select_options_with_id($fontlist, PDF_FONT_NAME_DATA));
            $this->ss->assign('PDF_FONT_NAME_DATA_DISPLAY',$fontlist[PDF_FONT_NAME_DATA]);
            $this->ss->assign('PDF_FONT_SIZE_DATA',PDF_FONT_SIZE_DATA);
            ///////// END PDF SETTINGS
            ////////////////////////////////////////////////////////////////////////////////
        }
    }

    protected function setupEmailSettings() {
        global $current_user, $app_list_strings;

        $this->ss->assign("MAIL_SENDTYPE", get_select_options_with_id($app_list_strings['notifymail_sendtype'], $this->bean->getPreference('mail_sendtype')));

        ///////////////////////////////////////////////////////////////////////////////
        ////	EMAIL OPTIONS
        // We need to turn off the requiredness of emails if it is a group or portal user
        if ($this->usertype == 'GROUP' || $this->usertype == 'PORTAL_ONLY' ) {
            global $dictionary;
            $dictionary['User']['fields']['email1']['required'] = false;
        }
        // hack to disable email field being required if it shouldn't be required
        if ( $this->ss->get_template_vars("REQUIRED_EMAIL_ADDRESS") == '0' ) {
            $GLOBALS['dictionary']['User']['fields']['email1']['required'] = false;
        }
        $this->ss->assign("NEW_EMAIL",  '<span id="email_span">' . getEmailAddressWidget($this->bean, "email1", $this->bean->email1, $this->viewType) . '</span>');
        // hack to undo that previous hack
        if ( $this->ss->get_template_vars("REQUIRED_EMAIL_ADDRESS") == '0' ) {
            $GLOBALS['dictionary']['User']['fields']['email1']['required'] = true;
        }
        $raw_email_link_type = $this->bean->getPreference('email_link_type');
        $mailerPreferenceStatus = OutboundEmailConfigurationPeer::getMailConfigurationStatusForUser($current_user);
        $options = $app_list_strings['dom_email_link_type'];

        if ( $this->viewType == 'EditView' ) {
            if ($mailerPreferenceStatus  === OutboundEmailConfigurationPeer::STATUS_INVALID_SYSTEM_CONFIG) {
                $raw_email_link_type = 'mailto';
            }
            $this->ss->assign('EMAIL_LINK_TYPE', get_select_options_with_id($options, $raw_email_link_type));
        } else {
            $this->ss->assign('EMAIL_LINK_TYPE', $options[$raw_email_link_type]);
        }

        /////	END EMAIL OPTIONS
        ///////////////////////////////////////////////////////////////////////////////

        /////////////////////////////////////////////
        /// Handle email account selections for users
        /////////////////////////////////////////////
        $hide_if_can_use_default = true;
        $disableDotbClient = false;

        if( !($this->usertype=='GROUP' || $this->usertype=='PORTAL_ONLY') ) {
            // email smtp
            $systemOutboundEmail = new OutboundEmail();
            $systemOutboundEmail = $systemOutboundEmail->getSystemMailerSettings();
            $mail_smtpserver = $systemOutboundEmail->mail_smtpserver;
            $mail_smtptype = $systemOutboundEmail->mail_smtptype;
            $mail_smtpport = $systemOutboundEmail->mail_smtpport;
            $mail_smtpssl = $systemOutboundEmail->mail_smtpssl;
            $mail_smtpuser = "";
            $mail_smtppass = "";
            $mail_smtpdisplay = $systemOutboundEmail->mail_smtpdisplay;
            $mail_smtpauth_req=true;
            $mail_haspass  = empty($systemOutboundEmail->mail_smtppass)?0:1;

            if( !$systemOutboundEmail->isAllowUserAccessToSystemDefaultOutbound() ) {
                $mail_smtpauth_req = $systemOutboundEmail->mail_smtpauth_req;
                $userOverrideOE = $systemOutboundEmail->getUsersMailerForSystemOverride($this->bean->id);
                if($userOverrideOE != null) {
                    $mail_smtpuser = $userOverrideOE->mail_smtpuser;
                    $mail_smtppass = $userOverrideOE->mail_smtppass;
                    $mail_haspass  = empty($userOverrideOE->mail_smtppass)?0:1;
                }

                if(!$mail_smtpauth_req && (empty($systemOutboundEmail->mail_smtpserver) || empty($systemOutboundEmail->mail_smtpuser) || empty($systemOutboundEmail->mail_smtppass))) {
                    $hide_if_can_use_default = true;
                } else{
                    $hide_if_can_use_default = false;
                }
            }

            $this->ss->assign("mail_smtpdisplay", $mail_smtpdisplay);
            $this->ss->assign("mail_smtpserver", $mail_smtpserver);
            $this->ss->assign("mail_smtpuser", $mail_smtpuser);
            $this->ss->assign("mail_smtppass", "");
            $this->ss->assign("mail_haspass", $mail_haspass);
            $this->ss->assign("mail_smtpauth_req", $mail_smtpauth_req);
            $this->ss->assign('MAIL_SMTPPORT',$mail_smtpport);
            $this->ss->assign('MAIL_SMTPSSL',$mail_smtpssl);
        }

        if ($mailerPreferenceStatus === OutboundEmailConfigurationPeer::STATUS_INVALID_SYSTEM_CONFIG) {
            $disableDotbClient = true;
            $hide_if_can_use_default = true; //to hide the username/password fields
        }
        $this->ss->assign('DISABLE_DOTB_CLIENT', $disableDotbClient);
        $this->ss->assign('HIDE_IF_CAN_USE_DEFAULT_OUTBOUND', $hide_if_can_use_default);
    }

    /**
     * setUserType
     * This function is used to set the user_type variable for a given User instance
     *
     * @param Mixed $user The user instance to set the user_type variable on
     * @return String value representing the user type
     */
    function setUserType($user)
    {
        //bug #49175: user's always regular
        //need to get user_type from bean
        $user->user_type = '';

        if ($user->is_admin)
        {
            $user->user_type = 'Administrator';
        }
        else if ($user->is_group)
        {
            $user->user_type = 'GROUP';
        }
        else if ($user->portal_only)
        {
            $user->user_type = 'PORTAL_ONLY';
        }
        else
        {
            $user->user_type = 'RegularUser';
        }
    }
}
