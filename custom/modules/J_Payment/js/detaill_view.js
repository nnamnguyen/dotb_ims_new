var record_id = $('input[name=record]').val();
$( document ).ready(function() {
    quickAdminEdit('j_payment', 'sale_type');
    quickAdminEdit('j_payment', 'sale_type_date');
    quickAdminEdit('j_payment', 'assigned_user_id');
    quickAdminEdit('j_payment', 'user_closed_sale_id');
    quickAdminEdit('j_payment', 'user_pt_demo_id');
    quickAdminEdit('j_payment', 'payment_expired');

    $('.inventory_id').live("click",function(){
        var inventory_id = this.getAttribute('inventory_id');
        window.open("index.php?module=J_Inventory&action=exportInventory&record="+inventory_id,'_blank');
    });

    $("#dt_payment_amount").change(function(){
        var value = Numeric.parse($(this).val());
        checkPaymentAmount(value);
    });

    $("a.btn_view_invoice").live('click', function(){
        $('a[data-subpanel=whole_subpanel_payment_invoices]').trigger('click').focus();
        $('#inv_'+$(this).text()).closest('tr').find('td').effect("highlight", {color: '#ff9933'}, 1000);
    });
    //Mask Input
    $('#inv_code').mask("0000000", {placeholder: "________"});
    $('#pos_code').mask("000000", {placeholder: "_______"});
    $('#bank_account').closest('tr').hide();
    $('#payment_method').live('change',function(){
        $('#card_type').hide();
        $('#bank_type').hide();
        $('#method_note').hide();
        $('#bank_account').closest('tr').hide();
        $('#pos_code').closest('tr').hide();

        switch($('#payment_method').val()) {
            case 'Bank Transfer':
                $('#bank_type').show();
                $('#bank_account').closest('tr').show();
                break;
            case 'Card':
                $('#pos_code').closest('tr').show();
                $('#card_type').show();
                break;
            case 'Other':
                $('#method_note').show();
                break;
            default:
            // code block
        }
    });
    $('#payment_date_collect').on('change',function(){
        var rs3 = checkDataLockDate($(this).attr('id'));
    });

    $('#btn_dt_cancel').live("click",function(){
        $('.diaglog_payment').dialog('close');
    });
    $('#btn_dt_save, #btn_dt_save_get_vat').live("click",function(){
        updatePaymentDetail();
    });

    //Undo moving/ transfer
    $("#btn_undo").on("click",function(){
        undoPayment();
    });

    $('.container-close').click(function(){

    });

    $('#convert_payment').click(function(){
        $('#diaglog_convert_payment').dialog({
            resizable: false,
            width: 500,
            height:'auto',
            modal: true,
            visible: true,
            beforeClose: function(event, ui) {
                $("body").css({ overflow: 'inherit' });
            },

        });
    });

    // Convert Payment
    $('#cp_convert_type').live('change',function(){
        if($(this).val() == 'To Amount'){
            $('#cp_tuition_hours, #cp_remain_hours').val('0').prop('disabled',true).addClass('input_readonly');
        }else{
            $('#cp_tuition_hours, #cp_remain_hours').val('0').prop('disabled',false).removeClass('input_readonly');
        }
    });

    //Auto calculate
    $("#cp_tuition_hours").keyup(function(){
        var cp_tuition_hours = Numeric.parse($(this).val());
        var cp_remain_amount = Numeric.parse($('#cp_remain_amount').val());
        var cp_payment_amount = Numeric.parse($('#cp_payment_amount').val());
        $('#cp_remain_hours').val( Numeric.toFloat(cp_remain_amount / (cp_payment_amount / cp_tuition_hours),2,2))
    });

    $("#cp_remain_hours").keyup(function(){
        var cp_remain_hours = Numeric.parse($(this).val());
        var cp_remain_amount = Numeric.parse($('#cp_remain_amount').val());
        var cp_payment_amount = Numeric.parse($('#cp_payment_amount').val());
        $('#cp_tuition_hours').val( Numeric.toFloat( cp_payment_amount/ (cp_remain_amount / cp_remain_hours),2,2))
    });

    $('#cp_tuition_hours, #cp_remain_hours').live('change',function(){
    $(this).val(Numeric.toFloat($(this).val(),2,2))
    });

    $('#cp_convert_type').trigger('change');
    $('#btn_submit_convert').live('click',function(){
        if( $("#cp_convert_type").val() == 'To Hour' && ($('#cp_tuition_hours').val() == 0 || $('#cp_remain_hours').val() == 0)){
            toastr.error('Hour must be greater than 0 !');
            return ;
        }
        //Submit class in progress
        DOTB.ajaxUI.showLoadingPanel();
        $.ajax({
            url: "index.php?module=J_Payment&action=handleAjaxPayment&dotb_body_only=true",
            type: "POST",
            async: true,
            data:
            {
                type            : 'ajaxConvertPayment',
                payment_id      : $("input[name='record']").val(),
                tuition_hours   : $("#cp_tuition_hours").val(),
                remain_hours    : $("#cp_remain_hours").val(),
                convert_to_type : $("#cp_convert_type").val(),
            },
            dataType: "json",
            success: function(res){
                if(res.success == '1'){
                    location.reload();
                    toastr.success(DOTB.language.get('J_Payment', 'LBL_SAVED'));
                }else{
                    toastr.error(DOTB.language.get('J_Payment', 'LBL_SAVING_ERROR'));
                    $('#diaglog_convert_payment').dialog("close");
                    $("#cp_tuition_hours").val('');
                }
                DOTB.ajaxUI.hideLoadingPanel();
            },
        });
    });

    //Khóa chức năng thay đổi Grand Total khi trả góp
    if ($('#is_installment').is(':checked')) {
        $('#dt_payment_amount').prop('readonly', true).addClass('input_readonly');
    }

    //END: Convert Payment

    $('#btn_add_display_info, #btn_select_display_info').live('click',function(){
        open_popup("Accounts", 600, 400, "", true, true, {
            "call_back_function": "set_return_corp",
            "form_name": "EditView",
            "field_to_name_array": {
                "id": "account_id",
                "name": "account_name",
            },
            }, "Select", true);
    });

    $('#btn_delete_display_info').live('click',function(){
        addEvatCorporate('');
    });

});

function set_return_corp(popup_reply_data){
    var account_id = '';
    var account_name = '';
    var form_name = popup_reply_data.form_name;
    var name_to_value_array = popup_reply_data.name_to_value_array;
    for (var the_key in name_to_value_array) {
        if (the_key == 'toJSON') {
            continue;
        } else {
            var val = name_to_value_array[the_key].replace(/&amp;/gi, '&').replace(/&lt;/gi, '<').replace(/&gt;/gi, '>').replace(/&#039;/gi, '\'').replace(/&quot;/gi, '"');
            switch (the_key)
            {
                case 'account_id':
                    account_id = val;
                    break;
                case 'account_name':
                    account_name = val;
                    break;
            }
        }
    }

    addEvatCorporate(account_id);
}

function addEvatCorporate(account_id){
    if(account_id != '')
        var action_type = 'add';
    else
        var action_type = 'delete';

    var payment_id = $('input[name=record]').val();
    $.ajax({
        type: "POST",
        url: "index.php?module=J_Payment&action=handleAjaxPayment&dotb_body_only=true",
        data:  {
            type            : "addEvatCorporate",
            account_id      : account_id,
            payment_id      : payment_id,
            action_type     : action_type,
        },
        success:function(data){
            data = JSON.parse(data);
            if (data.success == "1") {
                toastr.success(DOTB.language.get('J_Payment', 'LBL_SAVED'));
                var thisButton = $('#btn_get_evat')[0];
                autoGetNextInvoice(thisButton);
            }else{
                toastr.error(DOTB.language.get('J_Payment', 'LBL_SAVING_ERROR'));
            }
        },
    });
}

function autoGetNextInvoice(thisButton){
    if($('#nextInvoice').length > 0){
        var payment_id = thisButton.getAttribute('payment_id');
        $.ajax({
            type: "POST",
            url: "index.php?module=J_Payment&action=handleAjaxPayment&dotb_body_only=true",
            data:  {
                type                : "autoGetNextInvoice",
                team_id             : $('#team_id').val(),
                payment_id          : payment_id,
            },
            success:function(data){
                data = JSON.parse(data);
                if (data.success == "1"){
                    $('#nextInvoice').text(data.txtInv);
                    if(data.fullStudentName == '') $('.studentRadio').hide();
                    else $('.studentRadio').show();
                    if(data.guardianName == '')$('.guardianRadio').hide();
                    else $('.guardianRadio').show();
                    if(data.guardianName2 == '')$('.guardian2Radio').hide();
                    else $('.guardian2Radio').show();
                    $('#studentRadio').next().text(data.fullStudentName);
                    $('#guardianRadio').next().text(data.guardianName);
                    $('#guardian2Radio').next().text(data.guardianName2);
                    $('#BuyerDisplayName').html(data.BuyerDisplayName);
                    $('#buyerAddressLine').html(data.buyerAddressLine);
                    $('#BuyerTaxCode').html(data.BuyerTaxCode);
                    $('#buyerEmail').html(data.buyerEmail);
                    $('#btn_edit_legal_info').attr("onclick", "window.top.DOTB.App.router.redirect(\'#Contacts/"+ data.buyerID +"\')");
                    if(data.is_corporate){
                        $('#btn_edit_display_info').show().attr("onclick", "window.top.DOTB.App.router.redirect(\'#Accounts/"+ data.displayID +"\')");
                        $('#btn_delete_display_info').show();
                        $('#btn_add_display_info').hide();

                    }else{
                        $('#btn_add_display_info').show();
                        $('#btn_delete_display_info').hide();
                        $('#btn_edit_display_info').hide();
                    }

                    if(data.itemName == '') $('.item').hide(); else $('.item').show();
                    if(data.extContent1 == '') $('.ext_content_1').hide(); else $('.ext_content_1').show();
                    if(data.extContent2 == '') $('.ext_content_2').hide(); else $('.ext_content_2').show();
                    $('#item_name').text(data.itemName);
                    $('#unit_price').text(data.totalAmount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                    $('#amount').text(data.totalAmount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                    $('#ext_content_1').text(data.extContent1);
                    $('#ext_content_2').text(data.extContent2);
                    setTimeout(function(){autoGetNextInvoice(thisButton);}, 10000);
                }
            },
        });
    }
}

function cancel_invoice(invoice_id, payment_id){
    // prompt dialog
    $.confirm({
        boxWidth: '40%',
        useBootstrap: false,
        title: DOTB.language.get('J_Payment', 'LBL_RECEIPT_NOTY_1'),
        content: '' +
        '<form action="" class="formName">' +
        '<div class="form-group">' +
        '<label>'+DOTB.language.get('J_Payment', 'LBL_RECEIPT_NOTY_2')+': </label>' +
        '<input type="text" class="name form-control" required />' +
        '</div>' +
        '</form>',
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var str = this.$content.find('.name').val();
                    ajaxStatus.showStatus('Waiting <img src="custom/include/images/loader32.gif" align="absmiddle" width="32">');
                    $(".cancel_invoice").attr("disabled", true);
                    $.ajax({
                        type: "POST",
                        url: "index.php?module=J_Payment&action=handleAjaxPayment&dotb_body_only=true",
                        data:  {
                            type            : "ajaxCancelInvoice",
                            invoice_id      : invoice_id,
                            payment_id      : payment_id,
                            description     : str,
                        },
                        success:function(data){
                            data = JSON.parse(data);
                            if(data.success == "1") {
                                DOTB.ajaxUI.showLoadingPanel();
                                location.reload();
                            }else{
                                toastr.error(data.errorLabel);
                            }
                            ajaxStatus.hideStatus();
                            $(".cancel_invoice").attr("disabled", false);
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

function cancel_receipt(payment_detail){
    // prompt dialog
    $.confirm({
        boxWidth: '40%',
        useBootstrap: false,
        title: DOTB.language.get('J_Payment', 'LBL_RECEIPT_NOTY_1'),
        content: '' +
        '<form action="" class="formName">' +
        '<div class="form-group">' +
        '<label>'+DOTB.language.get('J_Payment', 'LBL_RECEIPT_NOTY_2')+': </label>' +
        '<input type="text" class="name form-control" required />' +
        '</div>' +
        '</form>',
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var str = this.$content.find('.name').val();
                    ajaxStatus.showStatus('Waiting <img src="custom/include/images/loader32.gif" align="absmiddle" width="32">');
                    $(".cancel_invoice").attr("disabled", true);
                    $.ajax({
                        type: "POST",
                        url: "index.php?module=J_Payment&action=handleAjaxPayment&dotb_body_only=true",
                        data:  {
                            type                : "ajaxCancelReceipt",
                            payment_detail      : payment_detail,
                            description         : str,
                        },
                        success:function(data){
                            data = JSON.parse(data);
                            if(data.success == "1") {
                                DOTB.ajaxUI.showLoadingPanel();
                                location.reload();
                            }else{
                                toastr.error(data.errorLabel);
                            }
                            ajaxStatus.hideStatus();
                            $(".cancel_invoice").attr("disabled", false);
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

function checkPaymentType(){
    if ($("#payment_type").val() != "Cashholder")
    {
        // Hide Cashholder field
        $("#tuition_hours").closest("tr").hide();
        $("#amount_bef_discount").closest("tr").hide();
        $("#discount_percent").closest("tr").hide();
        $("#discount_amount").closest("tr").hide();
        $("#total_after_discount").closest("tr").hide();
        $("#final_sponsor").closest("tr").hide();
    }
}

function finish_printing(printing_id){
    DOTB.ajaxUI.showLoadingPanel();
    $.ajax({
        type: "POST",
        url: "index.php?module=J_Payment&action=handleAjaxPayment&dotb_body_only=true",
        data:  {
            type             : "finish_printing",
            printing_id      : printing_id,
        },
        success:function(data){
            DOTB.ajaxUI.hideLoadingPanel();
            data = JSON.parse(data);
            if (data.success == "1") {
                showSubPanel('payment_paymentdetails', null, true);
                toastr.success(DOTB.language.get('J_Payment', 'LBL_SAVED'));
            }else{
                toastr.error(DOTB.language.get('J_Payment', 'LBL_SAVING_ERROR'));
            }
        },
        error: function(xhr, textStatus, errorThrown){
            DOTB.ajaxUI.hideLoadingPanel();
        }
    });
}

function ex_invoice_pdf(thisButton) {
    var payment_id = thisButton.getAttribute('payment_id');
    $(".textbg_greenDotB").attr("disabled", true);
    ajaxStatus.showStatus('Waiting <img src="custom/include/images/loader32.gif" align="absmiddle" width="32">');
    $.ajax({
        type: "POST",
        url: "index.php?module=J_Payment&action=handleAjaxPayment&dotb_body_only=true",
        data: {
            type: "ajaxExportInvoice",
            payment_id: payment_id,
        },
        success: function (data) {
            //Download Invoice type PDF
            data = JSON.parse(data);
            if(data.success == "1") {
                var bin = atob(data.data_pdf);
                console.log('File Size:', Math.round(bin.length / 1024), 'KB');
                var element = document.createElement('a');
                element.setAttribute('href', 'data:application/octet-stream;base64,' + data.data_pdf);
                element.setAttribute('download', 'HD-' + data.transactionID + '.pdf');
                document.body.appendChild(element);
                element.click();
                document.body.removeChild(element);
            } else {
                toastr.error(data.label);
            }
            ajaxStatus.hideStatus();
            $(".textbg_greenDotB").attr("disabled", false);
        },
    });
}

function ex_invoice(thisButton) {
    var payment_detail = thisButton.getAttribute('payment_detail_id');
    var is_corporate = $('#is_corporate').val();
    var pdf = thisButton.getAttribute('pdf');
    var pdf_id = thisButton.getAttribute('pdf_id');
    if(pdf == "0") {
        if (is_corporate == '1') {
            var ex_corporate = function () {
                window.open('index.php?module=J_Payment&type=corporate&action=invoiceVoucher&record=' + payment_detail + '&dotb_body_only=true', '_blank');
                confirmExportPopup.destroy(document.body);
            };
            var ex_student = function () {
                window.open('index.php?module=J_Payment&type=student&action=invoiceVoucher&record=' + payment_detail + '&dotb_body_only=true', '_blank');
                confirmExportPopup.destroy(document.body);
            };
            var ex_both = function () {
                window.open('index.php?module=J_Payment&type=both&action=invoiceVoucher&record=' + payment_detail + '&dotb_body_only=true', '_blank');
                confirmExportPopup.destroy(document.body);
            };
            var ex_cancel = function () {
                confirmExportPopup.destroy(document.body);
            };

            var confirm_text = DOTB.language.get('J_Payment', 'LBL_CONFIRM_EXPORT');
            var confirmExportPopup = new YAHOO.widget.SimpleDialog("export_vat_popup", {
                width: "400px",
                draggable: true,
                constraintoviewport: true,
                modal: true,
                fixedcenter: true,
                text: confirm_text,
                bodyStyle: "padding:5px",
                buttons: [{
                    text: DOTB.language.get('J_Payment', 'LBL_CORPORATE'),
                    handler: ex_corporate,
                    isDefault: true
                    }, {
                        text: DOTB.language.get('J_Payment', 'LBL_STUDENT'),
                        handler: ex_student
                    }, {
                        text: DOTB.language.get('J_Payment', 'LBL_BOTH'),
                        handler: ex_both
                    }, {
                        text: DOTB.language.get('J_Payment', 'LBL_CANCEL'),
                        handler: ex_cancel
                }]
            });

            confirmExportPopup.setHeader(DOTB.language.get('J_Payment', 'LBL_CONFIRM'));
            confirmExportPopup.render(document.body);
        } else {
            window.open('index.php?module=J_Payment&type=student&action=invoiceVoucher&record=' + payment_detail + '&dotb_body_only=true', '_blank');
        }
    }
    else{
        window.open('index.php?module=J_PaymentDetail&type=student&action=pdf_invoice&record='+payment_detail+'&dotbpdf=pdfmanager&pdf_template_id='+pdf_id+'&dotb_body_only=true','_blank');
    }
}

function ex_invoice_2(thisButton) {
    var invoice_id = thisButton.getAttribute('invoice_id');
    window.open('index.php?module=J_Payment&type=student&action=invoiceVoucher_2&record='+invoice_id+'&dotb_body_only=true','_blank');
}

function pay(thisButton){
    var today = DOTB.util.DateUtils.formatDate(new Date());
    var payment_detail  = thisButton.getAttribute('payment_detail_id');
    var payment_amount  = thisButton.getAttribute('payment_detail_amount');
    var unpaid_amount   = thisButton.getAttribute('pmd_unpaid_amount');
    var description   = thisButton.getAttribute('pmd_description');
    var inv_code   = thisButton.getAttribute('inv_code');
    $('#payment_method').trigger('change');
    $('#dt_handle_action').val('pay');
    $('#dt_unpaid_amount').val(unpaid_amount);
    $('#dt_payment_amount').val(payment_amount);
    $('#dt_payment_detail_id').val(payment_detail);
    $('#payment_date_collect').val(today).trigger('change');
    $('#bank_account').val(thisButton.getAttribute('pmd_bank_account'));
    $('#dt_reference_document').val(thisButton.getAttribute('pmd_reference_document'));
    $('#dt_reference_number').val(thisButton.getAttribute('pmd_reference_number'));
    $('#dt_description').val(description);
    $('#inv_code').val(inv_code);

    $("body").css({ overflow: 'hidden' });
    $('.diaglog_payment').dialog({
        resizable: false,
        width:'600',
        height:'auto',
        modal: true,
        visible: true,
        beforeClose: function (event, ui) {
            $('#payment_method').val('').trigger('change');
            $("body").css({ overflow: 'inherit' });
        },
    });
}
function edit_invoice(thisButton){
    var payment_detail = thisButton.getAttribute('payment_detail_id');
    var payment_amount = thisButton.getAttribute('payment_detail_amount');
    var payment_method = thisButton.getAttribute('payment_method');
    var payment_date = thisButton.getAttribute('payment_date');
    var card_type = thisButton.getAttribute('card_type');
    var bank_type = thisButton.getAttribute('bank_type');
    var inv_code = thisButton.getAttribute('inv_code');
    var pos_code = thisButton.getAttribute('pos_code');
    var unpaid_amount   = thisButton.getAttribute('pmd_unpaid_amount');
    var description   = thisButton.getAttribute('pmd_description');
    $('#dt_handle_action').val('edit');
    $('#dt_unpaid_amount').val(Numeric.toFloat(Numeric.parse(unpaid_amount) + Numeric.parse(payment_amount)));
    $('#dt_payment_amount').val(payment_amount);
    $('#dt_payment_detail_id').val(payment_detail);
    $('#payment_method').val(payment_method).trigger('change');
    $('#payment_date_collect').val(payment_date).trigger('change');
    $('#card_type').val(card_type);
    $('#bank_type').val(bank_type);
    $('#pos_code').val(pos_code);
    $('#inv_code').val(inv_code);
    $('#dt_description').val(description);

    $('#bank_account').val(thisButton.getAttribute('pmd_bank_account'));
    $('#dt_reference_document').val(thisButton.getAttribute('pmd_reference_document'));
    $('#dt_reference_number').val(thisButton.getAttribute('pmd_reference_number'));
    $('#btn_dt_save_get_vat').hide();

    $("body").css({ overflow: 'hidden' });
    $('.diaglog_payment').dialog({
        resizable: false,
        width:'450px',
        height:'auto',
        modal: true,
        visible: true,
        beforeClose: function (event, ui) {
            $("body").css({ overflow: 'inherit' });
            $('#payment_method').val('').trigger('change');
            $('#btn_dt_save_get_vat').show();
        },
    });
}

function updatePaymentDetail(){
    var payment_date = $("#payment_date_collect").val();
    var payment_mt = $('#payment_method').val();
    var card_type  = $('#card_type').val();
    var bank_type  = $('#bank_type').val();
    var inv_code   = $('#inv_code').val();
    var pos_code   = $('#pos_code').val();
    var description   = $('#dt_description').val();
    var value      = Numeric.parse($('#dt_payment_amount').val());
    var handle_action = $('#dt_handle_action').val();
    if(!checkPaymentAmount(value)) return ;
    else{
        if(payment_date == '' || payment_mt == '' || (payment_mt== 'Other' && $('#method_note').val() == '') || (value == '') || (value < 0)){
            toastr.error('Please fill out fields completely !');
            if(payment_mt == '')
                $('#payment_method').effect("highlight", {color: 'red'}, 2000);
            //            if(inv_code.length < 7)
            //                $('#inv_code').effect("highlight", {color: 'red'}, 2000);
            return ;
        }
        if( (payment_mt== 'Card' && pos_code.length < 6)){
            toastr.error('Please fill out fields completely !');
            $('#pos_code').effect("highlight", {color: 'red'}, 2000);
            return ;
        }
    }
    $.confirm({
        title: 'Confirm!',
        content: 'Are you sure you want to save this receipt ?',
        buttons: {
            "OK": {
                btnClass: 'btn-blue',
                action: function(){
                    $('#btn_dt_save, #btn_dt_save_get_vat, #btn_dt_cancel').hide();
                    $(".diaglog_payment").dialog("close");
                    DOTB.ajaxUI.showLoadingPanel();
                    $.ajax({
                        type: "POST",
                        url: "index.php?module=J_Payment&action=handleAjaxPayment&dotb_body_only=true",
                        data:  {
                            type                : "ajaxUpdatePaymentDetail",
                            payment_detail      : $('#dt_payment_detail_id').val(),
                            payment_method      : payment_mt,
                            card_type           : card_type,
                            bank_type           : bank_type,
                            payment_amount      : value,
                            bank_account        : $('#bank_account').val(),
                            reference_document  : $('#dt_reference_document').val(),
                            reference_number    : $('#dt_reference_number').val(),
                            method_note         : $('#method_note').val(),
                            pos_code            : pos_code,
                            inv_code            : inv_code,
                            description         : description,
                            payment_date        : payment_date,
                            handle_action       : handle_action,
                        },
                        success:function(data){
                            data = JSON.parse(data);
                            if (data.success == "1") {
                                $('#pmd_paid_amount').text(data.paid);
                                $('#pmd_unpaid_amount').text(data.unpaid);
                                $('#remain_amount').text(data.remain_amount);
                                $('#remain_hours').text(data.remain_hours);
                                showSubPanel('payment_paymentdetails', null, true);

                                if(data.sale_type != '' && data.sale_type != null){
                                    $('#label_sale_type').text(data.sale_type);
                                    $('#value_sale_type').val(data.sale_type);
                                }
                                if(data.sale_type_date != '' && data.sale_type_date != null){
                                    $('#label_sale_type_date').text(data.sale_type_date);
                                    $('#value_sale_type_date').val(data.sale_type_date);
                                }
                                toastr.success('Success !<br>');
                                if(data.last_pay_receipt){
                                    $.alert({
                                        title: 'Success',
                                        content: 'The payment is eligible to get E-invoice. Please remember to get E-invoice!',
                                    });
                                }
                            }else
                                $.alert(data.errorLabel);

                            $('#btn_dt_save, #btn_dt_save_get_vat, #btn_dt_cancel').show();
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
}

Calendar.setup ({
    inputField : "payment_date_collect",
    daFormat : cal_date_format,
    button : "payment_date_trigger",
    singleClick : true,
    dateStr : "",
    step : 1,
    weekNumbers:false
});

function undoPayment(){
    var paymentType = $('#payment_type').val();

    if (paymentType == "Transfer Out" || paymentType == "Transfer In"){
        var rsconfirm = confirm("Sau khi undo, hệ thống sẽ:\n- Xóa thông tin payment transfer out va transfer in.\n- Phục hồi lại số tiền đã chuyển đi.\n\nBạn có chắc chắn muốn thực hiện thao tác này?")
    }
    else if (paymentType == "Moving Out" || paymentType == "Moving In"){
        var rsconfirm = confirm("Sau khi undo, hệ thống sẽ:\n- Xóa thông tin payment moving out va moving in.\n- Phục hồi lại số tiền đã chuyển đi.\n- Chuyển học viên về lại center cũ.\n\nBạn có chắc chắn muốn thực hiện thao tác này?")
    }
    else if (paymentType == "Refund"){
        var rsconfirm = confirm("Sau khi undo, hệ thống sẽ:\n- Xóa thông tin payment refund.\n- Phục hồi lại số tiền đã refund.\n\nBạn có chắc chắn muốn thực hiện thao tác này?")
    }

    if (rsconfirm) {
        DOTB.ajaxUI.showLoadingPanel();
        $.ajax({
            url: "index.php?module=J_Payment&action=handleAjaxPayment&dotb_body_only=true",
            type: "POST",
            async: true,
            data:  {
                type            : 'ajaxUndoPayment',
                payment_id      : $('input[name="record"]').val(),
                payment_type    : paymentType,
            },
            dataType: "json",
            success: function(res){
                DOTB.ajaxUI.hideLoadingPanel();
                if(res.success == "1"){
                    parent.DOTB.App.router.redirect("#Contacts/"+$('#contacts_j_payment_1contacts_ida').attr('data-id-value'));
                }
                else {
                    toastr.error(DOTB.language.get('J_Payment','LBL_PAYMENT_IN_USED'));
                }
            },
        });
    }
}

function reloadReleaseOptions(){
    DOTB.ajaxUI.showLoadingPanel();
    showSubPanel('payment_paymentdetails', null, true);
    DOTB.ajaxUI.hideLoadingPanel();
}

Calendar.setup ({
    inputField : "value_sale_type_date",
    daFormat : cal_date_format,
    button : "sale_type_date_trigger",
    singleClick : true,
    dateStr : "",
    step : 1,
    weekNumbers:false
});

function validateDateIsBetween(check_date, from, to){
    if(check_date == '') return true;
    check_date     = DOTB.util.DateUtils.parse(check_date, cal_date_format);
    if(from != '' && to != ''){
        from_check           = DOTB.util.DateUtils.parse(from, cal_date_format).getTime();
        to_check             = DOTB.util.DateUtils.parse(to, cal_date_format).getTime();
        if(check_date == false){
            toastr.error('Invalid date range. Date must be between '+from+' and '+to+'.');
            return false;
        }else{
            check_date = check_date.getTime();
            if(check_date < from_check || check_date > to_check){
                toastr.error('Invalid date range. Date must be between '+from+' and '+to+'.');
                return false;
            }
        }
    }else if(from != ''){
        from_check           = DOTB.util.DateUtils.parse(from, cal_date_format).getTime();

        if(check_date < from_check){
            toastr.error('Invalid date range. Date must after '+from+'.');
            return false;
        }
    } else{
        to_check             = DOTB.util.DateUtils.parse(to, cal_date_format).getTime();
        if(check_date > to_check){
            toastr.error('Invalid date range. Date must before '+to+'.');
            return false;
        }
    }
    return true;
}

function daydiff(first, second) {
    return Math.round((second-first)/(1000*60*60*24) + 1);
}

Calendar.setup ({
    inputField : "value_payment_expired",
    daFormat : cal_date_format,
    button : "payment_expired_trigger",
    singleClick : true,
    dateStr : "",
    step : 1,
    weekNumbers:false
});

function inArray(array, el) {
    for ( var i = array.length; i--; ) {
        if ( array[i] === el ) return true;
    }
    return false;
}

function isEqArrays(arr1, arr2) {
    if ( arr1.length !== arr2.length ) {
        return false;
    }
    for ( var i = arr1.length; i--; ) {
        if ( !inArray( arr2, arr1[i] ) ) {
            return false;
        }
    }
    return true;
}

function checkPaymentAmount(value){
    var min        = 1000;
    var max        = Numeric.parse($('#dt_unpaid_amount').val());
    if(value > max || value < min){
        $('#dt_payment_amount').val('').effect("highlight", {color: 'red'}, 2000);
        toastr.error('Invalid Input, Grand Total should be between '+Numeric.toFloat(min)+' - '+Numeric.toFloat(max)+' !!');
        return false;
    }else
        return true;
}

function get_invoice_no(thisButton){
    var payment_id  = thisButton.getAttribute('payment_id');
    $.confirm({
        title: '<span class="jconfirm-title">Next invoice number: <span id="nextInvoice">-none-</span></span>',
        content: DOTB.language.get('J_Payment', 'LBL_CONFIRM_E_INVOICE_INFO') +
        '<br><table class="edit view tabForm" style="width: 100%">' +
        '<tbody>' +
        '<tr>' +
        '<td scope="row" valign="top" width="35%">' +
        DOTB.language.get('J_Payment', 'LBL_BUYER_DISPLAY_NAME') + ':' +
        '</td>' +
        '<td width="50%" id="buyerLegalName">' +
        '<div class="studentRadio" style="display: none;">' +
        '  <input type="radio" id="studentRadio" name="buyerLegalName" value="full_student_name" checked>\n' +
        '  <label for="studentRadio"></label>&nbsp(Student)<br>\n' +
        '</div>' +
        '<div class="guardianRadio" style="display: none;">' +
        '  <input type="radio" id="guardianRadio" name="buyerLegalName" value="guardian_name">\n' +
        '  <label for="guardianRadio"></label>&nbsp(Parent 1)<br>\n' +
        '</div>' +
        '<div class="guardian2Radio" style="display: none;">' +
        '  <input type="radio" id="guardian2Radio" name="buyerLegalName" value="guardian_name_2">\n' +
        '  <label for="guardian2Radio"></label>&nbsp(Parent 2)' +
        '</div>' +
        '</td>' +
        '<td width="15%">' +
        '<button type="button" style="float: right" class="button primary" href="" id="btn_edit_legal_info" onclick="">' + DOTB.language.get('J_Payment', 'LBL_EDIT') + '</button>' +
        '</td>' +
        '</tr>' +

        '<tr>' +
        '<td scope="row" valign="top" width="35%">' +
        DOTB.language.get('J_Payment', 'LBL_COMPANY_DISPLAY_NAME') + ':' +
        '</td>' +
        '<td width="35%"><span id="BuyerDisplayName"></span>' + '<a style="display:none;" id="btn_delete_display_info"><i style="font-size: 14px;cursor: pointer;color: #dc0000;padding-left: 5px;" title="' + DOTB.language.get('J_Payment', 'LBL_REMOVE') + '" class="far fa-minus-circle"></i></a>' +
        '</td>' +
        '<td width="30%">' +
        '<button type="button" style="float: right;display:none;width: 90px;" class="button" id="btn_add_display_info" onclick="">' + DOTB.language.get('J_Payment', 'LBL_ADD_COMPANY') + '</button>' +

        '<button type="button" style="float: right;display:none;" class="button" href="" id="btn_edit_display_info" onclick="">' + DOTB.language.get('J_Payment', 'LBL_EDIT') + '</button>' +
        '</td>' +
        '</tr>' +

        '<tr>' +
        '<td scope="row" valign="top" width="35%">' +
        DOTB.language.get('J_Payment', 'LBL_TAX_CODE_DISPLAY_NAME') + ':' +
        '</td>' +
        '<td width="65%" id="BuyerTaxCode">' +
        '</td>' +
        '</tr>' +

        '<tr>' +
        '<td scope="row" valign="top" width="35%">' +
        DOTB.language.get('J_Payment', 'LBL_BUYER_ADDRESS_LINE') + ':' +
        '</td>' +
        '<td width="65%" id="buyerAddressLine">' +
        '</td>' +
        '</tr>' +
        '<tr>' +
        '<td scope="row" valign="top" width="35%">' +
        DOTB.language.get('J_Payment', 'LBL_BUYER_EMAIL') + ':' +
        '</td>' +
        '<td width="65%" id="buyerEmail">' +
        '</td>' +
        '</tr>' +
        '<td style="margin-left: 5px" width="35%">' + DOTB.language.get('J_Payment', 'LBL_INVOICE_DETAIL_INFO') + ':' + '</td>' +
        '<td></td>' +
        '<tr>' +
        '<td colspan="3" width="100%">' +
        '<table style="width: 100%">\n' +
        '  <tr>\n' +
        '    <th width="5%" style="font-weight: normal;">STT<br>(No)</th>\n' +
        '    <th width="45%" style="font-weight: normal;">Tên hàng hóa, dịch vụ<br>(Name of goods and services)</th>\n' +
        '    <th width="10%" style="font-weight: normal;">ĐVT<br>(Unit)</th>\n' +
        '    <th width="10%" style="font-weight: normal;">Số lượng<br>(Quantity)</th>\n' +
        '    <th width="15%" style="font-weight: normal;">Đơn giá<br>(Unit price)</th>\n' +
        '    <th width="15%" style="font-weight: normal;">Thành tiền<br>(Amount)</th>\n' +
        '  </tr>\n' +
        '  <tr class="item">\n' +
        '    <td style="text-align: center;">1</td>\n' +
        '    <td id="item_name"></td>\n' +
        '    <td>Khóa</td>\n' +
        '    <td style="text-align: right;">1</td>\n' +
        '    <td id="unit_price" style="text-align: right;"></td>\n' +
        '    <td id="amount" style="text-align: right;"></td>\n' +
        '  </tr>\n' +
        '  <tr class="ext_content_1">\n' +
        '    <td></td>\n' +
        '    <td id="ext_content_1"></td>\n' +
        '    <td></td>\n' +
        '    <td></td>\n' +
        '    <td></td>\n' +
        '    <td></td>\n' +
        '  </tr>\n' +
        '  <tr class="ext_content_2">\n' +
        '    <td></td>\n' +
        '    <td id="ext_content_2"></td>\n' +
        '    <td></td>\n' +
        '    <td></td>\n' +
        '    <td></td>\n' +
        '    <td></td>\n' +
        '  </tr>\n' +
        '</table>' +
        '</td>' +
        '</tr>' +
        '</tbody>' +
        '</table>',
        onContentReady: function () {
            autoGetNextInvoice(thisButton);
        },
        buttons: {
            "OK": {
                btnClass: 'btn-blue',
                action: function(){
                    var buyer_legal_type = $('input[name="buyerLegalName"]:checked').val();
                    ajaxStatus.showStatus('Waiting <img src="custom/include/images/loader32.gif" align="absmiddle" width="32">');
                    $.ajax({
                        type: "POST",
                        url: "index.php?module=J_Payment&action=handleAjaxPayment&dotb_body_only=true",
                        data: {
                            type: "ajaxGetInvoiceNo",
                            payment_id: payment_id,
                            buyer_legal_type: buyer_legal_type,
                        },
                        dataType: "json",
                        success: function (data) {
                            if (data.success == "1")
                                toastr.success(app.lang.get('LBL_GET_INVOICE_NO_SUCCESS','J_Payment'));
                            else
                                toastr.error(data.label);

                            showSubPanel('payment_paymentdetails', null, true);
                            ajaxStatus.hideStatus();
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
}
function  created_book_gift(event) {
    var payment_id = app.controller.context.attributes.model.id;
    var type = "Product";
    var student_id = app.controller.context.attributes.model.attributes.contacts_j_payment_1contacts_ida;
    app.router.redirect('#bwc/index.php?module=J_Payment&action=EditView&return_module=J_Payment&return_action=DetailView&payment_type='+type+'&student_id=' + student_id +'&primary_id='+payment_id);
}

