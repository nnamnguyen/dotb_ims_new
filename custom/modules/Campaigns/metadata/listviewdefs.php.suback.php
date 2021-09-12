<?php
// created: 2018-07-09 22:58:49
$listViewDefs['Campaigns'] = array (
  'track_campaign' => 
  array (
    'width' => '1',
    'label' => '&nbsp;',
    'link' => true,
    'customCode' => ' <a title="{$TRACK_CAMPAIGN_TITLE}" href="index.php?action=TrackDetailView&module=Campaigns&record={$ID}"><!--not_in_theme!--><img border="0" src="{$TRACK_CAMPAIGN_IMAGE}" alt="{$TRACK_VIEW_ALT_TEXT}"></a> ',
    'default' => true,
    'studio' => false,
    'nowrap' => true,
    'sortable' => false,
  ),
  'launch_wizard' => 
  array (
    'width' => '1',
    'label' => '&nbsp;',
    'link' => true,
    'customCode' => ' <a title="{$LAUNCH_WIZARD_TITLE}" href="index.php?action=WizardHome&module=Campaigns&record={$ID}"><!--not_in_theme!--><img border="0" src="{$LAUNCH_WIZARD_IMAGE}"  alt="{$LAUNCH_WIZ_ALT_TEXT}"></a>  ',
    'default' => true,
    'studio' => false,
    'nowrap' => true,
    'sortable' => false,
  ),
  'name' => 
  array (
    'width' => '20',
    'label' => 'LBL_LIST_CAMPAIGN_NAME',
    'link' => true,
    'default' => true,
  ),
  'status' => 
  array (
    'width' => '10',
    'label' => 'LBL_LIST_STATUS',
    'default' => true,
  ),
  'campaign_type' => 
  array (
    'width' => '10',
    'label' => 'LBL_LIST_TYPE',
    'default' => true,
  ),
  'assigned_user_name' => 
  array (
    'width' => '8',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
  'end_date' => 
  array (
    'width' => '10',
    'label' => 'LBL_LIST_END_DATE',
    'default' => true,
  ),
  'date_entered' => 
  array (
    'width' => '10',
    'label' => 'LBL_DATE_ENTERED',
    'default' => true,
  ),
  'team_name' => 
  array (
    'width' => '15',
    'label' => 'LBL_LIST_TEAM',
    'default' => false,
  ),
  'objective' => 
  array (
    'type' => 'text',
    'label' => 'LBL_CAMPAIGN_OBJECTIVE',
    'sortable' => false,
    'width' => '10',
    'default' => false,
  ),
  'budget' => 
  array (
    'type' => 'currency',
    'label' => 'LBL_CAMPAIGN_BUDGET',
    'currency_format' => true,
    'related_fields' => 
    array (
      0 => 'currency_id',
      1 => 'base_rate',
    ),
    'width' => '10',
    'default' => false,
  ),
);