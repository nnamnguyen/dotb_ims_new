<?php


class TimePeriodsCurrentApi extends DotbApi
{
    public function registerApiRest()
    {
        return array(
            'currentTimeperiod' => array(
                'reqType' => 'GET',
                'path' => array('TimePeriods', 'current'),
                'pathVars' => array('module', ''),
                'method' => 'getCurrentTimePeriod',
                'jsonParams' => array(),
                'shortHelp' => 'Return the Current Timeperiod',
                'longHelp' => 'modules/TimePeriods/clients/base/api/help/TimePeriodsCurrentApi.html',
            ),
            'getTimePeriodByDate' => array(
                'reqType' => 'GET',
                'path' => array('TimePeriods', '?'),
                'pathVars' => array('module', 'date'),
                'method' => 'getTimePeriodByDate',
                'jsonParams' => array(),
                'shortHelp' => 'Return a Timeperiod by a given date',
                'longHelp' => 'modules/TimePeriods/clients/base/api/help/TimePeriodsGetByDateApi.html',
            ),
        );
    }

    public function getCurrentTimePeriod(ServiceBase $api, array $args)
    {
        $tp = TimePeriod::getCurrentTimePeriod();

        if(is_null($tp)) {
            // return a 404
            throw new DotbApiExceptionNotFound();
        }

        return $tp->toArray();
    }

    public function getTimePeriodByDate(ServiceBase $api, array $args)
    {
        if(!isset($args["date"]) || $args["date"] == 'undefined') {
            // return a 404
            throw new DotbApiExceptionNotFound();
        }

        $tp = TimePeriod::retrieveFromDate($args["date"]);

        return ($tp) ? $tp->toArray() : $tp;
    }
}
