<?php


/**
 * External API to news feed system
 * @api
 */
interface WebFeed
{
    /**
     * @deprecated This is a depreciated method and will be removed in version 7.3.
     */
    public function getLatestUpdates($maxTime, $maxEntries);
}
