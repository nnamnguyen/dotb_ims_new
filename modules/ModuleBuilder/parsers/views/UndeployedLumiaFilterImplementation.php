<?php


require_once 'modules/ModuleBuilder/parsers/constants.php';

class UndeployedLumiaFilterImplementation extends AbstractMetaDataImplementation implements MetaDataImplementationInterface
{

    const HISTORYFILENAME = 'restored.php';
    const HISTORYVARIABLENAME = 'viewdefs';

    /**
     * The constructor
     * @param string $moduleName
     * @param string $packageName
     * @param string $client
     */
    public function __construct($moduleName, $packageName, $client = '')
    {
        $this->_moduleName = $moduleName;
        $this->client = (empty($client)) ? 'base' : $client;

        // TODO: history
        $this->historyPathname = "custom/history/modulebuilder/packages/{$packageName}/modules/{$moduleName}/clients/{$client}/filters/default/" . self::HISTORYFILENAME;
        $this->_history = new History($this->historyPathname);

        //get the bean from ModuleBuilder
        $mb = new ModuleBuilder();
        $this->module = $mb->getPackageModule($packageName, $moduleName);
        $this->module->mbvardefs->updateVardefs();

        $templates = $this->module->config['templates'];
        $template_def = "";
        foreach ($templates as $template => $a) {
            if ($a === 1) {
                $template_def = $template;
            }
        }

        $template_filter_def = "include/DotbObjects/templates/{$template_def}/clients/{$this->client}/filters/default/default.php";

        if (file_exists($template_filter_def)) {
            include $template_filter_def;
        }

        $this->lumiaFile = "{$this->module->getModuleDir()}/clients/{$client}/filters/default/default.php";

        if (file_exists($this->lumiaFile)) {
            include $this->lumiaFile;
        }
        $viewdefs = empty($viewdefs) ? array('fields' => array()) : $viewdefs;

        $this->_viewdefs = $this->getNewViewDefs($viewdefs);

        $this->_fielddefs = $this->getFieldDefs();
        $this->_paneldefs = $this->_viewdefs;

        // Set the global mod_strings directly as Dotb does not automatically load the
        // language files for undeployed modules (how could it?)
        $selected_lang = 'en_us';
        if (isset($GLOBALS['current_language']) && !empty($GLOBALS['current_language'])) {
            $selected_lang = $GLOBALS['current_language'];
        }
        $GLOBALS['mod_strings'] = array_merge(
            $GLOBALS['mod_strings'] ?: array(),
            $this->module->getModStrings($selected_lang)
        );
    }

    /**
     * Get the new listview defs in viewdefs
     * @param array $viewDefs the viewdefs array
     * @return array the listviewDefs
     */
    public function getNewViewDefs(array $viewDefs)
    {
        if (isset($viewDefs[$this->_moduleName][$this->_viewClient]['filter']['default'])) {
            return $viewDefs[$this->_moduleName][$this->_viewClient]['filter']['default'];
        }

        return array();
    }

    /**
     * Get the Fielddefs
     * @return array
     */
    public function getFieldDefs()
    {
        $results = array();
        if (!isset($this->_viewdefs['fields'])) {
            return $results;
        }
        foreach ($this->_viewdefs['fields'] as $field => $def) {
            if (!isset($this->module->field_defs[$field])) {
                continue;
            }
            $results[$field] = $this->module->field_defs[$field['name']];
        }
        unset($results['my_favorite']);
        return $results;
    }

    /**
     * Get the language
     * @return string
     */
    public function getLanguage()
    {
        return ""; // '' is the signal to translate() to use the global mod_strings
    }

    /*
     * Save a filter def
     * @param array defs    Layout definition in the same format as received by the constructor
     */
    public function deploy($defs)
    {
        $this->_viewdefs = $defs;

        if (!is_dir(dirname($this->lumiaFile))) {
            if (!dotb_mkdir(dirname($this->lumiaFile), null, true)) {
                throw new Exception(sprintf("Cannot create directory %s", $this->lumiaFile));
            }
        }
        write_array_to_file(
            "viewdefs['{$this->_moduleName}']['{$this->_viewClient}']['filter']['default']",
            $this->_viewdefs,
            $this->lumiaFile
        );
    }

}
