{dotb_getscript file="custom/modules/J_Payment/js/dropPayment.js"}
<div id="drop_payment_dialog" title="Drop Payment" style="display:none;">
        <input id="dl_student_id" type="hidden" value=""/>
        <input id="drop_amount_raw" type="hidden" value=""/>
        <input id="drop_hour_raw" type="hidden" value=""/>
        <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>{$MOD.LBL_DIALOG_DROP}<br><br>
        <br>{$MOD.LBL_STEP1_DROP} <span class="required">*</span>
        <span class="dateTime" style="margin-right: 70px;margin-left: 10px;">
            <input disabled name="dl_date" size="10" id="dl_date" type="text" value="{$today}">
            <img border="0" src="custom/themes/default/images/jscalendar.png" alt="Drop Date" id="dl_date_trigger" align="absmiddle"></span>

        <br><br>{$MOD.LBL_STEP2_DROP}<br>
        <table>
            <tbody>
                <tr>
                	 <td width="20%"> <span>{$MOD.LBL_TOTAL_PAID_DROP} </span></td>
                	 <td width="30%"> <span id="dl_total_amount" style="font-weight:bold;">0</span></td>
                </tr>
                <tr>
                    <td width="20%"><span>{$MOD.LBL_TOTAL_USED_DROP} </span></td>
                    <td width="30%"><span id="dl_used_amount" style="font-weight:bold;">0</span> </td>
                </tr>
                <tr>
                	<td width="20%"><span>{$MOD.LBL_TOTAL_DROP} </span></td>
                	<td width="30%"><span id="dl_drop_amount" style="font-weight:bold;">0</span>
                    <span style="font-weight:bold;"> &asymp; <span id="dl_drop_hour" style="font-weight:bold;">0</span> {$MOD.HOURS} </span> </td>
                </tr>
            </tbody>
        </table>
        <br>
        <b>{$MOD.LBL_STEP3_DROP} <span class="required">*</span></b><br>
        <textarea cols="50" rows="2" style="margin-top: 5px;" id="dl_reason"></textarea><br><br>
        <b>{$MOD.LBL_STEP4_DROP}</b>
        <span class="btn_drop_to_delay"><br>{$MOD.LBL_DELAY_DES_DROP}</span><br>
        <span class="btn_drop_to_revenue"><br>{$MOD.LBL_REVEN_DES_DROP}<br></span>
        <br>{$MOD.LBL_CANCEL_DES}
        <br><br> {$MOD.LBL_DELAY_DES2_DROP}<br><br>
</div>