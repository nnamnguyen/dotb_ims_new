<?php
$viewdefs['CJ_WebHooks'] = 
array (
  'base' => 
  array (
    'view' => 
    array (
      'record' => 
      array (
        'panels' => 
        array (
          0 => 
          array (
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_HEADER',
            'header' => true,
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'picture',
                'type' => 'avatar',
                'width' => 42,
                'height' => 42,
                'dismiss_label' => true,
                'readonly' => true,
              ),
              1 => 'name',
              2 => 
              array (
                'name' => 'favorite',
                'label' => 'LBL_FAVORITE',
                'type' => 'favorite',
                'dismiss_label' => true,
              ),
              3 => 
              array (
                'name' => 'follow',
                'label' => 'LBL_FOLLOW',
                'type' => 'follow',
                'readonly' => true,
                'dismiss_label' => true,
              ),
            ),
          ),
          1 => 
          array (
            'name' => 'panel_body',
            'label' => 'LBL_PANEL_BODY',
            'columns' => 2,
            'labelsOnTop' => true,
            'placeholders' => true,
            'newTab' => false,
            'panelDefault' => 'expanded',
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'parent_name',
                'label' => 'LBL_PARENT',
              ),
              1 => 
              array (
                'name' => 'active',
                'label' => 'LBL_ACTIVE',
              ),
              2 => 
              array (
                'name' => 'sort_order',
                'label' => 'LBL_SORT_ORDER',
              ),
              3 => 
              array (
                'name' => 'trigger_event',
                'label' => 'LBL_TRIGGER_EVENT',
              ),
              4 => 
              array (
                'name' => 'request_method',
                'label' => 'LBL_REQUEST_METHOD',
              ),
              5 => 
              array (
                'name' => 'ignore_errors',
                'label' => 'LBL_IGNORE_ERRORS',
              ),
              6 => 
              array (
                'name' => 'url',
                'label' => 'LBL_URL',
                'span' => 12,
              ),
              7 => 
              array (
                'name' => 'request_format',
                'label' => 'LBL_REQUEST_FORMAT',
              ),
              8 => 
              array (
                'name' => 'response_format',
                'label' => 'LBL_RESPONSE_FORMAT',
              ),
              9 => 
              array (
                'name' => 'headers',
                'label' => 'LBL_HEADERS',
                'span' => 6,
              ),
              10 => 
              array (
                'name' => 'description',
                'comment' => 'Full text of the note',
                'label' => 'LBL_DESCRIPTION',
                'span' => 6,
              ),
              11 => 'team_name',
              12 => 
              array (
                'name' => 'error_message_path',
                'label' => 'LBL_ERROR_MESSAGE_PATH',
                'span' => 6,
              ),
              13 => 
              array (
                'name' => 'date_entered_by',
                'readonly' => true,
                'type' => 'fieldset',
                'label' => 'LBL_DATE_ENTERED',
                'fields' => 
                array (
                  0 => 
                  array (
                    'name' => 'date_entered',
                  ),
                  1 => 
                  array (
                    'type' => 'label',
                    'default_value' => 'LBL_BY',
                  ),
                  2 => 
                  array (
                    'name' => 'created_by_name',
                  ),
                ),
              ),
              14 => 
              array (
                'name' => 'date_modified_by',
                'readonly' => true,
                'type' => 'fieldset',
                'label' => 'LBL_DATE_MODIFIED',
                'fields' => 
                array (
                  0 => 
                  array (
                    'name' => 'date_modified',
                  ),
                  1 => 
                  array (
                    'type' => 'label',
                    'default_value' => 'LBL_BY',
                  ),
                  2 => 
                  array (
                    'name' => 'modified_by_name',
                  ),
                ),
              ),
            ),
          ),
        ),
        'templateMeta' => 
        array (
          'useTabs' => false,
        ),
      ),
    ),
  ),
);
