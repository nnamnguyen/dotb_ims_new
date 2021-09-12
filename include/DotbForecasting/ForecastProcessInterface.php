<?php


interface DotbForecasting_ForecastProcessInterface
{
    /**
     * This is used to run all the commands that are need to get a forecast back out of the system
     *
     * @return string|array
     */
    public function process();
}
