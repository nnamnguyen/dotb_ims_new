<?php


/**
 * TimePeriodInterface.php
 *
 * interface definition for TimePeriod subclasses used by the forecasting components
 */
interface TimePeriodInterface
{
    public function getLengthInDays();

    public function getNextTimePeriod();

    public function getPreviousTimePeriod();

    public function setStartDate($start_date=null);

    /**
     * Returns the formatted chart labels for the chart data supplied
     *
     * @see include/DotbForecasting/Chart/Individual.php
     * @param $chartData Array of chart data based on the incoming parameters sent
     * @return mixed Array of formatted chart data with the corresponding time intervals
     */
    public function getChartLabels($chartData);

    /**
     * Returns the chart label key for the data set given the closed date of a record
     *
     * @see include/DotbForecasting/Chart/Individual.php
     * @param $dateClosed Database date format (2012-01-01) of date closed
     * @return String of the key used for the data set
     */
    public function getChartLabelsKey($dateClosed);
}
?>