<?php



$viewdefs['Project']['EditView'] =
    array( 'templateMeta' =>
        array( 
            'maxColumns' => '2',
            'widths' => array (
                array('label' => '10', 'field' => '30'),
                array('label' => '10', 'field' => '30')
            ),
            'form' => array(
                'hidden'=>'<input type="hidden" name="is_template" value="{$is_template}" />',
                'buttons'=> array(
                    'SAVE',         
                    array( 'customCode' =>
                        '{if !empty($smarty.request.return_action) && $smarty.request.return_action == "ProjectTemplatesDetailView" && (!empty($fields.id.value) || !empty($smarty.request.return_id)) }'.
                        '<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="this.form.action.value=\'ProjectTemplatesDetailView\'; this.form.module.value=\'{$smarty.request.return_module}\'; this.form.record.value=\'{$smarty.request.return_id}\';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL{$place}"> '.
                        '{elseif !empty($smarty.request.return_action) && $smarty.request.return_action == "DetailView" && (!empty($fields.id.value) || !empty($smarty.request.return_id)) }'.
                        '<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="this.form.action.value=\'DetailView\'; this.form.module.value=\'{$smarty.request.return_module}\'; this.form.record.value=\'{$smarty.request.return_id}\';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL{$place}"> '.
                        '{elseif $is_template}'.
                        '<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="this.form.action.value=\'ProjectTemplatesListView\'; this.form.module.value=\'{$smarty.request.return_module}\'; this.form.record.value=\'{$smarty.request.return_id}\';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL{$place}"> '.
                        '{else}'.
                        '<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="this.form.action.value=\'index\'; this.form.module.value=\'{$smarty.request.return_module}\'; this.form.record.value=\'{$smarty.request.return_id}\';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL{$place}"> '.
                        '{/if}', 
                    ),
                 ),
            )
        ),
         'panels' =>    array( 
             'lbl_project_information' => array(
                array('name','status',),
                array('estimated_start_date','priority'),
                array('estimated_end_date'),
                array('description'),
            ),
            'LBL_PANEL_ASSIGNMENT' => array(
                   array (
                       'assigned_user_name',

                      'team_name',
                ),
              )
          )
    );
?>
