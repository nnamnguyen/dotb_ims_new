<?php


require_once('include/utils/activity_utils.php');

class CalendarActivity {
	var $dotb_bean;
	var $start_time;
	var $end_time;


	public function __construct($args){
		// if we've passed in an array, then this is a free/busy slot
		// and does not have a dotbbean associated to it
		global $timedate;

		if ( is_array ( $args )){
			$this->start_time = clone $args[0];
			$this->end_time = clone $args[1];
			$this->dotb_bean = null;
			$timedate->tzGMT($this->start_time);
			$timedate->tzGMT($this->end_time);
			return;
		}

	    // else do regular constructor..

	    	$dotb_bean = $args;
		$this->dotb_bean = $dotb_bean;


        if ($dotb_bean->object_name == 'Task'){
            if (!empty($this->dotb_bean->date_start))
            {
                $this->start_time = $timedate->fromDb($this->dotb_bean->date_start);
            }
            else {
                $this->start_time = $timedate->fromDb($this->dotb_bean->date_due);
            }
            if ( empty($this->start_time)){
                return;
            }
            $this->end_time = $timedate->fromDb($this->dotb_bean->date_due);
        }else{
            $this->start_time = $timedate->fromDb($this->dotb_bean->date_start);
            if ( empty($this->start_time)){
                return;
            }
			$hours = $this->dotb_bean->duration_hours;
			if(empty($hours)){
			    $hours = 0;
			}
			$mins = $this->dotb_bean->duration_minutes;
			if(empty($mins)){
			    $mins = 0;
			}
			$this->end_time = $this->start_time->get("+$hours hours $mins minutes");
		}
		// Convert it back to database time so we can properly manage it for getting the proper start and end dates
		$timedate->tzGMT($this->start_time);
		$timedate->tzGMT($this->end_time);
	}

	/**
	 * Get where clause for fetching entried from DB
	 * @param string $table_name t
	 * @param string $rel_table table for accept status, not used in Tasks
	 * @param DotbDateTime $start_ts_obj start date
	 * @param DotbDateTime $end_ts_obj end date
	 * @param string $field_name date field in table
	 * @param string $view view; not used for now, left for compatibility
	 * @return string
	 */
    public static function get_occurs_within_where_clause(
        $table_name,
        $rel_table,
        $start_ts_obj,
        $end_ts_obj,
        $field_name = 'date_start',
        $view
    ) {
        global $timedate;

		$start = clone $start_ts_obj;
		$end = clone $end_ts_obj;

		$field_date = $table_name.'.'.$field_name;
		$start_day = $GLOBALS['db']->convert("'{$start->asDb()}'",'datetime');
		$end_day = $GLOBALS['db']->convert("'{$end->asDb()}'",'datetime');

        //Of the calendar activities, tasks do not span dates, so just filter by field date
        if(strpos($table_name,'task')!==false){
            $where = "($field_date >= $start_day AND $field_date < $end_day";
        }else{
            //meetings & calls render across date ranges, so make sure table.date_start is less than view end day AND...
            //... table.date_end is greater than view start date
            $where = "({$table_name}.date_start < $end_day AND {$table_name}.date_end > $start_day";
        }

		if($rel_table != ''){
			$where .= " AND $rel_table.accept_status != 'decline'";
		}

		$where .= ")";
		return $where;
	}

    /**
     * @param DotbBean $user_focus
     * @param $start_date_time Not used.
     * @param $end_date_time Not used.
     * @return array
     */
    public static function get_freebusy_activities($user_focus, $start_date_time, $end_date_time)
    {
		$act_list = array();
		$vcal_focus = BeanFactory::newBean('vCals');
		$vcal_str = $vcal_focus->get_vcal_freebusy($user_focus);

		$lines = explode("\n",$vcal_str);
		$utc = new DateTimeZone("UTC");
	 	foreach ($lines as $line){
			if ( preg_match('/^FREEBUSY.*?:([^\/]+)\/([^\/]+)/i',$line,$matches)){
			  $dates_arr = array(DotbDateTime::createFromFormat(vCal::UTC_FORMAT, $matches[1], $utc),
				              DotbDateTime::createFromFormat(vCal::UTC_FORMAT, $matches[2], $utc));
			  $act_list[] = new CalendarActivity($dates_arr);
			}
		}
		return $act_list;
	}

	/**
	 * Get array of activities
	 * @param string $user_id
	 * @param boolean $show_tasks
	 * @param DotbDateTime $view_start_time start date
	 * @param DotbDateTime $view_end_time end date
	 * @param string $view view; not used for now, left for compatibility
	 * @param boolean $show_calls
	 * @return array
	 */
    public static function get_activities(
        $user_id,
        $show_tasks,
        $view_start_time,
        $view_end_time,
        $view,
        $show_calls = true,
		$fill_additional_column_fields = true
    ) {
		global $current_user;
		$act_list = array();
		$seen_ids = array();


		// get all upcoming meetings, tasks due, and calls for a user
		if(ACLController::checkAccess('Meetings', 'list', $current_user->id == $user_id)) {
			$meeting = BeanFactory::newBean('Meetings');

			if($current_user->id  == $user_id) {
				$meeting->disable_row_level_security = true;
			}

			$where = CalendarActivity::get_occurs_within_where_clause($meeting->table_name, $meeting->rel_users_table, $view_start_time, $view_end_time, 'date_start', $view);
			$focus_meetings_list = build_related_list_by_user_id($meeting,$user_id,$where,$fill_additional_column_fields);
			foreach($focus_meetings_list as $meeting) {
				if(isset($seen_ids[$meeting->id])) {
					continue;
				}

				$seen_ids[$meeting->id] = 1;
				$act = new CalendarActivity($meeting);

				if(!empty($act)) {
                    //use UTC formatted start and end date as key, this makes for easier sorting
                    $act_list[$act->start_time->format('Ymd\THi00\Z').'/'.$act->end_time->format('Ymd\THi00\Z').'/'.$act->dotb_bean->id] = $act;
				}
			}
		}

		if($show_calls){
			if(ACLController::checkAccess('Calls', 'list',$current_user->id  == $user_id)) {
				$call = BeanFactory::newBean('Calls');

				if($current_user->id  == $user_id) {
					$call->disable_row_level_security = true;
				}

				$where = CalendarActivity::get_occurs_within_where_clause($call->table_name, $call->rel_users_table, $view_start_time, $view_end_time, 'date_start', $view);
				$focus_calls_list = build_related_list_by_user_id($call,$user_id,$where,$fill_additional_column_fields);

				foreach($focus_calls_list as $call) {
					if(isset($seen_ids[$call->id])) {
						continue;
					}
					$seen_ids[$call->id] = 1;

					$act = new CalendarActivity($call);
					if(!empty($act)) {
                        //use UTC formatted start and end date as key, this makes for easier sorting
                        $act_list[$act->start_time->format('Ymd\THi00\Z').'/'.$act->end_time->format('Ymd\THi00\Z').'/'.$act->dotb_bean->id] = $act;
					}
				}
			}
		}


		if($show_tasks){
			if(ACLController::checkAccess('Tasks', 'list',$current_user->id == $user_id)) {
				$task = BeanFactory::newBean('Tasks');

				$where = CalendarActivity::get_occurs_within_where_clause('tasks', '', $view_start_time, $view_end_time, 'date_due', $view);
				$where .= " AND tasks.assigned_user_id='$user_id' ";

				$focus_tasks_list = $task->get_full_list("", $where,true);

				if(!isset($focus_tasks_list)) {
					$focus_tasks_list = array();
				}

				foreach($focus_tasks_list as $task) {
					$act = new CalendarActivity($task);
					if(!empty($act)) {
                        //use UTC formatted start and end date as key, this makes for easier sorting
                        $act_list[$act->start_time->format('Ymd\THi00\Z').'/'.$act->end_time->format('Ymd\THi00\Z').'/'.$act->dotb_bean->id] = $act;
					}
				}
			}
		}

        //recreate list of sorted calendar activities to return
        ksort($act_list);
        $act_list = array_values($act_list);

        // prepare the activity list so fields are properly escaped and return the sorted list
        return static::prepareActivities($act_list);
    }

    /**
     * Process the list of activities and ready any fields for display
     * @param array $activities List of activities to process
     * @return array The processed activities that are ready for display
     */
    protected static function prepareActivities($activities)
    {
        $actList = [];

        foreach ($activities as $index => $activity) {
            if (!empty($activity->dotb_bean->name) &&
                htmlspecialchars_decode($activity->dotb_bean->name, ENT_QUOTES) === $activity->dotb_bean->name
            ) {
                $activity->dotb_bean->name = htmlspecialchars($activity->dotb_bean->name, ENT_QUOTES);
            }

            $actList[] = $activity;
        }

        return $actList;
    }
}
