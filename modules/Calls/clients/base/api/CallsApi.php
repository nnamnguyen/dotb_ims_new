<?php


class CallsApi extends CalendarEventsApi
{
    /**
     * {@inheritdoc}
     */
    public function registerApiRest()
    {
        $register = array();  // No Calls-Specific API beyond what is being implemented in Superclass

        return parent::getRestApi("Calls", $register);
    }
}
