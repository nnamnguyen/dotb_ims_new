<?php


global $app_strings;

$menuDef['dotbAccount'] = array(
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
    array('text' => 'LBL_CREATE_CONTACT', 
          'action' => 'DOTB.contextMenu.actions.createContact',
          'module' => 'Contacts',
          'aclAction' => 'edit'),
    array('text' => 'LBL_CREATE_OPPORTUNITY', 
          'action' => 'DOTB.contextMenu.actions.createOpportunity',
          'module' => 'Opportunties',
          'aclAction' => 'edit'),
    array('text' => 'LBL_CREATE_CASE', 
          'action' => 'DOTB.contextMenu.actions.createCase',
          'module' => 'Cases',
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