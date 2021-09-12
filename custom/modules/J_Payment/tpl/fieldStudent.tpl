<table style="padding:0px!important;">
    <tr>
        <td style="padding: 0px !important;">

            <input accesskey="7" tabindex="0" type="text" class="input_readonly" name="contacts_j_payment_1_name" id="contacts_j_payment_1_name" maxlength="255" value="{$fields.contacts_j_payment_1_name.value}" size="25" readonly="">
        </td>
        <td>
            <input type="text" name="contacts_j_payment_1contacts_ida" id="contacts_j_payment_1contacts_ida" value="{$fields.contacts_j_payment_1contacts_ida.value}" style="display:none;">
            <input type="hidden" name="json_student_info" id="json_student_info" value="{$json_student_info}">
            <span class="id-ff multiple">
                <button type="button" {if !empty($fields.contacts_j_payment_1contacts_ida.value)}disabled{/if} id="btn_select_student" style="margin-right: -4px;" tabindex="0" title="{$APPS.LBL_ID_FF_SELECT}" class="button firstChild"><img src="themes/default/images/id-ff-select.png"></button>
                <button type="button" {if !empty($fields.contacts_j_payment_1contacts_ida.value)}disabled{/if} id="btn_clr_select_student" style="margin-right: -4px;" tabindex="0" title="{$APPS.LBL_ID_FF_CLEAR}" class="button lastChild"><img src="themes/default/images/id-ff-clear.png"></button>
            </span>
            <a id="eye_dialog_123" title="View" style="cursor:pointer;"><img border="0" src="themes/RacerX/images/view_inline.png" style="margin-left:10px;margin-right:10px;"></a>
            {if $enable_loyalty}{$MOD.LBL_MEMBERSHIP_LEVEL}: <span class="loy_loyalty_mem_level"><label><span class="textbg_nocolor">N/A</span></label></span>{/if}
            <div id="dialog_student_info"></div>
        </td>
    </tr>
</table>
