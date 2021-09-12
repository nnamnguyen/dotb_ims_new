<?php

/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/


/**
 * Database
 * This is an implementation of the Store interface where the storage uses
 * the configured database instance as defined in DBManagerFactory::getInstance() method
 *
 */
class DatabaseStore implements Store {

    /** {@inheritDoc} */
    public function flush($monitor)
    {
        $values = $monitor->toArray();
        $values = array_filter($values);

        if (count($values) < 1) {
            return;
        }

        $dictionary = array();
        require $monitor->metricsFile;

        DBManagerFactory::getInstance()->insertParams(
            $monitor->table_name,
            $dictionary[$monitor->name]['fields'],
            $values
        );
    }
}
