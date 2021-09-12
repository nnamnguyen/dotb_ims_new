<div id="diaglog_convert_payment" title="{$MOD.LBL_CONVERT_PAYMENT}" style="display:none;">
    <table width="100%"  class="edit view">
    <input type="hidden" id="cp_payment_amount" value="{dotb_number_format var=$fields.payment_amount.value}">
    <input type="hidden" id="cp_remain_amount" value="{dotb_number_format var=$fields.remain_amount.value}">
        <tbody>
            <tr>
                <td width="50%">{$MOD.LBL_USE_TYPE} :</td>
                <td width="50%">{html_options name="cp_convert_type" id="cp_convert_type" options=$convertTypeList selected=$convertType}
                </td>
            </tr>
            <tr>
                <td>{$MOD.LBL_TOTAL_AMOUNT} :</td>
                <td>{dotb_number_format var=$fields.payment_amount.value}</td>
            </tr>
            <tr>
                <td>{$MOD.LBL_TUITION_HOURS} :<span style="color:red;">*</span></td>
                <td><input name="cp_tuition_hours" style="color: rgb(165, 42, 42);" size="10" id="cp_tuition_hours" type="text" value="{dotb_number_format var=$fields.tuition_hours.value}"></td>
            </tr>
            <tr>
                <td>{$MOD.LBL_REMAIN_AMOUNT} :</td>
                <td>{dotb_number_format var=$fields.remain_amount.value}</td>
            </tr>
            <tr>
                <td>{$MOD.LBL_REMAIN_HOURS} :<span style="color:red;">*</span></td>
                <td><input name="cp_remain_hours" style="color: rgb(165, 42, 42);" size="10" id="cp_remain_hours" type="text" value="{dotb_number_format var=$fields.remain_hours.value}"></td>
            </tr>
            <tr>
                <td style="colspan=2">
                    <input type="button" id="btn_submit_convert" value="{$MOD.LBL_SUBMIT}"/>
                </td>
            </tr>
        </tbody>
    </table>
</div>