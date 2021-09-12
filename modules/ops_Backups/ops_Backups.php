<?php

class ops_Backups extends DotbBean {

    const CONFIG_MODULE = 'ops_Backups';
    const CONFIG_PLATFORM = 'base';

    const DOTB_CONFIG_MOTHERSHIP_KEY = 'mothership';
    const DOTB_CONFIG_MS_FQDN_KEY = 'fqdn';
    const DOTB_CONFIG_MS_USER_KEY = 'ai_user';
    const DOTB_CONFIG_MS_PASS_KEY = 'ai_pass';

    const MS_FQDN = 'prod.ms.dotbcrm.com';

    public $new_schema = true;
    public $module_dir = 'ops_Backups';
    public $object_name = 'ops_Backups';
    public $table_name = 'ops_backups';
    public $importable = false;
    public $id;
    public $name;
    public $date_entered;
    public $description;
    public $deleted;
    public $download_url;
    public $expires_at;
    public $disable_row_level_security = true;

    protected static $_config = array();

    public function __construct(){
        parent::__construct();
    }

    public function bean_implements($interface){
        switch($interface){
            case 'ACL': return false;
        }
        return false;
    }

    /**
     * Get the Dotb Config for module
     * @param bool $refresh
     * @return array
     */
    public static function dotbConfig($refresh = false){
        if (empty(static::$_config)||$refresh){
            $admin = BeanFactory::getBean('Administration');
            static::$_config = $admin->getConfigForModule(self::CONFIG_MODULE,self::CONFIG_PLATFORM,$refresh);
        }
        return static::$_config;
    }

    /**
     * Set a Dotb Config property for the module
     * - Custom logic, adds a 'ondemand' config key for Notification Emails only
     * @param $property - config property name
     * @param $value - config property value
     */
    public static function setDotbConfig($property,$value){
        $admin = BeanFactory::getBean('Administration');
        //Hack to make BWC and Lumia views commit to predefined Ops Config Setting
        if ($property == 'notification_emails' || $property == 'notification_cc'){
            $admin->saveSetting('ondemand', 'notification_cc', json_encode($value), self::CONFIG_PLATFORM);
        }
        if ($property !== 'notification_cc') {
            if (is_array($value)) {
                $admin->saveSetting(self::CONFIG_MODULE, $property, json_encode($value), self::CONFIG_PLATFORM);
            } else {
                $admin->saveSetting(self::CONFIG_MODULE, $property, $value, self::CONFIG_PLATFORM);
            }
        }
    }

    /**
     * Remove expired records from Backups module
     */
    public static function removeExpired(){
        $bean = new static();
        $r = $bean->db->query('DELETE FROM '.$bean->table_name.' WHERE expires_at < NOW()');
        if (!empty($r)) {
            if ($r > 0) {
                $GLOBALS['log']->info(sprintf("opsBackups deleted %d expired backup entries", $r));
            }
        }
    }

    /**
     * Get the Config needed to connect to Mothership API
     * @return array(
     *          'fqdn' => string,
     *          'user' => string,
     *          'pass' => string
     * )
     */
    public static function mothershipConfig(){
        global $dotb_config;
        $config = array(
            'fqdn' => self::MS_FQDN,
            'user' => $dotb_config['dbconfig']['db_user_name'],
            'pass' => $dotb_config['dbconfig']['db_password']
        );
        if (array_key_exists(self::DOTB_CONFIG_MOTHERSHIP_KEY, $dotb_config) && is_array($dotb_config[self::DOTB_CONFIG_MOTHERSHIP_KEY])) {
            if (array_key_exists(self::DOTB_CONFIG_MS_FQDN_KEY, $dotb_config[self::DOTB_CONFIG_MOTHERSHIP_KEY])) {
                $config['fqdn'] = $dotb_config[self::DOTB_CONFIG_MOTHERSHIP_KEY][self::DOTB_CONFIG_MS_FQDN_KEY];
            }
            if (array_key_exists(self::DOTB_CONFIG_MS_USER_KEY, $dotb_config[self::DOTB_CONFIG_MOTHERSHIP_KEY])) {
                $config['user'] = $dotb_config[self::DOTB_CONFIG_MOTHERSHIP_KEY][self::DOTB_CONFIG_MS_USER_KEY];
            }
            if (array_key_exists(self::DOTB_CONFIG_MS_PASS_KEY, $dotb_config[self::DOTB_CONFIG_MOTHERSHIP_KEY])) {
                $config['pass'] = $dotb_config[self::DOTB_CONFIG_MOTHERSHIP_KEY][self::DOTB_CONFIG_MS_PASS_KEY];
            }
        }
        return $config;
    }

    /**
     * Call to Mothership API to get Exports. Returns Array of Exports or FALSE if there was an error
     * @return bool|mixed
     */
    public function getAppInstanceExports(){
        $config = static::mothershipConfig();
        $url = "https://".$config['fqdn']."/api/dotb_module/exports";
        $ch = curl_init($url);
        if ($ch === FALSE) {
            $GLOBALS['log']->fatal("opsBackups failed to initialize curl");
            return FALSE;
        }
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "X-AI-Username: ".$config['user'],
            "X-AI-Password: ".$config['pass']
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5000);
        $output = curl_exec($ch);

        if (curl_errno($ch)) {
            $GLOBALS['log']->fatal(sprintf("opsBackups curl error: %s", curl_error($ch)));
            curl_close($ch);
            return FALSE;
        }
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($code < 200 || $code > 300) {
            $GLOBALS['log']->fatal(sprintf("opsBackups curl returned HTTP %d", $code));
            return FALSE;
        }
        if (empty($output)) {
            $GLOBALS['log']->fatal(sprintf("opsBackups curl HTTP %d but empty body", $code));
            return FALSE;
        }

        $backups = json_decode($output);
        if (empty($backups) && !is_array($backups)) {
            $GLOBALS['log']->fatal("opsBackups failed to json_decode $backups");
            return FALSE;
        }
        $GLOBALS['log']->info(sprintf("opsBackups retrieved %d backups from the Mothership", count($backups)));
        $GLOBALS['log']->debug(print_r($backups, TRUE));
        return $backups;
    }

    /**
     * Takes in an Export Object from getAppInstanceExports, and verifies all data exists that should. Sets a Name on the Export based on the Filename
     * @param $export
     * @return bool
     */
    public function verifyExport($export){
        if (!is_object($export)) {
            $GLOBALS['log']->error("opsBackups entry was not an object: $export");
            return FALSE;
        }
        foreach (Array(
                     "created_at",
                     "expires_at",
                     "download_url"
                 ) as $key) {
            if (!isset($key, $export)) {
                $GLOBALS['log']->error("opsBackups entry was missing key: $key");
                return FALSE;
            }
        }

        $export->created_at = DateTime::createFromFormat('Y/m/d H:i:s T', $export->created_at);
        $export->expires_at = DateTime::createFromFormat('Y/m/d H:i:s T', $export->expires_at);
        $downloadURL = str_replace('https://','',$export->download_url);
        $downloadURL = explode("/",$downloadURL);
        $fileName = explode(".",$downloadURL[1]);
        foreach($fileName as $key => $namePart){
            if ($namePart == 'dotbondemand' || $namePart == 'dotbopencloud'){
                $export->name = $fileName[$key-1].".".$namePart.".".$fileName[$key+1];
                $export->name .= " - ".$fileName[$key+2];
                break;
            }
        }

        if ($export->created_at === FALSE || $export->expires_at === FALSE) {
            $GLOBALS['log']->error("opsBackups failed to parse dates");
            return FALSE;
        }

        return $export;
    }


}