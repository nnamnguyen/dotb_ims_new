<?php


/**
 * TimePeriodsSeedData.php
 *
 * This is a class used for creating TimePeriodsSeedData.  We moved this code out from install/populateSeedData.php so
 * that we may better control and test creating default timeperiods.
 *
 */

class TimePeriodsSeedData {

/**
 * populateSeedData
 *
 * This is a static function to create TimePeriods.
 *
 * @static
 * @return array Array of TimePeriods created
 */
public static function populateSeedData()
{
    //Simulate settings to create 2 forward and 2 backward timeperiods
    $settings = array();
    $settings['timeperiod_start_date'] = date("Y") . "-01-01";
    $settings['timeperiod_interval'] = TimePeriod::ANNUAL_TYPE;
    $settings['timeperiod_leaf_interval'] = TimePeriod::QUARTER_TYPE;
    $settings['timeperiod_shown_backward'] = 2;
    $settings['timeperiod_shown_forward'] = 2;

    $timePeriod = TimePeriod::getByType(TimePeriod::ANNUAL_TYPE);
    $timePeriod->rebuildForecastingTimePeriods(array(), $settings);
    $ids = TimePeriod::get_not_fiscal_timeperiods_dom();
    $timeperiods = array();
    foreach($ids as $id=>$name) {
        $timeperiods[$id] = TimePeriod::getBean($id);
    }
    return $timeperiods;
}

}