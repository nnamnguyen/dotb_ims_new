<?php



class PMSE
{
    private $version;
    private $moduleName;
    private $modulePath;
    private $moduleLanguage;
    private $moduleLanguageBwc;

    private function __construct()
    {
        $this->version = '1.0.0';
        $this->moduleName = 'Advanced Workflow';
        $this->modulePath['pmse_Inbox'] = "modules/pmse_Inbox";
        $this->modulePath['pmse_Project'] = "modules/pmse_Project";
        $this->modulePath['pmse_Emails_Templates'] = "modules/pmse_Emails_Templates";
        $this->modulePath['pmse_Business_Rules'] = "modules/pmse_Business_Rules";
        $this->modulePath['pmse_Config'] = "modules/pmse_Config";
        $this->moduleLanguage = 'pmse_Project';
        $this->moduleLanguageBwc = 'pmse_Config';
    }

    public static function getInstance()
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new PMSE();
        }
        return $instance;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function getModuleName()
    {
        return $this->moduleName;
    }

    public function getModuleLanguage()
    {
        return $this->moduleLanguage;
    }

    public function getModuleLanguageBwc()
    {
        return $this->moduleLanguageBwc;
    }

    public function getModulePath($index = 'pmse_Project')
    {
        return $this->modulePath[$index];
    }

    /**
     * FUNCTION IS DEPRECATED FOR DOTB 6.5+
     * @codeCoverageIgnore
     * @param $file
     * @return bool
     */
    public function fileExists($file)
    {
        global $dotb_flavor, $dotb_version;
        $version = explode('.', $dotb_version);
        //$flavor = strpos($dotb_flavor, 'OD');

        //if ($flavor === false) {
        if (!((int)$version[0] == 6 && (int)$version[1] >= 7)) {
            require_once "include/utils.php";
            //if the $check_path exists in custom, $path will be returned as "custom/{$check_path}", otherwise $check_path will be returned
            $path = get_custom_file_if_exists($file);
            if ($file != $path) {
                return true;
            } else {
                return false;
            }
//            return file_exists($file);
        } else {
            //For Dotb On-Demand
            return file_exists($file);
        }

    }

    /**
     * @codeCoverageIgnore
     */
    public function getLogFile($file)
    {
        //$this->bpmLog('INFO', " getting log from " . $file);
        //return file_get_contents($file);

        $_file = new UploadFile();

        //get the file location
        $_file->temp_file_location = $file;

        //alternatively you can do the following if you know the upload file id
        //$file->temp_file_location = UploadFile::get_upload_path($file_id);

        return $_file->get_file_contents();
    }

    /**
     * @codeCoverageIgnore
     */
    public function clearLogFile($file)
    {
        if ($file == "./PMSE.log") {
            file_put_contents($file, "");
        }
    }
}
