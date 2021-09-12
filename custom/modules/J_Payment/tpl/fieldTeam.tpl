<table style="padding:0px!important;">
    <tr>
        <td style="padding: 0px !important;">
            <input accesskey="7" tabindex="0" type="text" class="input_readonly" name="team_name" id="team_name" maxlength="255" value="{$fields.team_name.value}" size="25" readonly="">
        </td>
        <td>
            <input type="text" name="team_id" id="team_id" value="{$fields.team_id.value}" style="display:none;">
            <span class="id-ff multiple">
                <button type="button" {if $lock_team == 1}disabled{/if} id="btn_team_id" style="margin-right: -4px;margin-top: -1px;" tabindex="0" title="{$APPS.LBL_ID_FF_SELECT}" class="button firstChild"><img src="themes/default/images/id-ff-select.png"></button>
                <button type="button" {if $lock_team == 1}disabled{/if} id="btn_clr_team_id" style="margin-right: -4px;margin-top: -1px;" tabindex="0" title="{$APPS.LBL_ID_FF_CLEAR}" class="button lastChild"><img src="themes/default/images/id-ff-clear.png"></button>
            </span>
        </td>
    </tr>
</table>
