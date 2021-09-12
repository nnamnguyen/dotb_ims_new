var payment_type = $('#payment_type').val();
$(document).ready(function(){
    $('#dl_date').on('change',function(){
        $('#dl_drop_amount').text(0);
        $('#dl_used_amount').text(0);
        $('#dl_total_amount').text(0);
        $('#drop_amount_raw').val(0);
        $('#dl_drop_hour').text(0);
        $('#drop_hour_raw').val(0);

        //Validate Data Lock
        //    var rs3 = checkDataLockDate($(this).attr('id'));
        caculateDropPayment();
    });

    $('#btn_delay_payment').live('click', function(){
        showDialogDropPayment();
        caculateDropPayment();
    });
});

//Show dialog Delay
function showDialogDropPayment(){
    $('#drop_payment_dialog').dialog({
        resizable: false,
        width: 500,
        modal: true,
        buttons: {
            "Drop to Payment Delay":{
                click:function() {
                    createDrop('drop_to_delay');
                },
                class	: 'button primary btn_drop_to_delay',
                text	: DOTB.language.get('J_Payment', 'LBL_BT_DELAY_DROP'),
            },
            "Drop to Revenue":{
                click:function() {
                    createDrop('drop_to_revenue');
                },
                class    : 'button primary btn_drop_to_revenue',
                text    : DOTB.language.get('J_Payment', 'LBL_BT_REVEN_DROP'),
            },
            "Cancel":{
                click:function() {
                    $(this).dialog('close');
                },
                class	: 'button btn_cancel_drop',
                text	: DOTB.language.get('J_Payment', 'LBL_CANCEL'),
            },
        }

    });
    //    if(payment_type != 'Delay')
    //        $('.btn_drop_to_revenue').remove();
    //    else $('.btn_drop_to_delay').remove();
}

function caculateDropPayment(){
    var dl_date 	= $('#dl_date').val();
    if(dl_date == ''){
        $('#dl_drop_amount').text(0);
        $('#dl_used_amount').text(0);
        $('#dl_total_amount').text(0);
        $('#dl_drop_hour').text(0);
        $('#drop_amount_raw').val(0);
        $('#drop_hour_raw').val(0);
        return ;
    }
    $('.btn_drop_to_delay, .btn_drop_to_revenue, .btn_cancel_drop').hide();
    DOTB.ajaxUI.showLoadingPanel();
    $.ajax({
        url: "index.php?module=J_Payment&action=handleAjaxPayment&dotb_body_only=true",
        type: "POST",
        async: true,
        data:
        {
            payment_id      : $('input[name=record]').val(),
            dl_date	        : dl_date,
            type 			: "caculateDropPayment",
        },
        dataType: "json",
        success: function(res){
            if(res.success == "1"){
                $('#dl_total_amount').text(res.total_amount).effect("highlight", {color: '#3594FF'}, 2000);
                $('#dl_used_amount').text(res.used_amount).effect("highlight", {color: '#3594FF'}, 2000);
                $('#dl_drop_amount').text(res.drop_amount).effect("highlight", {color: '#3594FF'}, 2000);
                $('#drop_amount_raw').val(res.drop_amount_raw);
                $('#dl_drop_hour').text(res.drop_hour).effect("highlight", {color: '#3594FF'}, 2000);
                $('#drop_hour_raw').val(res.drop_hour_raw);
                toastr.success(DOTB.language.get('J_Payment', 'LBL_SAVED'));
            }else
                toastr.error(DOTB.language.get('J_Payment', 'LBL_SAVING_ERROR'));
            $('.btn_drop_to_delay, .btn_cancel_drop, .btn_drop_to_revenue').show();
            DOTB.ajaxUI.hideLoadingPanel();
        },
    });
}

function createDrop(drop_type){
    var drop_amount = $('#drop_amount_raw').val();
    var drop_hour   = $('#drop_hour_raw').val();
    var dl_date     = $('#dl_date').val();
    var dl_reason   = $('#dl_reason').val();
    if(drop_amount <= 0){
        toastr.error(DOTB.language.get('J_Payment', 'LBL_AMOUNR_ERR_DROP'));
        return ;
    }
    if( dl_reason == '' || dl_date == ''){
        toastr.error(DOTB.language.get('J_Payment', 'LBL_FILLUP_ERR'));
        return ;
    }

    $('.btn_drop_to_delay, .btn_cancel_drop, .btn_drop_to_revenue').hide();
    DOTB.ajaxUI.showLoadingPanel();
    $.ajax({
        url: "index.php?module=J_Payment&action=handleAjaxPayment&dotb_body_only=true",
        type: "POST",
        async: true,
        data:
        {
            drop_amount :   drop_amount,
            drop_hour   :   drop_hour,
            payment_id  :   $('input[name=record]').val(),
            dl_date     :   dl_date,
            dl_reason   :   dl_reason,
            drop_type   :   drop_type,
            type        :   "createDropPayment",
        },
        dataType: "json",
        success: function(res){
            if(res.success == '1'){
                $('#drop_payment_dialog').dialog("close");
                $('#btn_drop_payment').hide();
                toastr.success(DOTB.language.get('J_Payment', 'LBL_SAVED'));
            }else
                toastr.error(DOTB.language.get('J_Payment', 'LBL_SAVING_ERROR'));
            $('.btn_drop_to_delay, .btn_cancel_drop, .btn_drop_to_revenue').show();
            DOTB.ajaxUI.hideLoadingPanel();
        },
    });
}

Calendar.setup ({
    inputField : "dl_date",
    daFormat : cal_date_format,
    button : "dl_date_trigger",
    singleClick : true,
    dateStr : "",
    step : 1,
    weekNumbers:false
});
