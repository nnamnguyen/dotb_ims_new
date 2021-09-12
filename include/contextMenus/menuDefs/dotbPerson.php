<?php


global $app_strings;

$menuDef['dotbPerson'] = array(
    array('text' => 'LBL_ADD_TO_FAVORITES', 
          'action' => 'DOTB.contextMenu.actions.addToFavorites'),
    array('text' => 'LBL_CREATE_NOTE', 
          'action' => 'DOTB.contextMenu.actions.createNote',
          'module' => 'Notes',
          'aclAction' => 'edit'),
    array('text' => 'LBL_CREATE_TASK', 
          'action' => 'DOTB.contextMenu.actions.createTask',
          'module' => 'Tasks',
          'aclAction' => 'edit'),
    array('text' => 'LBL_SCHEDULE_MEETING', 
          'action' => 'DOTB.contextMenu.actions.scheduleMeeting',
          'module' => 'Meetings',
          'aclAction' => 'edit'),
    array('text' => 'LBL_SCHEDULE_CALL', 
          'action' => 'DOTB.contextMenu.actions.scheduleCall',
          'module' => 'Calls',
          'aclAction' => 'edit'),
    );

?>