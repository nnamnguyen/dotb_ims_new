<table id="tblbook" width="100%" border="1" class="" style="display: none;">
    <thead>
        <tr>
            <th width="40%" style="text-align: center;">{$MOD.LBL_BOOK_NAME}<span class="required">*</span></th>
            <th width="10%" style="text-align: center;">{$MOD.LBL_UNIT}<span class="required"></span></th>
            <th width="10%" style="text-align: center;">{$MOD.LBL_QUATITY}<span class="required">*</span></th>
            <th width="10%" style="text-align: center;">{$MOD.LBL_PRICE}</th>
            <th width="10%" style="text-align: center;">{$MOD.LBL_AMOUNT}</th>
            <td width="5%" style="text-align: left;"><button class="button primary" type="button" id="btnAddrow"><b> + </b></button></td>
        </tr>
    </thead>
    <tbody id="tbodybook">
        {$html_tpl}
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" style="text-align: right;"><b>{$MOD.LBL_TOTAL_AMOUNT} : </b></td>
            <td style="text-align: center;"><input class="currency input_readonly" type="text" name="total_book_pay" id="total_book_pay" size="13" value=" {dotb_number_format var=$fields.payment_amount.value}" style="font-weight: bold;" readonly></td></tr>
    </tfoot>
</table>