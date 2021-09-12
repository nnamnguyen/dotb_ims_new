<?php

/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

$tracker_config = 
  array (
    'tracker' => 
    array (
      'bean' => 'Tracker',
      'name' => 'Tracker',
      'metadata' => 'modules/Trackers/vardefs.php',
      'store' => 
      array (
        0 => 'DatabaseStore',
      ),
    ),
    'tracker_sessions' => 
    array (
      'bean' => 'TrackerSession',
      'name' => 'tracker_sessions',
      'metadata' => 'modules/Trackers/tracker_sessionsMetaData.php',
      'store' => 
      array (
        0 => 'TrackerSessionsDatabaseStore',
      ),
    ),
    'tracker_perf' => 
    array (
      'bean' => 'TrackerPerf',
      'name' => 'tracker_perf',
      'metadata' => 'modules/Trackers/tracker_perfMetaData.php',
      'store' => 
      array (
        0 => 'DatabaseStore',
      ),
    ),
    'tracker_queries' => 
    array (
      'bean' => 'TrackerQuery',
      'name' => 'tracker_queries',
      'metadata' => 'modules/Trackers/tracker_queriesMetaData.php',
      'store' => 
      array (
        0 => 'TrackerQueriesDatabaseStore',
      ),
    ),
    'tracker_tracker_queries' => 
    array (
      'name' => 'tracker_tracker_queries',
      'metadata' => 'modules/Trackers/tracker_tracker_queriesMetaData.php',
      'store' => 
      array (
        0 => 'DatabaseStore',
      ),
    ),
  );
?>
