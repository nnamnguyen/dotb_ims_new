<div id="dialog_discount" title="Get Discount" style="display:none;">
    <table id="table_discount" style="width: 100%;display:block;" class="list view">
        <tbody style="height: 350px; display: inline-block; width: 100%; overflow: auto;">
             <tr colspan = "6">
                <th width="5%" style="text-align:center"></th>
                <th width="25%" style="text-align:center">{$MOD.LBL_DISCOUNT_NAME}</th>
                <th width="10%" style="text-align:center">{$MOD.LBL_DISCOUNT_PERCENT}</th>
                <th width="15%" style="text-align:center">{$MOD.LBL_DISCOUNT_AMOUNT}</th>
                <th width="20%" style="text-align:center">{$MOD.LBL_DISCOUNT_POLICY}</th>
                <th width="25%" style="text-align:center">{$MOD.LBL_DESCRIPTION}</th>
            </tr>
            {$discount_rows}
        </tbody>
    </table><br>
    <table width="100%">
<!--        <tr>
            <td width="45%" align="right"><span style="font-weight: bold;" class="loy_student_name"></span></td>
            <td colspan="2" style="padding: 6px 0 0 11px;">{if $enable_loyalty} Membership Level: <span class="loy_loyalty_mem_level"></span>{/if}</td>
        </tr>  -->
        <tr>
            <td width="45%" align="right">1. {$MOD.LBL_AMOUNT_BEF_DISCOUNT}:</td>
            <td width="10%" align="right" class="dis_amount_bef_discount"></td>
            <td width="35%" align="left" scope="col"></td>
        </tr>

        <tr>
            <td width="45%" align="right">2. {$MOD.LBL_DISCOUNT_AMOUNT}:</td>
            <td width="10%" align="right" class="dis_discount_amount"></td>
            <td width="35%" align="left"></td>
        </tr>

        <tr>
            <td width="45%" align="right">3. {$MOD.LBL_DISCOUNT_PERCENT}:</td>
            <td width="10%" align="right" class="dis_discount_percent"></td>
            <input type="hidden" class="dis_discount_percent_to_amount" value="">
            <input type="hidden" id="dis_hours" name="dis_hours" value="{dotb_number_format var=$fields.dis_hours.value precision=2}">
            <input type="hidden" class="dis_discount_percent_p" value="">
            <input type="hidden" class="dis_not_count_limit_amount" value="">
            <input type="hidden" class="total_hours_reduced" id="total_hours_reduced" value="0">
            <input type="hidden" class="total_hours_extend" id="total_hours_extend" value="0">
            <input type="hidden" class="total_add_duration_exp" id="total_add_duration_exp" value="0">
            <td width="35%" align="left"></td>
        </tr>

        <tr>
            <td width="45%" align="right">4. {$MOD.LBL_TOTAL_DISCOUNT} = ((1 - 2) x 3) + 2:</td>
            <td width="10%" align="right" class="dis_total_discount"></td>
        </tr>

        <tr>
            <td width="45%" align="right">5. {$MOD.LBL_FINAL_DISCOUNT}:</td>
            <td width="10%" align="right" class="dis_final_discount"></td>
            <td width="35%" align="left"><p style="color: red;margin: 0;" class="dis_alert_discount"></p><input type="hidden" class="dis_final_discount_percent" value=""></td>
        </tr>
    </table>
</div>