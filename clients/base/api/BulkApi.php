<?php

use Dotbcrm\Dotbcrm\ProcessManager\Registry;
/**
 * Bulk API calls
 *
 */
class BulkApi extends DotbApi
{
    public function registerApiRest()
    {
        return array(
            'bulkCall' => array(
                'reqType' => 'POST',
                'path' => array('bulk'),
                'pathVars' => array(''),
                'method' => 'bulkCall',
                'shortHelp' => 'Run several API call in a sequence',
                'longHelp' => 'include/api/help/bulk_post_help.html',
            ),
        );
    }

    /**
     * Bulk API call
     * @param ServiceBase $api
     * @param array $args
     * @throws DotbApiExceptionMissingParameter
     * @return array
     */
    public function bulkCall(ServiceBase $api, array $args)
    {
        $this->requireArgs($args,array('requests'));
        $restResp = new BulkRestResponse($_SERVER);
        // reset vars so they won't confuse the child service
        $_GET = array(); $_POST = array();
        foreach($args['requests'] as $name => $request) {
            if(empty($request['url'])) {
                $GLOBALS['log']->fatal("Bulk Api: URL missing for request $name");
                throw new DotbApiExceptionMissingParameter("Invalid request - URL is missing");
            }
        }
        // check all reqs first so that we don't execute any reqs if one of them is broken
        foreach($args['requests'] as $name => $request) {
            $restReq = new BulkRestRequest($request);
            $restResp->setRequest($name);
            /**
             * @var $rest RestService
             */
            $rest = new BulkRestService($api);
            $rest->setRequest($restReq);
            $rest->setResponse($restResp);
            // Because we want to trigger processes for each save
            Registry\Registry::getInstance()->drop('triggered_starts');
            $rest->execute();

        }
        return $restResp->getResponses();
    }
}
