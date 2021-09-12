<?php

require_once('vendor/nusoap//nusoap.php');

class PackageManagerComm
{
    const HTTPS_URL = 'https://depot.dotbcrm.com/depot/DotbDepotSoap.php';


    /**
     * Initialize the soap client and store in the $GLOBALS object for use
     *
     * @param login    designates whether we want to try to login after we initialize or not
     */
    protected static function initialize($login = true)
    {
        if(empty($GLOBALS['DotbDepot'])){
            $GLOBALS['log']->debug('USING HTTPS TO CONNECT TO HEARTBEAT');
            $soap_client = new nusoapclient(self::HTTPS_URL, false);
            $ping = $soap_client->call('dotbPing', array());
            $GLOBALS['DotbDepot'] = $soap_client;
        }
        //if we do not have a session, then try to login
        if($login && empty($_SESSION['DotbDepotSessionID'])){
            PackageManagerComm::login();
        }
     }

     /**
      * Check for errors in the response or error_str
      */
    public static function errorCheck()
    {
     	if(!empty($GLOBALS['DotbDepot']->error_str)){
     		$GLOBALS['log']->fatal($GLOBALS['DotbDepot']->error_str);
     		$GLOBALS['log']->fatal($GLOBALS['DotbDepot']->response);
     	}
     }

     /**
      * Set the credentials for use during login
      *
      * @param username    Mambo username
      * @param password     Mambo password
      * @param download_key User's download key
      */
     function setCredentials($username, $password, $download_key){
        $_SESSION['DotbDepotUsername'] = $username;
        $_SESSION['DotbDepotPassword'] = $password;
        $_SESSION['DotbDepotDownloadKey'] = $download_key;
     }

     /**
      * Clears out the session so we can reauthenticate.
      */
    public static function clearSession()
    {
     	$_SESSION['DotbDepotSessionID'] = null;
     	unset($_SESSION['DotbDepotSessionID']);
     }
     /////////////////////////////////////////////////////////
     ////////// BEGIN: Base Functions for Communicating with the depot
     /**
      * Login to the depot
      *
      * @return true if successful, false otherwise
      */
    public static function login($terms_checked = true)
    {
      if(empty($_SESSION['DotbDepotSessionID'])){
	      global $license;
	        $GLOBALS['log']->debug("Begin DotbDepot Login");
	        PackageManagerComm::initialize(false);
	        require('dotb_version.php');
	        require('config.php');
	        $credentials = PackageManager::getCredentials();
	        if(empty($license))loadLicense();
	        $info = dotbEncode('2813', serialize(getSystemInfo(true)));
	        $pm = new PackageManager();
	        $installed = $pm->buildInstalledReleases();
	        $installed = base64_encode(serialize($installed));
	        $params = array('installed_modules' => $installed, 'terms_checked' => $terms_checked, 'system_name' => $credentials['system_name']);
	        $terms_version = (!empty($_SESSION['DotbDepot_TermsVersion']) ? $_SESSION['DotbDepot_TermsVersion'] : '');
	        if(!empty($terms_version))
	        	$params['terms_version'] = $terms_version;

	        $result = $GLOBALS['DotbDepot']->call('depotLogin', array(array('user_name' => $credentials['username'], 'password' => $credentials['password']),'info'=>$info, 'params' => $params));
	        PackageManagerComm::errorCheck();
	        if(!is_array($result))
	        	$_SESSION['DotbDepotSessionID'] = $result;
	        $GLOBALS['log']->debug("End DotbDepot Login");
	        return $result;
      }
      else
      	return $_SESSION['DotbDepotSessionID'];
     }

     /**
      * Logout from the depot
      */
     function logout(){
        PackageManagerComm::initialize();
        $result = $GLOBALS['DotbDepot']->call('depotLogout', array('session_id' => $_SESSION['DotbDepotSessionID']));
     }

     /**
      * Get all promotions from the depot
      */
    public static function getPromotion()
    {
        PackageManagerComm::initialize();
        //check for fault first and then return
        $name_value_list = $GLOBALS['DotbDepot']->call('depotGetPromotion', array('session_id' => $_SESSION['DotbDepotSessionID']));
        return $name_value_list;
     }

    /**
     * A generic function which given a category_id some filter will
     * return an object which contains categories and packages
     *
     * @param category_id  the category_id to fetch
     * @param filter       a filter which will limit theh number of results returned
     * @return categories_and_packages
     * @see categories_and_packages
    */
    public static function getCategoryPackages($category_id, $filter = array())
    {
        PackageManagerComm::initialize();
        //check for fault
         return $GLOBALS['DotbDepot']->call('depotGetCategoriesPackages', array('session_id' => $_SESSION['DotbDepotSessionID'], 'category_id' => $category_id, 'filter' => $filter));
    }

    /**
     * Return a list of child categories to the parent specified in category_id
     *
     * @param category_id  the parent category_id
     * @param filter       a filter which will limit theh number of results returned
     * @return categories_and_packages
     * @see categories_and_packages
     */
    public static function getCategories($category_id, $filter = array())
    {
        PackageManagerComm::initialize();
        //check for fault
        return $GLOBALS['DotbDepot']->call('depotGetCategories', array('session_id' => $_SESSION['DotbDepotSessionID'], 'category_id' => $category_id, 'filter' => $filter));
    }

    /**
     * Return a list of packages which belong to the parent category_id
     *
     * @param category_id  the category_id to fetch
     * @param filter       a filter which will limit theh number of results returned
     * @return packages
     * @see packages
    */
    public static function getPackages($category_id, $filter = array())
    {
        PackageManagerComm::initialize();
        //check for fault
         return $GLOBALS['DotbDepot']->call('depotGetPackages', array('session_id' => $_SESSION['DotbDepotSessionID'], 'category_id' => $category_id, 'filter' => $filter));
    }

    /**
     * Return a list of releases belong to a package
     *
     * @param category_id  the category_id to fetch
     * @param package_id  the package id which the release belongs to
     * @return packages
     * @see packages
    */
    public static function getReleases($category_id, $package_id, $filter = array())
    {
        PackageManagerComm::initialize();
         //check for fault
         return $GLOBALS['DotbDepot']->call('depotGetReleases', array('session_id' => $_SESSION['DotbDepotSessionID'], 'category_id' => $category_id, 'package_id' => $package_id, 'filter' => $filter));
    }

    /**
     * Download a given release
     *
     * @param category_id  the category_id to fetch
     * @param package_id  the package id which the release belongs to
     * @param release_id  the release we want to download
     * @return download
     * @see download
    */
    function download($category_id, $package_id, $release_id){
        PackageManagerComm::initialize();
         //check for fault
         return $GLOBALS['DotbDepot']->call('depotDownloadRelease', array('session_id' => $_SESSION['DotbDepotSessionID'], 'category_id' => $category_id, 'package_id' => $package_id, 'release_id' => $release_id));
    }

    /**
     * Add a requested download to the queue
     *
     * @param category_id  the category_id to fetch
     * @param package_id  the package id which the release belongs to
     * @param release_id  the release we want to download
     * @return the filename to download
     */
    public static function addDownload($category_id, $package_id, $release_id)
    {
        PackageManagerComm::initialize();
         //check for fault
         return $GLOBALS['DotbDepot']->call('depotAddDownload', array('session_id' => $_SESSION['DotbDepotSessionID'], 'category_id' => $category_id, 'package_id' => $package_id, 'release_id' => $release_id, 'download_key' => '123'));
    }

    /**
     * Call the PackageManagerDownloader function which uses curl in order to download the specified file
     *
     * @param filename	the file to download
     * @return path to downloaded file
     */
    static public function performDownload($filename){
        PackageManagerComm::initialize();
         //check for fault
         $GLOBALS['log']->debug("Performing download from depot: Session ID: ".$_SESSION['DotbDepotSessionID']." Filename: ".$filename);
         return PackageManagerDownloader::download($_SESSION['DotbDepotSessionID'], $filename);
    }

    /**
     * Retrieve documentation for the given release or package
     *
     * @param package_id	the specified package to retrieve documentation
     * @param release_id	the specified release to retrieve documentation
     *
     * @return documents
     */
    public static function getDocumentation($package_id, $release_id)
    {
    	 PackageManagerComm::initialize();
         //check for fault
         return $GLOBALS['DotbDepot']->call('depotGetDocumentation', array('session_id' => $_SESSION['DotbDepotSessionID'], 'package_id' => $package_id, 'release_id' => $release_id));
    }

    public static function getTermsAndConditions()
    {
    	 PackageManagerComm::initialize(false);
    	  return $GLOBALS['DotbDepot']->call('depotTermsAndConditions',array());
    }

    /**
     * Log that the user has clicked on a document
     *
     * @param document_id	the document the user has clicked on
     */
    public static function downloadedDocumentation($document_id)
    {
    	 PackageManagerComm::initialize();
         //check for fault
         $GLOBALS['log']->debug("Logging Document: ".$document_id);
         $GLOBALS['DotbDepot']->call('depotDownloadedDocumentation', array('session_id' => $_SESSION['DotbDepotSessionID'], 'document_id' => $document_id));
    }

	/**
	 * Send the list of installed objects, could be patches, or modules, .. to the depot and allow the depot to send back
	 * a list of corresponding updates
	 *
	 * @param objects_to_check	an array of name_value_lists which contain the appropriate values
	 * 							which will allow the depot to check for updates
	 *
	 * @return array of name_value_lists of corresponding updates
	 */
    public static function checkForUpdates($objects_to_check)
    {
		PackageManagerComm::initialize();
         //check for fault
         return $GLOBALS['DotbDepot']->call('depotCheckForUpdates', array('session_id' => $_SESSION['DotbDepotSessionID'], 'objects' => $objects_to_check));
	}
     /**
     * Ping the server to determine if we have established proper communication
     *
     * @return true if we can communicate with the server and false otherwise
    */
     function isAlive(){
        PackageManagerComm::initialize(false);

        $status = $GLOBALS['DotbDepot']->call('dotbPing', array());
        if (empty($status) || $GLOBALS['DotbDepot']->getError() || $status != 'ACTIVE') {
            return false;
        }else{
            return true;
        }
     }
     ////////// END: Base Functions for Communicating with the depot
     ////////////////////////////////////////////////////////
}
