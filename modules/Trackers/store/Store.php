<?php

/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
 
interface Store {

    /**
     * flush
     * This is the method implementations need to provide to store a monitor instance
     * @param Monitor $monitor The monitor whose data need to be flushed
     */
    public function flush($monitor);

}
