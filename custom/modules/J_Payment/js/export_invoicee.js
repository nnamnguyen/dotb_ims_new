var record_id = $('input[name=record]').val();
$( document ).ready(function() {

    $('.btn_add_invoice').live("click",function(){
        $('#eid_invoice_id').val('');
        ajax_payment_detail();
    });

    $('#btn_eid_load_payment').live("click",function(){
        ajax_payment_detail();
    });

    $('#btn_eid_cancel').live("click",function(){
        $('.diaglog_invoice').dialog('close');
    });

    $('#btn_eid_save').live("click",function(){
        ajaxSaveInvoice();
    });

    $('#btn_edit_invoice').live("click",function(){
        $('#eid_invoice_id').val($(this).attr('invoice_id'));
        ajax_payment_detail();
    });
});

function eid_load_dialog(){
    $("body").css({ overflow: 'hidden' });
    $('.diaglog_invoice').dialog({
        resizable: false,
        width:'700px',
        height:'auto',
        modal: true,
        visible: true,
        beforeClose: function (event, ui) {
            $("body").css({ overflow: 'inherit' });
        },
    });
}

function ajax_payment_detail(){
    //invoice_id = (typeof invoice_id !== 'undefined') ?  invoice_id : '';
    var invoice_id       = $('#eid_invoice_id').val();
    var eid_from         = $('#eid_from').val();
    var eid_to           = $('#eid_to').val();
    var eid_invoice_date = $('#eid_invoice_date').val();
    //    if(invoice_id != '') $('#btn_eid_load_payment').hide();
    //    else $('#btn_eid_load_payment').show();

    if(eid_from != '' && eid_to != ''){
        DOTB.ajaxUI.showLoadingPanel();
        $.ajax({
            url: "index.php?module=J_Payment&action=handleAjaxPayment&dotb_body_only=true",
            type: "POST",
            async: true,
            data:  {
                type            : 'ajax_payment_detail',
                invoice_id      : invoice_id,
                record_id       : record_id,
                eid_from        : eid_from,
                eid_to          : eid_to,
                eid_invoice_date: eid_invoice_date,
            },
            dataType: "json",
            success: function(res){
                DOTB.ajaxUI.hideLoadingPanel();
                if(res.success == "1"){
                    $('#tbody_eid_detail').html(res.html);
                    handleCheckBox($('#eid_detail_id1'));
                    calculateInvoice();
                    if(res.count == '0')
                        $('#tfoot_eid_detail').hide();
                    else
                        $('#tfoot_eid_detail').show();
                    //In case edit

                    $('#eid_invoice_id').val(res.invoice_id);
                    $('#eid_invoice_date').val(res.invoice_date);
                    $('#eid_invoice_no').val(res.invoice_no);
                    $('#eid_invoice_serial').val(res.serial_no);
                    eid_load_dialog();
                }else{
                    toastr.error('Oops something went wrong, please reload page and try again.!');
                }
            },
        });
    }else{
        toastr.error('Please fill out the information completely !');
    }
    //END
}

function calculateInvoice(){
    var eid_before_discount = 0;
    var eid_discount_amount = 0;
    var eid_after_discount  = 0;
    $('.eid_detail_id:checked').each(function(index, brand){
        eid_before_discount += Number($(this).closest('tr').find('.edi_before_discount').val());
        eid_discount_amount += Number($(this).closest('tr').find('.edi_discount_amount').val());
        eid_after_discount += Number($(this).closest('tr').find('.edi_payment_amount').val());
    });
    $('input.eid_total_before_discount').val(eid_before_discount);
    $('input.eid_total_discount_amount').val(eid_discount_amount);
    $('input.eid_total_after_discount').val(eid_after_discount);
    $('td.eid_total_before_discount').text(Numeric.toFloat(eid_before_discount,0,0)).effect("highlight", {color: '#ff9933'}, 500);
    $('td.eid_total_discount_amount').text(Numeric.toFloat(eid_discount_amount,0,0)).effect("highlight", {color: '#ff9933'}, 500);
    $('td.eid_total_after_discount').text(Numeric.toFloat(eid_after_discount,0,0)).effect("highlight", {color: '#ff9933'}, 500);
}

function ajaxSaveInvoice(){
    var invoice_id          = $('#eid_invoice_id').val();
    var eid_invoice_no      = $('#eid_invoice_no').val();
    var eid_invoice_serial  = $('#eid_invoice_serial').val();
    var eid_invoice_date    = $('#eid_invoice_date').val();
    var countChecked        = $('input.eid_detail_id:checked').length;
    var idsChecked          = $('#J_PaymentDetail_checked_str').val();
    var eid_total_before_discount = $('input.eid_total_before_discount').val();
    var eid_total_discount_amount = $('input.eid_total_discount_amount').val();
    var eid_total_after_discount  = $('input.eid_total_after_discount').val();
    if(eid_invoice_no != '' && countChecked > 0 && idsChecked != '' && eid_invoice_date != ''){
        $.confirm({
            title: 'Confirm!',
            content: 'Are you sure you want to save this invoice ?',
            buttons: {
                "OK": {
                    btnClass: 'btn-blue',
                    action: function(){
                        DOTB.ajaxUI.showLoadingPanel();
                        $('.diaglog_invoice').dialog('close');
                        $.ajax({
                            url: "index.php?module=J_Payment&action=handleAjaxPayment&dotb_body_only=true",
                            type: "POST",
                            async: true,
                            data:{
                                type        : 'ajaxSaveInvoice',
                                idsChecked  : idsChecked,
                                invoice_id  : invoice_id,
                                record_id   : record_id,
                                eid_invoice_date    : eid_invoice_date,
                                eid_invoice_serial  : eid_invoice_serial,
                                eid_invoice_no      : eid_invoice_no,
                                eid_total_before_discount      : eid_total_before_discount,
                                eid_total_discount_amount      : eid_total_discount_amount,
                                eid_total_after_discount       : eid_total_after_discount,
                            },
                            dataType: "json",
                            success: function(res){
                                if(res.success == "1"){
                                    showSubPanel('payment_paymentdetails', null, true);
                                    showSubPanel('payment_invoices', null, true);
                                }else
                                    toastr.error('Oops something went wrong, please reload page and try again.!');

                                DOTB.ajaxUI.hideLoadingPanel();
                            },
                        });
                    }
                },
                "Cancel": {
                    action: function(){

                    }
                },
            }
        });
    }else{
        toastr.error('Please fill out the information completely !');
    }
    //END
}

function ajaxCancelInvoice(invoice_id){
    // prompt dialog
    $.confirm({
        title: 'Are you sure you want to cancel this invoice?',
        content: '' +
        '<form action="" class="formName">' +
        '<div class="form-group">' +
        '<label>Please enter reason:</label>' +
        '<input type="text" placeholder="Message" class="name form-control" required />' +
        '</div>' +
        '</form>',
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var str = this.$content.find('.name').val();
                    DOTB.ajaxUI.showLoadingPanel();
                    $.ajax({
                        type: "POST",
                        url: "index.php?module=J_Payment&action=handleAjaxPayment&dotb_body_only=true",
                        data:  {
                            type                : "ajaxCancelInvoice",
                            invoice_id          : invoice_id,
                            description         : str,
                        },
                        success:function(data){
                            data = JSON.parse(data);
                            if (data.success == "1") {
                                DOTB.ajaxUI.showLoadingPanel();
                                location.reload();
                            }else{
                                toastr.error('Oops something went wrong, please reload page and try again.!');
                            }
                            DOTB.ajaxUI.hideLoadingPanel();
                        },
                    });
                }
            },
            cancel: function () {
                //close
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });
}

Calendar.setup ({
    inputField : "eid_from",
    daFormat : cal_date_format,
    button : "eid_from_trigger",
    singleClick : true,
    dateStr : "",
    step : 1,
    weekNumbers:false
});

Calendar.setup ({
    inputField : "eid_to",
    daFormat : cal_date_format,
    button : "eid_to_trigger",
    singleClick : true,
    dateStr : "",
    step : 1,
    weekNumbers:false
});

Calendar.setup ({
    inputField : "eid_invoice_date",
    daFormat : cal_date_format,
    button : "eid_invoice_date_trigger",
    singleClick : true,
    dateStr : "",
    step : 1,
    weekNumbers:false
});