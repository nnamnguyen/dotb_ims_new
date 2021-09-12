<?php

$viewdefs['KBContents']['base']['layout']['subpanels'] = array (
  'components' => array (
      array(
          'layout' => 'subpanel',
          'label' => 'LBL_LOCALIZATIONS_SUBPANEL_TITLE',
          'override_subpanel_list_view' => 'subpanel-for-localizations',
          'override_paneltop_view' => 'panel-top-for-localizations',
          'context' => array(
              'link' => 'localizations',
          ),
      ),
      array(
          'layout' => 'subpanel',
          'label' => 'LBL_REVISIONS_SUBPANEL_TITLE',
          'override_subpanel_list_view' => 'subpanel-for-revisions',
          'override_paneltop_view' => 'panel-top-for-revisions',
          'context' => array(
              'link' => 'revisions',
          ),
      ),
      array(
          'layout' => 'subpanel',
          'label' => 'LBL_NOTES_SUBPANEL_TITLE',
          'context' => array(
              'link' => 'notes',
          ),
      ),
  ),
);
