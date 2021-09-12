<?php

// TODO REMOVE THIS FILE
$viewdefs ['Meetings'] =
array (
  'QuickCreate' =>
  array (
    'templateMeta' =>
    array (
      'maxColumns' => '2',
      'form' =>
      array (
        'hidden' =>
        array (
           '<input type="hidden" name="isSaveAndNew" value="false">',
        ),
        'buttons' =>
        array (

          array (
            'customCode' => '<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button" onclick="DOTB.meetings.fill_invitees();this.form.action.value=\'Save\'; this.form.return_action.value=\'DetailView\'; {if isset($smarty.request.isDuplicate) && $smarty.request.isDuplicate eq "true"}this.form.return_id.value=\'\'; {/if}return check_form(\'EditView\');" type="submit" name="button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">',
          ),
           'CANCEL',

          array (
            'customCode' => '<input title="{$MOD.LBL_SEND_BUTTON_TITLE}" class="button" onclick="this.form.send_invites.value=\'1\';DOTB.meetings.fill_invitees();this.form.action.value=\'Save\';this.form.return_action.value=\'EditView\';this.form.return_module.value=\'{$smarty.request.return_module}\';return check_form(\'EditView\');" type="submit" name="button" value="{$MOD.LBL_SEND_BUTTON_LABEL}">',
          ),

          array (
            'customCode' => '{if $fields.status.value != "Held"}<input title="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_TITLE}" accessKey="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_KEY}" class="button" onclick="DOTB.meetings.fill_invitees(); this.form.status.value=\'Held\'; this.form.action.value=\'Save\'; this.form.return_module.value=\'Meetings\'; this.form.isDuplicate.value=true; this.form.isSaveAndNew.value=true; this.form.return_action.value=\'EditView\'; this.form.return_id.value=\'{$fields.id.value}\'; return check_form(\'EditView\');" type="submit" name="button" value="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_LABEL}">{/if}',
          ),
        ),
      ),
      'widths' =>
      array (

        array (
          'label' => '10',
          'field' => '30',
        ),

        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'javascript' => '<script type="text/javascript">{$JSON_CONFIG_JAVASCRIPT}</script>
<script>toggle_portal_flag();function toggle_portal_flag()  {literal} { {/literal} {$TOGGLE_JS} {literal} } {/literal} </script>',
      'useTabs' => false,
    ),
    'panels' =>
    array (
      'default' =>
      array (

        array (

          array (
            'name' => 'name',
            'displayParams' =>
            array (
              'required' => true,
            ),
          ),

          array (
            'name' => 'status',
            'fields' =>
            array (

              array (
                'name' => 'status',
              ),
            ),
          ),
        ),
        array(
        	'type',
        	'password'
        ),
        array (

          array (
            'name' => 'date_start',
            'type' => 'datetimecombo',
            'displayParams' =>
            array (
              'required' => true,
              'updateCallback' => 'DotbWidgetScheduler.update_time();',
            ),
          ),

          array (
            'name' => 'parent_name',
            'label' => 'LBL_LIST_RELATED_TO',
          ),
        ),
        
        array (
          array (
            'name' => 'date_end',
            'type' => 'datetimecombo',
            'displayParams' =>
            array (
              'required' => true,
              'updateCallback' => 'DotbWidgetScheduler.update_time();',
            ),
          ),
          array (
            'name' => 'location',
            'comment' => 'Meeting location',
            'label' => 'LBL_LOCATION',
          ),
        ),
        
        array(        
          array (
            'name' => 'duration',
            'customCode' => '
                @@FIELD@@
                <input id="duration_hours" name="duration_hours" type="hidden" value="{$fields.duration_hours.value}">
                <input id="duration_minutes" name="duration_minutes" type="hidden" value="{$fields.duration_minutes.value}">
                {dotb_getscript file="modules/Meetings/duration_dependency.js"}
                <script type="text/javascript">
                    var date_time_format = "{$CALENDAR_FORMAT}";
                    {literal}
                    DOTB.util.doWhen(function(){return typeof DurationDependency != "undefined" && typeof document.getElementById("duration") != "undefined"}, function(){
                        var duration_dependency = new DurationDependency("date_start","date_end","duration",date_time_format);
                        //initEditView(YAHOO.util.Selector.query(\'select#duration\')[0].form);
                    });
                    {/literal}
                </script>            
            ',
          ),          
          array (
            'name' => 'reminder_time',
            'customCode' => '{include file="modules/Meetings/tpls/reminders.tpl"}',
            'label' => 'LBL_REMINDER',
          ),
       ),

         array (
         	 array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO_NAME',
          ),
            array (
              'name' => 'team_name',
            ),

        ),

        array (

          array (
            'name' => 'description',
            'comment' => 'Full text of the note',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
      ),
    ),
  ),
);
?>
