<?php

namespace DotbCRM;

use User;
use Administration;

Class AppInstance {

	/**
	 *
	 * @var string
	 */
	private $root_dir;

	/**
	 *
	 * @var array
	 */
	private $dotb_config;

	/**
	 *
	 * @var bool
	 */
	private $bootstraped = false;

	static function mount($root_dir) {
		$instance = new static;
		$instance->root_dir = $root_dir;

		return $instance;
	}

	function getRootDir() {
		return $this->root_dir;
	}

	function bootstrap() {

		if ($this->bootstraped) {
			return true;
		}

		global $dotb_config;
		global $moduleList;

		/* DOTB CONTEXT ENTRY POINT PREPARE START */
		if (!defined('dotbEntry')) {
			define('dotbEntry', true);
		}

		global $current_user, $db, $locale, $beanList, $objectList;
		global $modules_exempt_from_availability_check, $beanFiles, $app_list_strings,
		$dictionary, $bwcModules, $modInvisList, $moduleList;

		$this->dotb_config = &$dotb_config;

        // Change to dotb location
        /* DOTB CONTEXT ENTRY POINT PREPARE END */
        
        chdir($this->root_dir);
        require_once('include/entryPoint.php');

		# Setup the language
		if (empty($current_language)) {
			$current_language = $dotb_config['default_language'];
		}

		# Setup the current user
		global $current_user;
		$current_user = new User();
		$current_user->getSystemUser();

		$this->bootstraped = True;

		return True;
	}

	function getDB() {
		try {
			$focus = new Administration();
			$dbh = $focus->db;
			return $dbh;
		} catch (Exception $ex) {
			$GLOBALS['log']->fatal("Could not connect to the database");
			return false;
		}
	}

	/**
	 * Gets all the columns that are related to time and dates
	 *
	 * @param type $dbh
	 * @param type $dbname
	 * @return type
	 */
	function getDateColumns() {

		$dbh = $this->getDB();
		if (!$dbh) {
			return False;
		}

		$dbname = $this->dotb_config["dbconfig"]["db_name"];
		if (empty($dbname)) {
			$GLOBALS['log']->fatal("Database name is not in the dotb config array. How is this even possible");
			return False;
		}

		$result = $dbh->query("
	    SELECT
		TABLE_NAME as `table`,
		COLUMN_NAME as `column`
	    FROM
	      `INFORMATION_SCHEMA`.`COLUMNS`
	    WHERE
	      `TABLE_SCHEMA` =  '{$dbname}'
		    AND DATA_TYPE IN ('date',  'datetime',  'time')
		    AND TABLE_NAME NOT IN ('timeperiods', 'fte_usagetracking', 'fte_usagetracking_audit', 'tracker')
	    ");

		while ($column = $result->fetch_assoc()) {
			$columns[] = $column;
		}

		return $columns;
	}

}
