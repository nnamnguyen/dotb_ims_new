<?php




class Group extends User {
	// User attribute overrides
	var $status			= 'Group';
	var $password		= ''; // to disallow logins
	var $default_team;
	var $importable = false;


	public function __construct() {
		parent::__construct();
	}
}
