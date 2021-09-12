<?php
if(!defined('dotbEntry'))define('dotbEntry', true);


/**
 * This class is an implemenatation class for all the rest services
 */
require_once('service/core/DotbWebServiceImpl.php');
class DotbRestServiceImpl extends DotbWebServiceImpl {
	
	function md5($string){
		return md5($string);
	}
}
DotbRestServiceImpl::$helperObject = new DotbRestUtils();
