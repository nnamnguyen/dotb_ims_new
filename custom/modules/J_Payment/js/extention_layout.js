$(document).ready(function() {
    displaySplitPayment(false);
    $('#number_of_payment, .foc_type').live('change',function(){
        displaySplitPayment(true);
    });

    toggleIsCorporate();
    $('#is_corporate').on('change',function(){
        $('#btn_clr_account_name').trigger('click');
        toggleIsCorporate();
    });
    $('#btn_account_name').live('click',function(){
        open_popup("Accounts", 600, 400, "", true, true, {
            "call_back_function": "set_return_corp",
            "form_name": "EditView",
            "field_to_name_array": {
                "id": "account_id",
                "name": "account_name",
                "billing_address_street": "company_address",
                "tax_code": "tax_code",
            },
            }, "Select", true);
    });

    $('#btn_clr_account_name').live('click',function(){
        $('#account_id, #account_name, #company_name, #company_address, #tax_code').val('');
    });

    $("input[id^=payment_amount_]").live('blur',function(){
        autoGeneratePayment();
    });

    $("#payment_type").on("change",function(){
        displaySplitPayment(true);
    });
});

function autoGeneratePayment(){
    var number_of_payment 	= $('#number_of_payment').val();
    var grand_total         = Numeric.parse($("#payment_amount").val());
    var discount_amount     = Numeric.parse($("#discount_amount").val());
    var loyalty_amount      = Numeric.parse($("#loyalty_amount").val());
    var final_sponsor       = Numeric.parse($("#final_sponsor").val());

    var payment_amount_1    = Numeric.parse($("#payment_amount_1").val());
    var payment_amount_2    = Numeric.parse($("#payment_amount_2").val());
    var payment_amount_3    = Numeric.parse($("#payment_amount_3").val());
    var payment_amount_4    = Numeric.parse($("#payment_amount_4").val());
    var payment_amount_5    = Numeric.parse($("#payment_amount_5").val());


    switch (number_of_payment){
        case '1':
        case 'Monthly-plan':
            payment_amount_1    = grand_total;
            $("#payment_amount_1").val(Numeric.toInt(payment_amount_1));
            break;
        case '2':
            if(payment_amount_1 == 0) return ;
            payment_amount_2        = grand_total - payment_amount_1;
            $("#payment_amount_2").val(Numeric.toInt(payment_amount_2));
            break;
        case '3':
            if(payment_amount_1 == 0 || payment_amount_2 == 0) return ;
            payment_amount_3 = grand_total - payment_amount_1 - payment_amount_2;
            $("#payment_amount_3").val(Numeric.toInt(payment_amount_3));
            break;
        case '4':
            if(payment_amount_1 == 0 || payment_amount_2 == 0 || payment_amount_3 == 0) return ;
            payment_amount_4 = grand_total - payment_amount_1 - payment_amount_2 - payment_amount_3;
            $("#payment_amount_4").val(Numeric.toInt(payment_amount_4));
            break;
        case '5':
            if(payment_amount_1 == 0 || payment_amount_2 == 0 || payment_amount_3 == 0 || payment_amount_4 == 0) return ;
            payment_amount_5 = grand_total - payment_amount_1 - payment_amount_2 - payment_amount_3 - payment_amount_4;
            $("#payment_amount_5").val(Numeric.toInt(payment_amount_5));
            break;
    }
    //Lock Assigned to
    if($('#lock_assigned_to').val() == 1){
        $('#assigned_user_name').prop('readonly',true).addClass('input_readonly');
        $('#btn_assigned_user_name, #btn_clr_assigned_user_name').prop('disabled',true);
    }
}

// Ẩn hiện fieldset split payment
function displaySplitPayment(clear){
    //Clear Payment Amount
    var payment_date = $('#payment_date').val();
    var number_of_payment = $('#number_of_payment').val();
    var  is_installment = $("#is_installment").is(':checked');

    if(clear)
        $("input[id^=payment_amount_]").val('');

    $("table[id^=tbl_split_payment_]").hide();

    if(number_of_payment == 'Monthly-plan'){
        number_of_payment = '1';
    }

    for(i = 1; i <= number_of_payment; i++ ){
        if(number_of_payment == '1')
            $('#payment_amount_1').prop('readonly',true).addClass('input_readonly');
        else if(is_installment == false)
            $('#payment_amount_1').prop('readonly',false).removeClass('input_readonly');

        if($('#pay_dtl_invoice_date_'+i).val() == '')  //In Case Create
            $('#pay_dtl_invoice_date_'+i).val(payment_date).effect("highlight", {color: '#ff9933'}, 1000);

        $('#tbl_split_payment_'+i).show();
    }
    autoGeneratePayment();
}
// Ẩn hiện thông tin corporate
function toggleIsCorporate(){
    if($('#is_corporate').is(':checked')){
        $('#vat-corp-info').slideDown('fast');
        addToValidateBinaryDependency('EditView', 'account_name', 'alpha', true, DOTB.language.get('app_strings', 'ERR_SQS_NO_MATCH_FIELD') + DOTB.language.get('J_Payment','LBL_ACCOUNT_ID') , 'account_id' );
        addToValidate('EditView', 'company_name', 'text', true, DOTB.language.get('J_Payment','LBL_COMPANY_NAME'));
        addToValidate('EditView', 'tax_code', 'text', true, DOTB.language.get('J_Payment','LBL_TAX_CODE'));
        addToValidate('EditView', 'company_address', 'text', true, DOTB.language.get('J_Payment','LBL_COMPANY_ADDRESS'));
    }else{
        $('#vat-corp-info').slideUp('fast');
        removeFromValidate('EditView','company_name');
        removeFromValidate('EditView','tax_code');
        removeFromValidate('EditView','company_address');
        removeFromValidate('EditView','account_name');
    }
}
// Overwirite set_return Parent Type
function set_return_corp(popup_reply_data){
    $('#company_name_temp, #company_id_temp, #company_name, #company_address, #tax_code').val('');
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
                    $('#account_id').val(val);
                    break;
                case 'account_name':
                    $('#account_name, #company_name').val(val);
                    break;
                case 'company_address':
                    $('#company_address').val(val);
                    break;
                case 'tax_code':
                    $('#tax_code').val(val);
                    break;
            }
        }
    }
}

function togglePaymentMethod(){
    if($('#payment_method_1').val() == 'Card') $('#card_type_1').show();
    else $('#card_type_1').hide();

    if($('#payment_method_2').val() == 'Card') $('#card_type_2').show();
    else $('#card_type_2').hide();

    if($('#payment_method_3').val() == 'Card')$('#card_type_3').show();
    else $('#card_type_3').hide();
}



//Overwrite check_form to validate
function check_form(formname) {
    //Validate sum amount of split payments
    var payment_amount          = Numeric.parse($('#payment_amount').val());
    var payment_amount_1        = Numeric.parse($('#payment_amount_1').val());
    var payment_amount_2        = Numeric.parse($('#payment_amount_2').val());
    var payment_amount_3        = Numeric.parse($('#payment_amount_3').val());
    var number_of_payment       = $('#number_of_payment').val();
    var payment_type            = $('#payment_type').val();
    var  is_installment = $("#is_installment").is(':checked');

    if  (((payment_amount_1 + payment_amount_2 + payment_amount_3 ) != payment_amount) && number_of_payment != "Monthly-plan" && is_installment == false) {
        var mes = DOTB.language.get('J_Payment', 'LBL_ALERT_SUM_SPLIT');
        toastr.error(mes);
        $('#payment_amount_1, #payment_amount_2, #payment_amount_3').effect("highlight", {color: '#FF0000'}, 3000);
        return false;
    }

    if(( payment_type == 'Deposit' || payment_type == 'Placement Test' || payment_type == 'Transfer Fee' || payment_type == 'Other' || payment_type == 'Delay Fee') && payment_amount <= 0  ){
        toastr.error(DOTB.language.get('J_Payment', 'LBL_ALERT_INVALID_AMOUNT'));
        $('#payment_amount').effect("highlight", {color: '#FF0000'}, 3000);
        return false;
    }

    //check book gift in course-free - Tạo
    if(payment_type == 'Book/Gift'){
        var check_quantity = true
        $('#tbodybook tr:not(:first-child)').each(function (index) {
            var quantity = $(this).find('select option:selected').attr('quantity');
            var book_id = $(this).find('select option:selected').val();
            var input_quantity = $(this).find('input.book_quantity').val();
            if(Number(input_quantity) > Number(quantity)) {
                check_quantity = false;
                return false;
            }
            if(window.location.href.indexOf('primary_id')){
                var total_book =0;
                if(book_id != ''){
                    $('#tbodybook tr:not(:first-child)').find('select option:selected[value="'+book_id+'"]').each(function (index) {
                        var parent = $(this).closest('tr');
                        total_book = Number(total_book) + Number(parent.find('.book_quantity')[0].value);
                    });
                }

                if(Number(total_book) > Number(quantity) || total_book == 0){
                    check_quantity = false;
                    return false;
                }
            }

        });


        if(!check_quantity) {
            toastr.error(app.lang.get('LBL_ERROR_QUANTITY', 'J_Payment'));
            return false;
        }
    }

    var result = validate_form(formname, '');
    if(result && alertSelectPayment()){
        DOTB.ajaxUI.showLoadingPanel();
        return true;
    }else return false;


}

function alertSelectPayment(){
    var count_pm           = 0;
    var count_pm_checked   = 0;
    $('.pay_check').each(function(index, brand){
        count_pm++;
        if($(this).is(':checked'))
            count_pm_checked++;
    });
    var total_hours     = Numeric.parse($('#total_hours').val());
    var course_hour     = parseInt($("#coursefee option:selected").attr('type'));
    var course_fee_name = $("#coursefee option:selected").text();
    var payment_type    = $('#payment_type').val();


    if(count_pm > 0 && payment_type_begin == 'Enrollment' && count_pm_checked == 0){
        $.confirm({
            title: 'Hello!',
            content: 'This student have payment remaining.<br> Are you sure you <b>DO NOT USE</b> remaining payments?<br> Click <b>OK</b> to continue saving.<br>Click <b>Cancel</b> to cancel hold and check again.',
            buttons: {
                "OK": {
                    btnClass: 'btn-blue',
                    action: function(){
                        DOTB.ajaxUI.showLoadingPanel();
                        var _form = document.getElementById('EditView');
                        _form.action.value='Save';
                        DOTB.ajaxUI.submitForm(_form);
                        return false;
                    }
                },
                "Cancel": {
                    action: function(){

                    }
                },
            }
        });
    }else if((payment_type == 'Enrollment' || payment_type == 'Cashholder') && count_pm_checked == 0 && ((total_hours <= 36 && course_hour >= 72) || (total_hours <= 72 && course_hour >= 108))){
        var notify = 'Are you sure to add a payment for <b>'+total_hours+' hours</b> with course fee ID<br> <b>'+course_fee_name+'</b> ? <br> Click <b>OK</b> to continue saving.<br>Click <b>Cancel</b> to cancel hold and check again.';
        $.confirm({
            title: 'Confirm!',
            content: notify,
            buttons: {
                "OK": {
                    btnClass: 'btn-blue',
                    action: function(){
                        DOTB.ajaxUI.showLoadingPanel();
                        var _form = document.getElementById('EditView');
                        _form.action.value='Save';
                        DOTB.ajaxUI.submitForm(_form);
                        return false;
                    }
                },
                "Cancel": {
                    action: function(){

                    }
                },
            }
        });
    }else return true;
}