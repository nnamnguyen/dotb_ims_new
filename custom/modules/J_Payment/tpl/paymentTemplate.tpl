{literal}
    <style type="text/css">
.alert-box {
    color: #555;
    border :1px solid;
    border-radius: 10px;
    font-family: Tahoma,Geneva,Arial,sans-serif;
    font-size: 11px;
    padding: 10px 36px;
    margin: 10px;
}
.alert-box span {
    font-weight: bold;
    text-transform: uppercase;
}
.warning {
    background: #fff8c4 url('images/warning.png') no-repeat 10px 50%;
    border-color: #f2c779;
}
.warning span {
    color: #9d9c49;
}
    </style>
{/literal}

{dotb_getscript file="custom/include/javascript/Mask-Input/jquery.mask.min.js"}
<div class="diaglog_payment" title="{$MOD.LBL_DIALOG_RECEIPT}" style="display:none;">
    <table width="100%"  class="payment_detail">
        <tbody>
        <input type="hidden" id="dt_payment_detail_id" value>
        <input type="hidden" id="dt_unpaid_amount" value>
        <input type="hidden" id="dt_handle_action" value>
            <tr style="height: 50px;">
                <td><b> {$MOD.LBL_PAYMENT_METHOD}:</b> <span class="required">*</span> </td>
                <td style="color: blue;font-weight: bold" colspan="3" id="dt_payment_method">
                {html_options title=$MOD.LBL_PAYMENT_METHOD name="payment_method" id="payment_method" options=$fields.payment_method.options}
                {html_options style="display: none; width:120px;" name="card_type" id="card_type" title=$MOD.LBL_CARD_TYPE options=$card_type selected=$fields.card_type.value}
                {html_options style="display: none; width:120px;" name="bank_type" id="bank_type" title=$MOD.LBL_BANK_TYPE options=$bank_type selected=$fields.card_type.value}
                <input style="display: none;  width:120px;" type="text" name="method_note" id="method_note" size="20" maxlength="100" title="{$MOD.LBL_METHOD_NOTE}">
                </td>
            </tr>
            <tr style="height: 50px;" style="display: none;">
                <td style="vertical-align: middle; width: 150px;"><b>{$MOD.LBL_BANK_ACCOUNT}:</b></td>
                <td>{html_options name="bank_account" id="bank_account" title=$MOD.LBL_BANK_ACCOUNT options=$bank_receive_list selected=$fields.bank_account.value}</td>
            </tr>
<!--            <tr style="height: 50px;">
                <td style="vertical-align: middle; width: 150px;"><b>{$MOD.LBL_INV_CODE}:</b> <span class="required">*</span></td>
                <td>
                <input class="no-align" size="20" type="text" title="{$MOD.LBL_INV_CODE}" name="inv_code" id="inv_code" style="font-weight: bold; color: rgb(165, 42, 42); text-transform: uppercase;"/>
                </td>
            </tr>-->
            <tr style="height: 50px;" style="display: none;">
                <td style="vertical-align: middle; width: 150px;"><b>{$MOD.LBL_POS_CODE}:</b> <span class="required">*</span></td>
                <td>
                <input class="no-align" size="20" type="text" title="{$MOD.LBL_POS_CODE}" name="pos_code" id="pos_code" style="font-weight: bold; color: rgb(165, 42, 42); text-transform: uppercase;"/>
                </td>
            </tr>
            <tr style="height: 50px;">
                <td style="vertical-align: middle; width: 150px;"><b>{$MOD.LBL_PAYMENT_AMOUNT}:</b> <span class="required">*</span></td>
                <td>
                    <input class="currency no-align" size="20" type="text" title="{$MOD.LBL_RECEIPT_AMOUNT}" name="dt_payment_amount" id="dt_payment_amount" style="font-weight: bold; color: rgb(165, 42, 42); text-align: left;"/>
                </td>
            </tr>
            <tr style="height: 50px;">
                <td style="vertical-align: middle; width: 150px;"><b>{$MOD.LBL_RECEIPT_DATE}:</b> <span class="required">*</span></td>
                <td><span class="dateTime"><input readonly class="input_readonly" title="{$MOD.LBL_RECEIPT_DATE}" name="payment_date_collect" size="10" id="payment_date_collect" type="text" value="{$today}">  <img border="0" src="custom/themes/default/images/jscalendar.png" alt="Enter Date" id="payment_date_trigger" align="absmiddle"></span></td>
            </tr>
            <tr style="height: 50px;">
                <td style="vertical-align: middle; width: 150px;"><b>{$MOD.LBL_MONEY_RECEIVER}:</b></td>
                <td><span id='dt_receiver'>{$current_user_name}</span></td>
            </tr>
            <tr style="height: 50px;"><td colspan="2"><hr></td></tr>
            <tr style="height: 50px;">
                <td style="vertical-align: middle; width: 150px;"><b>{$MOD.LBL_DESCRIPTION}:</b></td>
                <td>
                <textarea id="dt_description" title="{$MOD.LBL_DESCRIPTION}" name="dt_description" rows="2" cols="30" tabindex="0"></textarea></td>
            </tr>
<!--            <tr style="height: 50px;">
                <td style="vertical-align: middle; width: 150px;"><b>{$MOD.LBL_REFERENCE_DOCUMENT}:</b></td>
                <td><input title="{$MOD.LBL_REFERENCE_DOCUMENT}" size="10" type="text" name="dt_reference_document" id="dt_reference_document">
                <b>{$MOD.LBL_REFERENCE_NUMBER}</b>
                <input title="{$MOD.LBL_REFERENCE_NUMBER}" size="3" type="text" name="dt_reference_number" id="dt_reference_number">
                </td>
            </tr>-->
            <tr style="height: 50px;">
                <td style="text-align: center" colspan="4">
                    <input type="button" class="button primary" action="save" id="btn_dt_save" value="{$MOD.LBL_SAVE}"></input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="button" id="btn_dt_cancel" value="{$MOD.LBL_CANCEL}"></input>
                </td>
            </tr>
        </tbody>
    </table>
</div>
