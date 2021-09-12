{*

*}

<table width="100%" cellpadding="0" cellspacing="0" border="0" class="actionsContainer">
    <tr>
        <td>
        <input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accesskey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button primary" onclick="quickEditSave(); return false;" type="submit" name="Users_dcmenu_save_button" id="Users_dcmenu_save_button" value="Save">
        {{foreach from=$form.buttons key=val item=button}}
           {{dotb_button module="$module" id="$button" view="$view"}}
        {{/foreach}}
        </td>
        <td align="right" nowrap>
            <span class="required">{$APP.LBL_REQUIRED_SYMBOL}</span> {$APP.NTC_REQUIRED}
        </td>
    </tr>
</table>
<script type='text/javascript'>
{literal}

function quickEditSave()
{
    document.form_DCQuickCreate_Users.action.value='Save';

    if(check_form('form_DCQuickCreate_Users'))
    {
        if(quickEditconfirmReassignRecords())
        {
        DCMenu.save(document.form_DCQuickCreate_Users.id, 'Users_subpanel_save_button');
        }
    }
}

function quickEditconfirmReassignRecords() {
        var status = document.getElementsByName('status');
        if(status[0] && status[0].value == 'Inactive')
        {
            var r = confirm(DOTB.language.get('Users','LBL_REASS_CONFIRM_REASSIGN'));
            if(r == true)
            {
                document.form_DCQuickCreate_Users.return_action.value = 'reassignUserRecords';
                document.form_DCQuickCreate_Users.return_module.value = 'Users';
                document.form_DCQuickCreate_Users.submit();
                return false;
            }
        }
        return true;
}
{/literal}
</script>