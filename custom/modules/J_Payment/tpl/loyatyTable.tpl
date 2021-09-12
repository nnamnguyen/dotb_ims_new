<div id="dialog_loyalty" title="Loyalty Point" style="display:none;">
    <input type="hidden" id="loy_total_points" name="loy_total_points" value="">
    <input type="hidden" id="loy_points_to_spend" name="loy_points_to_spend" value="">
    <input type="hidden" id="loy_amount_to_spend" name="loy_amount_to_spend" value="">
    <input type="hidden" id="loy_loyalty_rate_out_value" name="loy_loyalty_rate_out_value" value="">

    <input type="hidden" id="loy_loyalty_rate_out_id" name="loy_loyalty_rate_out_id" value="">
    <input type="hidden" id="loy_loyalty_mem_level" name="loy_loyalty_mem_level" value="">
    <input type="hidden" id="loy_net_amount" name="loy_net_amount" value="">
    <table id="table_loyalty" width="100%" style="font-weight: bold; font-size: 13px;">
        <tr>
            <td colspan="2" align="left">
            {$MOD.LBL_STUDENT}: <span class="loy_student_name"></span> | </span> {$MOD.LBL_POINT_HAVE} <span class="loy_total_points" style="color: #b90000;">0 {$MOD.LBL_POINTS}</span>.
            {$MOD.LBL_ENTER_POINTS}:
            </td>
        </tr>
        <tr>
            <td align="right">{$MOD.LBL_LOYALTY_POINTS}:   </td>
            <td align="left"> <input type="text" id="loy_loyalty_points" name="loy_loyalty_points" size="6" maxlength="13" value="{$loy_loyalty_points}" title="{$MOD.LBL_LOYALTY_POINTS}" style="text-align: center;"> {$MOD.LBL_POINTS} (X <span class="loy_loyalty_rate_out_value"></span>)</td>
        </tr>
        <tr>
            <td colspan="2" align="left">
            {$MOD.LBL_MAX_POINTS} / {$MOD.LBL_POINTS_TO_SPEND}: <span class="loy_total_points" style="color: #b90000;" >0 </span> / <span class="loy_points_to_spend" style="font-weight: bold; color: #b90000;"></span>.
            </td>
        </tr>
    </table>
</div>