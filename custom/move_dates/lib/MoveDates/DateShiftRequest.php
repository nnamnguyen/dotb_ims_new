<?php

namespace MoveDates;

use DotbCRM\AppInstance;

use Exception;
use DateTime;

require_once __DIR__ . '/../DotbCRM/AppInstance.php';

Class DateShiftRequest {
    
    /**
     *
     * @var int
     */
    private $delta;
    
    /**
     *
     * @var AppInstance
     */
    private $dotb_instance;
    
    /**
     * 
     * @param AppInstance $instance
     * @param int $delta
     */
    function __construct(AppInstance $instance, $delta){
        $this->dotb_instance = $instance;
        $this->delta = $delta;
    }

    public function setTrialExpire(){
        $this->dotb_instance->bootstrap();

        $now = new \DateTimeImmutable();
        $trialExpire = $now->add(new \DateInterval("P7D"));

        $focus = new \Administration();

        $result = $focus->saveSetting("license", "trial_expire_day", $trialExpire->format("Y-m-d"), "base");
        
        if($result){
            echo "Successfully set trial_expire_day to " .$trialExpire->format("Y-m-d");
        }
        else {
            echo "Cannot set trial_expire_day to " .$trialExpire->format("Y-m-d");
        }
    }
    
    public function execute(){

        $this->dotb_instance->bootstrap();

		$columns = $this->dotb_instance->getDateColumns();
		if (empty($columns)) {
			throw new Exception("Could not find any date columns to shift");
		}

		if ($this->delta === 0) {
            $this->log("[W] The dates are already up to date. Nothing to change");
            // TODO: Add a notice
			return True;
		}
        
		$this->log("[I] Moving dates {$this->delta} days");

		$delta_function = $this->sqlDeltaFunction();
		$interval_string = $this->sqlIntervalString();
		$interval_seconds = $this->deltaSeconds();

		/**
		 * Database execution
		 */
		$db = $this->dotb_instance->getDB();

        $db->query("START TRANSACTION");
		foreach ($columns as $column) {
			$db->query("
			    UPDATE
				    {$column['table']}
			    SET {$column['column']} = {$delta_function}({$column['column']}, {$interval_string})");
		}

		// Special columns, keeping timestamps as integers
		$columns_int = [
		    ['table' => 'revenue_line_items', 'column' => 'date_closed_timestamp'],
            ['table' => 'opportunities', 'column' => 'date_closed_timestamp'],
		    ['table' => 'products', 'column' => 'date_closed_timestamp'],
		    ['table' => 'forecast_worksheets', 'column' => 'date_closed_timestamp'],
		];

		foreach ($columns_int as $column_int) {
			$db->query("
			    UPDATE {$column_int['table']}
			    SET {$column_int['column']} = {$column_int['column']} + ($interval_seconds)");
		}

		$this->updateReferenceDate();
		$db->query("COMMIT");

		return True;
    }    
    
    /**
     * 
     * @return string
     */
    private function sqlDeltaFunction(){
		$delta_function = $this->delta > 0 ? 'DATE_ADD' : 'DATE_SUB';
        return $delta_function;
    }
    
    /**
     * 
     * @return string
     */
    private function sqlIntervalString(){
        $delta_abs = abs($this->delta);
        return "INTERVAL {$delta_abs} DAY";
    }
    
    /**
     * 
     * @return int
     */
    private function deltaSeconds(){
        return $this->delta * 3600 * 24;
    }
    
    /**
     * 
     * @return string
     */
	private static function getStoredReferenceDate(AppInstance $appinstance) {

        $appinstance->bootstrap();
        
		$focus = new \Administration();

		$reference_date_setting = null;

		$settings_all = $focus->getAllSettings();
		foreach ($settings_all as $setting) {
			if ($setting['category'] === 'move_dates' AND $setting['name'] === 'dates_reference') {
				$reference_date_setting = $setting;
				break;
			}
		}

		if (!empty($reference_date_setting)) {
			return $reference_date_setting['value'];
		} else {
			return false;
		}
	}
    
	private function updateReferenceDate() {
        $this->dotb_instance->bootstrap();
		$focus = new \Administration();
		$focus->saveSetting("move_dates", "dates_reference", date('Y-m-d', time()), "base");
	}
    
    
    /**
     * 
     * @return string
     */
	private function getLogFileLocation() {
		return $this->dotb_instance->getRootDir() . "/dotbcrm.log";
	}

	private function log($message) {
		$date = date("Y-m-d, H:i:s", time());
        $GLOBALS['log']->fatal("[$date] $message\n");
	}
    
    
    /**
     * @nondeterministic
     * 
     * @param string $reference_date
     * 
     * @return int
     */
    private static function deltaFromReferenceDate($reference_date){
        
        $reference_date_obj = new DateTime($reference_date);
        if (!$reference_date_obj) {
            throw new Exception("Invalid reference date $reference_date");
        }

        $today_date_obj = date_create(date('Y-m-d', time()));
        $date_diff = date_diff($today_date_obj, $reference_date_obj);

        if ($date_diff->invert) {
            $dates_delta = $date_diff->days;
        } else {
            $dates_delta = - $date_diff->days;
        }
        
        return $dates_delta;
    }
    
    /**
     * 
     * @return DateShiftRequest
     * @throws Exception
     */
    static function fromSAPI(){

        $delta = False;
        $ref_date_hint = False;

        if (php_sapi_name() === 'cli') {

            $options = getopt('', ['dotb-root:', 'reference-date:', 'delta:']);
            $dotb_root = !empty($options['dotb-root']) ? $options['dotb-root'] : __DIR__ . '/../../../../';

            if(isset($options['delta']) and isset($options['reference-date'])){
                throw new Exception("You can not specify both the reference date and a delta");
            }


            if(isset($options['delta'])){
                $delta = (int) $options['delta'];
            } else if (isset($options['reference-date'])){
                $delta = static::deltaFromReferenceDate($options['reference-date']);
            }


        } else { // WEB SAPI

            $dotb_root = __DIR__ . '/../../../../';

            if(isset($_GET['delta'])){
                $delta = (int) $_GET['delta'];
            } else if (isset($_GET['reference-date'])){
                $delta = static::deltaFromReferenceDate($_GET['reference-date']);
            }

            if(isset($_GET['reference-date-hint'])){
                $ref_date_hint = $_GET['reference-date-hint'];
            }
        }

        $appinstance = AppInstance::mount($dotb_root);

        // If no delta or reference date is provided, get any stored reference as the reference date
        if(!$delta){
            
            $ref_date = False;
            
            $ref_date_stored = static::getStoredReferenceDate($appinstance);
            
            if($ref_date_stored){
                $ref_date = $ref_date_stored;
            }
            
            if(!$ref_date_stored and $ref_date_hint){
                $ref_date = $ref_date_hint;
            }
            
            if(!$ref_date_stored and !$ref_date_hint){
                throw new Exception("No reference date stored found and no reference date hint was provided");
            }
            
            print "Using reference date $ref_date\n";
            $delta = static::deltaFromReferenceDate($ref_date);
        }
        
        $request = new static($appinstance, $delta);
        return $request;
    }

    public function truncateFTEDbTables(){

        $this->dotb_instance->bootstrap();

        $this->log("[I] Extra safety step to truncate FTE tables that should be empty by default !");

        /**
         * Database execution
         */
        $db = $this->dotb_instance->getDB();

        $db->query('START TRANSACTION');
        //table names that need to be truncated before date shift
        $fte_table = ['fte_usagetracking', 'fte_usagetracking_audit', 'tracker'];
        foreach ($fte_table as $tb) {
            $db->query("TRUNCATE TABLE {$tb}");
        }

        $db->query('COMMIT');

        return True;
    }
}
