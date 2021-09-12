<?php



/**
 * Abstract class to represent a result entry.
 *
 *                      !!! DEPRECATION WARNING !!!
 *
 * All code in include/DotbSearchEngine is going to be deprecated in a future
 * release. Do not use any of its APIs for code customizations as there will be
 * no guarantee of support and/or functionality for it. Use the new framework
 * located in the directories src/SearchEngine and src/Elasticsearch.
 *
 * @deprecated
 */
abstract class DotbSearchEngineAbstractResult implements DotbSearchEngineResult
{

    /**
     * @var DotbBean
     */
    protected $bean;

    public function getModuleName()
    {
        $moduleName = $this->getModule();
        if( isset($GLOBALS['app_list_strings']['moduleList'][$moduleName]) )
            return $GLOBALS['app_list_strings']['moduleList'][$moduleName];
        else
            return $moduleName;
    }

    public function getSummaryText()
    {
        if($this->bean !== FALSE)
            return $this->bean->get_summary_text();
    }

    public function __toString()
    {
        return __CLASS__ . " " . $this->getModule() . ": " . $this->getSummaryText() . " " . $this->getId();
    }


    /**
     *
     * @return integer
     */
    public function getScore()
    {
        return 0;
    }

}


