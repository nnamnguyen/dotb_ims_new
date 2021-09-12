<?php


$viewdefs['portal']['layout']['portal-list'] = array (
  'components' => array (
    array (
      'view' => 'portal-list-top',
    ),
    array (
      'view' => 'filter',
    ),
    array (
      'view' => 'list',
    ),
    array (
      'view' => 'list-bottom',
    ),
  ),
  'type' => 'simple',
  'name' => 'dashboard-list',
  'span' => 12,
  'css_class' => 'thumbnail',
);
