<?php


interface DotbForecasting_ForecastSaveInterface
{
    /**
     * This is used when you want to have a class utilize a save method() for the Forecasting API
     *
     * @return mixed
     */
    public function save();
}