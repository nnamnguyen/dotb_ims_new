<?php



class DotbLogicFunctionsApi extends DotbApi
{
    /**
     * Rest Api Registration Method
     *
     * @return array
     */
    public function registerApiRest()
    {
        $parentApi = array(
            'dotblogic_functions' => array(
                'reqType' => 'GET',
                'path' => array('ExpressionEngine', 'functions'),
                'pathVars' => array('', ''),
                'method' => 'getDotbLogicFunctions',
                'shortHelp' => 'Retrieve the js for DotbLogic Expressions and Actions',
                'longHelp' => '',
                'noLoginRequired' => true,
                'rawReply' => true,
                'noEtag' => true,
                'ignoreMetaHash' => true,
                'ignoreSystemStatusError' => true,
            ),
        );
        return $parentApi;
    }

    /**
     * Will return the javascript for the Dotb Logic expressions and actions installed on this instance.
     *
     * @param ServiceBase $api
     * @param array       $args
     */
    public function getDotbLogicFunctions(ServiceBase $api, array $args)
    {
        $useDebug = (!shouldResourcesBeMinified() || !empty($args['debug']));
        $phpCacheFile = dotb_cached("Expressions/functionmap.php");
        $jsCacheFile = $useDebug ?
            dotb_cached("javascript/dotbcrm8_debug.js") :
            dotb_cached('javascript/dotbcrm8.js');
        // @jvink - check with @dwheeler
        if (!file_exists($phpCacheFile) || !file_exists($jsCacheFile)) {
            $GLOBALS['updateSilent'] = true;
            include("include/Expressions/updatecache.php");
        }
        $api->setHeader("Content-Type", "application/javascript");
        return dotb_file_get_contents($jsCacheFile);
    }
}
