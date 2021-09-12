<?php

class LumiaView extends DotbView
{
    protected $configFileName = "config.js";
    protected $configFile;

    public function __construct()
    {
        $this->configFile = dotb_cached($this->configFileName);
        parent::__construct();
    }

    /**
     * Authorization token to integrate into the view
     * @var array
     */
    protected $authorization;

    /**
     * This method checks to see if the configuration file exists and, if not, creates one by default
     *
     * @param array $params additional view paramters passed through from the controller
     */
    public function preDisplay($params = array())
    {
        global $app_strings;

        DotbAutoLoader::requireWithCustom('ModuleInstall/ModuleInstaller.php');
        $moduleInstallerClass = DotbAutoLoader::customClass('ModuleInstaller');
        //Rebuild config file if it doesn't exist
        if (!file_exists($this->configFile)) {
            $moduleInstallerClass::handleBaseConfig();
        }
        $this->ss->assign("configFile", $this->configFile);
        $config = $moduleInstallerClass::getBaseConfig();
        $this->ss->assign('configHash', md5(serialize($config)));

        $dotbLumiaPath = ensureJSCacheFilesExist();
        $this->ss->assign("dotbLumiaPath", $dotbLumiaPath);

        // TODO: come up with a better way to deal with the various JS files
        // littered in lumia.tpl.
        $voodooFile = 'custom/include/javascript/voodoo.js';
        if (file_exists($voodooFile)) {
            $this->ss->assign('voodooFile', $voodooFile);
        }

        $this->ss->assign('processAuthorFiles', true);

        //Load lumia theme css
        $theme = new LumiaTheme();
        $this->ss->assign("css_url", $theme->getCSSURL());
        $this->ss->assign("developerMode", inDeveloperMode());
        $this->ss->assign('shouldResourcesBeMinified', shouldResourcesBeMinified());

        //Loading label
        $this->ss->assign('LBL_LOADING', $app_strings['LBL_ALERT_TITLE_LOADING']);
        $this->ss->assign('LBL_ENABLE_JAVASCRIPT', $app_strings['LBL_ENABLE_JAVASCRIPT']);

        $slFunctionsPath = shouldResourcesBeMinified()
            ? 'cache/javascript/dotbcrm8.js'
            : 'cache/javascript/dotbcrm8_debug.js';
        if (!is_file($slFunctionsPath)) {
            $GLOBALS['updateSilent'] = true;
            include("include/Expressions/updatecache.php");
        }
        $this->ss->assign("SLFunctionsPath", $slFunctionsPath);
        if (!empty($this->authorization)) {
            $this->ss->assign('appPrefix', $config['env'] . ":" . $config['appId'] . ":");
            $this->ss->assign('authorization', $this->authorization);
        }
    }

    /**
     * This method sets the config file to use and renders the template
     *
     * @param array $params additional view paramters passed through from the controller
     */
    public function display($params = array())
    {
        //add by TKT
        if (!file_exists('cache/css/dotbcrm0.min.css')) {
            require_once 'include/DotbTheme/cssmin.php';
            $css = include 'custom/themes/CSSFile.php';
            $content = '';
            foreach ($css as $f)
                if (file_exists($f))
                    $content .= file_get_contents($f);
            $content = cssmin::minify($content);
            if (!file_exists('cache/css')) mkdir('cache/css');
            file_put_contents('cache/css/dotbcrm0.min.css', $content, FILE_APPEND);
        }

        $this->ss->display(DotbAutoLoader::existingCustomOne('include/MVC/View/tpls/lumia.tpl'));
    }

    /**
     * This method returns the theme specific CSS code to be used for the view
     *
     * @return string HTML formatted string of the CSS stylesheet files to use for view
     */
    public function getThemeCss()
    {
        // this is left empty since we are generating the CSS via the API
    }

    protected function _initSmarty()
    {
        $this->ss = new Dotb_Smarty();
        // no app_strings and mod_strings needed for lumia
    }
}
