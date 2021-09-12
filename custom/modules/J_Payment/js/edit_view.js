var record_id       = $('input[name=record]').val();
var student_id      = $('#contacts_j_payment_1contacts_ida').val();
var payment_type_begin    = $('#payment_type').val();
var book_index      = 1;
var lock_coursefee = false;
var duplicate_id = $('input[name=duplicateId]').val();
$(document).ready(function() {
    //ngan chan loi load trang lien tuc
    if(payment_type_begin == '0' || payment_type_begin == 'Array' || payment_type_begin == '' || typeof payment_type_begin == 'undefined')
        location.reload();
    //Lock Team
    $( "#tab_discount" ).tabs({
        activate: function( event, ui ) {
            var newGroup = ui.newPanel.attr('id');
            var oldGroup = ui.oldPanel.attr('id');
            $('.'+newGroup).show();
            $('.'+oldGroup).hide();
        }
    });
    $( "#tab_discount" ).show();

    //Change Team Action - Fix bug Mutiple User
    $('#btn_team_id').click(function(){
        open_popup('Teams', 600, 400, "", true, false, {"call_back_function":"set_team_return","form_name":"EditView","field_to_name_array":{"id":"team_id","name":"team_name"}}, "single", true);
    });

    $('#btn_clr_team_id').click(function(){
        $('#team_name,#team_id').val('');
        ajaxGetStudentInfo();
    });

    //Ẩn Option thu tiền theo theo tháng

    $("#number_of_payment").live('change',function(){
        if($(this).val() == 'Monthly-plan'){
            $('#num_month_pay').show();
            addToValidateRange('EditView', 'num_month_pay', 'int', true, DOTB.language.get('J_Payment', 'LBL_NUM_MONTH_PAY'),1,24 );
        }else{
            $('#num_month_pay').hide().val('');
            removeFromValidate('EditView','num_month_pay');
        }
    });
    $("#number_of_payment").trigger('change');

    //Nếu installment_plan có giá trị thì không cho đổi Receipt
    if($('#installment_plan').val() != '') {
        $('[name="pay_dtl_amount[]"]').prop('readonly', true).addClass('input_readonly');
        $('#number_of_payment').find('option').prop("disabled", true);
        $('#number_of_payment option:selected').prop("disabled", false);
    }


    $("#payment_type").live('change',function(){
        var payment_type = $(this).val();
        if(payment_type != 'Cashholder' && payment_type != 'Enrollment'){
            if($('#is_installment').is(':checked'))
                $('#is_installment').trigger('click');
            $('#is_installment').closest('tr').hide();
        }else{
            $('#is_installment').closest('tr').show();
        }
        //Check loylaty
        setLoyaltyLevel();
    });

    //xu li installment
    $("#is_installment").live('change',function(){
        var is_accumulate = $("#coursefee option:selected").attr('is_accumulate');

        if($(this).is(':checked')){
            $('[name="pay_dtl_amount[]"]').prop('readonly',true).addClass('input_readonly');
            $('#installment_plan').show();
            addToValidate('EditView', 'installment_plan', 'enum', true, DOTB.language.get('J_Payment', 'LBL_IS_INSTALLMENT'));
        }
        else{
            $('[name="pay_dtl_amount[]"]').prop('readonly',false).removeClass('input_readonly');
            $('#number_of_payment').find('option').prop("disabled", false);
            $('#number_of_payment').val('1').trigger('change');
            $('#installment_plan').hide().val('');
            removeFromValidate('EditView', 'installment_plan');
        }
        caculated();
        submitDiscount();
        caculated();
        //Check loylaty
        setLoyaltyLevel();

    });
    $("#installment_plan").live('change',function(){
        caculated();
        submitDiscount();
        caculated();
        setLoyaltyLevel();
    });




    $('#table_sponsor').multifield({
        section :   '.row_tpl_sponsor', // First element is template
        addTo   :   '#tbodysponsor', // Append new section to position
        btnAdd  :   '#btnAddSponsor', // Button Add id
        btnRemove:  '.btnRemoveSponsor', // Buton remove id
    });
    // FIELD STUDENT
    // Đổi type input SAVE thành button
    changeTypeInputSubmit($("#SAVE_HEADER"));
    changeTypeInputSubmit($("#SAVE_FOOTER"));
    addToValidate('EditView', 'contacts_j_payment_1contacts_ida', 'varchar', true,'Student' );

    // removeFromValidate('EditView','description');
    //Open Popup
    $('#btn_select_student').click(function(){
        open_popup('Contacts', 600, 400, "", true, false, {"call_back_function":"set_contact_return","form_name":"EditView","field_to_name_array":{"id":"contacts_j_payment_1contacts_ida","name":"name","phone_mobile":"phone_mobile","birthdate":"birthdate"}}, "single", true);
    });

    $('#btn_clr_select_student').click(function(){
        $('#contacts_j_payment_1contacts_ida,#contacts_j_payment_1_name').val('');
        $('#tbodypayment').html("");
        showDialogStudent();
    });

    $('#eye_dialog_123').live('click',function(){
        showDialogStudent(true);
    });

    //FIELD DISCOUNT AND GET DISCOUNT
    $('#btn_get_loyalty').live('click',function(){
        $("body").css({ overflow: 'hidden' });
        calLoyalty();
        showDialogLoyalty();
    });
    $("input#loy_loyalty_points").keyup(function(e){
        calLoyalty();
    });

    $("input#loy_loyalty_points").live('change',function(){
        if($(this).val() > 0){

        }else{
            $(this).val(0);
        }
    });

    $('input.currency').live('change',function(){
        check_currency(this);
    });

    $('#btn_get_discount').live('click',function(){
        $("body").css({ overflow: 'hidden' });
        reloadDiscount();
        showDialogDiscount();
        calDiscount();
    });
    $('#btn_add_sponsor').live('click',function(){
        $("body").css({ overflow: 'hidden' });
        calSponsor();
        showDialogSponsor();
    });
    //Click table rows to select checkbox
    $('#table_discount tr').click(function(event) {
        if ($(this).hasClass("locked")) return;
        if (event.target.type !== 'checkbox' && event.target.type !== 'select-one'){
            $(':checkbox', this).trigger('click');
        }
    });
    $('.dis_check, .discount_partnership, input.dis_hours').live('change',function(){
        calDiscount();
    });
    //Live Change Course Fee
    generateCourseFee();
    $('#coursefee').live('change',function(){
        generateCourseFee();
    });

    $('#coursefee, #duration_exp').live('change',function(){
        var tuition_fee = Numeric.toInt(calCourseFee());
        $('#tuition_fee').val(tuition_fee);
        disableDiscount();
        caculated();
        submitSponsor();
        submitDiscount();
        submitLoyalty();
        caculated();
    });
    if(duplicate_id != '') $('#duration_exp').trigger('change');

    generateKOC();
    $('#coursefee').live('change',generateKOC);

    //if(payment_type_begin == 'Cashholder' || payment_type_begin == 'Deposit'){
    //    $('#kind_of_course').select2({width: '150px'});
    //if($('select#payment_type').length)
    //    $('select#payment_type').select2({minimumResultsForSearch: Infinity,width: '150px'});
    //}

    addToValidate('EditView', 'j_coursefee_j_payment_1j_coursefee_ida[]', 'multienum', true,'Course Fee' );

    //HANDLE ENROLLMENT
    $('#payment_date').live('change',function(){
        //if(!checkDataLockDate($(this).attr('id'),false))
        //    return ;
        var outstanding_list      = $('input[name=outstanding_list]').val();
        if(!isEmpty(outstanding_list) && !$.isEmptyObject($.parseJSON(outstanding_list))){
            ajaxGetStudentInfo();
            outstandingChecking($('#classes').val(), true);
        }
        var number_of_payment   = $('#number_of_payment').val();
        var payment_date       = $('#payment_date').val();
        for(i = 1; i <= number_of_payment; i++ ){
            if($('#pay_dtl_invoice_date_'+i).val() == '' || record_id == '')  //In Case Create
                $('#pay_dtl_invoice_date_'+i).val(payment_date).effect("highlight", {color: '#ff9933'}, 1000);
        }
    });

    $('.pay_check').live('change',function(){
        //#Bug PAY0037
        if($('.pay_check').is(':checked')){
            var type        = $(this).closest('tr').find('.pay_payment_type').text();
            var course_fee_id  = $(this).closest('tr').find('.pay_course_fee_id').val();
            if(course_fee_id != ''){
                $('#coursefee').val(course_fee_id).trigger('change');
                lock_coursefee = true;
            }else lock_coursefee = false;
        }
        if($(this).is(':checked')){
            var this_tr  = $(this).closest('tr');
            $('#assigned_user_id').val(this_tr.find('.assigned_user_id').val());
            $('#user_closed_sale_id').val(this_tr.find('.closed_sale_user_id').val());
            $('#user_pt_demo_id').val(this_tr.find('.pt_demo_user_id').val());
            $('#assigned_user_name').val(this_tr.find('.assigned_user_name').val()).effect("highlight", {color: '#ff9933'}, 1000);
            $('#user_closed_sale').val(this_tr.find('.closed_sale_user_name').val()).effect("highlight", {color: '#ff9933'}, 1000);
            $('#user_pt_demo').val(this_tr.find('.pt_demo_user_name').val()).effect("highlight", {color: '#ff9933'}, 1000);
        }

        //tinh toan lai before discount
        caculated();
        //            //Nap lai discount
        submitSponsor();
        submitDiscount();
        submitLoyalty();
        //            //tinh toan lai so cuoi
        caculated();
    });
    if(payment_type_begin == 'Enrollment'){
        addToValidate('EditView', 'classes', 'multienum', true,'Class' );
        generateClassMultiSelect();

        $('#start_study, #end_study').on('change',function(){
            //    if(!checkDataLockDate($(this).attr('id'),false))
            //        return ;

            validateStart();
            validateEnd();

            //Kiểm tra ngày được chọn có nằm trong lịch không
            rs2 = isInSchedule($(this).val());
            if(!rs2) {
                $(this).val('').effect("highlight", {color: 'red'}, 1000);
                return ;
            }

            calSession(true);
        });
        if(record_id != ''){//In Case edit Enrollment - thong bao nhap lai ngay Start - End
            $('#start_study, #end_study').effect("highlight", {color: 'red'}, 2000);
            $.alert(" In case edit, this class schedule may be changed. Please, choose again !!");
            $('#classes').multiselect('deselectAll', false).multiselect('refresh');
        }

        $('#payment_list_div').closest('td').attr('colspan','4');

        $('#paid_amount').closest('table').closest('tr').hide();
        $('#deposit_amount').closest('table').closest('tr').hide();

        //Gõ số giờ
        $('#tuition_hours').live('change',function(){
            var tuition_hours = Numeric.parse($('#tuition_hours').val());
            var tuition_fee   = Numeric.toInt(calCourseFee(tuition_hours));
            $('#tuition_fee').val(tuition_fee);
            caculated();
            submitSponsor();
            //Nap lai discount
            submitDiscount();
            submitLoyalty();
            //tinh toan lai so cuoi
            caculated();
        });
        //Outing Trip
        $('#tuition_fee').live('blur',function(){
            caculated();
            submitSponsor();
            submitDiscount();
            submitLoyalty();
            caculated();
        });
    }else{
        //HANDLE PAYMENT
        $('#amount_bef_discount').on('blur', function(){
            var amount_bef_discount = Numeric.parse($(this).val());
            $('#tuition_fee').val(Numeric.toInt(amount_bef_discount));
            caculated();
            submitSponsor();
            submitDiscount();
            submitLoyalty();
            caculated();
        });
        $('#tuition_hours').live('change',function(){ // Edit by Lap Nguyen
            $('#total_hours').val($('#tuition_hours').val());
            var total_hours = Numeric.parse($('#total_hours').val());
            var tuition_fee    = Numeric.toInt(calCourseFee(total_hours));
            $('#tuition_fee').val(tuition_fee);
            caculated();
            submitSponsor();
            submitDiscount();
            caculated();
        });
        switchPaymentType();
        $('#payment_type').on('change',function(){
            $('.pay_check:checked').prop('checked',false).trigger('change');
            switchPaymentType();
        });

        $('#tblbook').multifield({
            section :   '.row_tpl', // First element is template
            addTo   :   '#tbodybook', // Append new section to position
            btnAdd  :   '#btnAddrow', // Button Add id
            btnRemove:  '.btnRemove', // Buton remove id
        });

        $('.book_quantity, #payment_type, #is_free_book').live('change',function(){
            calBookPayment();
        });
        $('.book_id').live('change',function(){
            if($(this).val() == 'full-set'){
                var arrSet = [];
                $(this).find(":selected").closest('optgroup').find('option').each(function () {
                    if($(this).val() != 'full-set')
                        arrSet.push($(this).val());
                });
                //Xu ly add row
                var countRow = $('select.book_id').length - 1;
                var rowEq    = $(this).closest('tr').index();
                var remainRow= (countRow - rowEq) + 1;
                var countArrSet = arrSet.length;
                if(countArrSet > remainRow)
                    for (i = 0; i < (countArrSet - remainRow); i++)
                        $('#btnAddrow').trigger('click');
                $(this).val('');//Clear option
                var startAdd = rowEq;
                $.each(arrSet, function( index, value ){
                    $('select.book_id:eq('+startAdd+')').val(value);
                    $('input.book_quantity:eq('+startAdd+')').val('1');
                    startAdd++;
                });
            }
            $('input.book_quantity').each(function() {
                if($(this).val() == '')
                    $(this).val('1');
            });
            calBookPayment();
        });
    }

    if(student_id != '' && student_id != null){
        //Load Student Info agian
        ajaxGetStudentInfo();
    }

    if($('#classes').val() != '')
        $('#classes').multiselect('select', $('#classes').val(), true);

    $('input.sponsor_percent, input.sponsor_amount').live('blur',function(){
        calSponsor();
    });

    $('.check_sponsor').live('click',function(){
        var std_id = $('#contacts_j_payment_1contacts_ida').val();
        if( (std_id == '' || typeof std_id == 'undefined')){
            $.alert("Please, choose a Student before you want to Add Sponsor!!!");
            $(this).closest('tr').find('.sponsor_amount, .sponsor_percent, .voucher_id, .sponsor_number, .foc_type').val('');
            return ;
        }
        ajaxCheckVoucherCode($(this).closest('tr'), std_id);

    });

    $('#payment_amount').live('blur',function(){
        var typeArr = ['Deposit','Placement Test', 'Delay Fee', 'Other','Transfer Fee','Product','Cambridge','Outing Trip'];
        if(jQuery.inArray($('#payment_type').val(), typeArr) !== -1){
            //Bổ sung hàm tự động tính tiền Split Payment
            autoGeneratePayment();
            setLoyaltyLevel();
        }
    });

    generateClassSchedule();

    if($('#is_outing').val() == '1'){
        $('#tuition_fee').removeClass('input_readonly').prop('readonly', false).effect("highlight", {color: '#ff9933'}, 3000);
        removeFromValidate('EditView', 'j_coursefee_j_payment_1j_coursefee_ida[]');
        $('label[for=j_coursefee_j_payment_1j_coursefee_ida]').find('.required').hide();
        $('#coursefee').val('').prop("disabled", true).next(".select2-container").hide();
    }

    //Add SQS
    sqs_objects['EditView_user_pt_demo'] = {
        "form": "EditView",
        "method": "get_user_array",
        "field_list": ["user_name", "id"],
        "populate_list": ["user_pt_demo", "user_pt_demo_id"],
        "required_list": ["user_pt_demo_id"],
        "conditions": [{
            "name": "user_name",
            "op": "like_custom",
            "end": "%",
            "value": ""
        }],
        "limit": "30",
        "no_match_text": "No Match"
    };
    sqs_objects['EditView_user_closed_sale'] = {
        "form": "EditView",
        "method": "get_user_array",
        "field_list": ["user_name", "id"],
        "populate_list": ["user_closed_sale", "user_closed_sale_id"],
        "required_list": ["user_closed_sale_id"],
        "conditions": [{
            "name": "user_name",
            "op": "like_custom",
            "end": "%",
            "value": ""
        }],
        "limit": "30",
        "no_match_text": "No Match"
    };
});

// Đối type của nút SAVE thành button (để không tự động save form khi user ấn enter trong input)
function changeTypeInputSubmit(inputItem){
    var newInput = inputItem.clone();
    newInput.attr("type", "button");
    newInput.insertBefore(inputItem);
    inputItem.remove();
}

//Open Popup
function set_contact_return(popup_reply_data){
    var form_name = popup_reply_data.form_name;
    var name_to_value_array = popup_reply_data.name_to_value_array;
    for (var the_key in name_to_value_array) {
        if (the_key == 'toJSON') {
            continue;
        } else {
            var val = name_to_value_array[the_key].replace(/&amp;/gi, '&').replace(/&lt;/gi, '<').replace(/&gt;/gi, '>').replace(/&#039;/gi, '\'').replace(/&quot;/gi, '"');
            switch (the_key)
            {
                case 'name':
                    var student_name = val;
                    break;
                case 'contacts_j_payment_1contacts_ida':
                    var student_id = val;
                    $("#contacts_j_payment_1contacts_ida").val(val);
                    break;
                case 'phone_mobile':
                    var phone_mobile = val;
                    break;
                case 'birthdate':
                    var birthdate = val;
                    break;
            }
        }
    }
    $('#contacts_j_payment_1_name').val(student_name);
    $('#contacts_j_payment_1contacts_ida').val(student_id);
    ajaxGetStudentInfo();

}

function set_team_return(popup_reply_data){
    var form_name = popup_reply_data.form_name;
    var name_to_value_array = popup_reply_data.name_to_value_array;
    for (var the_key in name_to_value_array) {
        if (the_key == 'toJSON') {
            continue;
        } else {
            var val = name_to_value_array[the_key].replace(/&amp;/gi, '&').replace(/&lt;/gi, '<').replace(/&gt;/gi, '>').replace(/&#039;/gi, '\'').replace(/&quot;/gi, '"');
            switch (the_key)
            {
                case 'team_name':
                    var team_name = val;
                    break;
                case 'team_id':
                    var team_id = val;
                    break;
            }
        }
    }
    $('#team_name').val(team_name);
    $('#team_id').val(team_id);
    ajaxGetStudentInfo();

}
//Show Dialog
function showDialogStudent(show){
    if (show === undefined)
        show = false;

    var json = $('input#json_student_info').val();
    var count = 0;
    var htm = '';
    if(json != '' && json != null ){
        obj = JSON.parse(json);
        //Assign to First EC
        if(obj['info']['assigned_user_id'] != null && obj['info']['assigned_user_id'] != ''){
            $('#assigned_user_name').val(obj['info']['assigned_user_name']);
            $('#assigned_user_id').val(obj['info']['assigned_user_id']);
        }

        //Set Loyalty Point
        $('#loy_total_points').val(Numeric.toFloat(obj.loyalty_points));
        $('#loy_loyalty_rate_out_value').val(Numeric.toFloat(obj.loyalty_rate_out_value));

        $('#loy_loyalty_rate_out_id').val(obj.loyalty_rate_out_id);
        $('.loy_student_name').text(obj['info']['student_name']);
        $('#loy_loyalty_mem_level').val(obj['mem_level']);
        $('#loy_net_amount').val(Numeric.toFloat(obj['net_amount']));
        //End: Set Loyalty Point

        htm +=  "Name: <span id='student_name'>"+ obj['info']['student_name']+"</span><br>";
        htm +=  "Mobile: "+ obj['info']['phone']+"<br>";
        htm +=  "Birthday: "+ obj['info']['birthday']+"<br>";
        htm +=  "<hr>";

        htm +=  "<b>Study</b><br>";
        if(obj.class_list == 0)
            htm += "-none-<br>";
        var outstanding_list = {};
        $.each(obj.class_list, function(key, value){
            //Handle Log Outstanding
            if(value.type == 'OutStanding'){
                outstanding_list[key] = {}
                outstanding_list[key]['student_name']    =  value.student_name;
                outstanding_list[key]['class_id']        =  value.class_id;
                outstanding_list[key]['class_name']      =  value.class_name;
                outstanding_list[key]['total_hour']      =  unformatNumber(value.total_hour, num_grp_sep, dec_sep);
                outstanding_list[key]['total_revenue_util_now']      =  unformatNumber(value.total_revenue_util_now, num_grp_sep, dec_sep);
                outstanding_list[key]['start_study']     =  value.start_study;
                outstanding_list[key]['end_study']       =  value.end_study;
            }

            htm +=  "<b><a  style='text-decoration: none;' href='#bwc/index.php?module=J_Class&action=DetailView&record="+value.class_id+"'>"+value.class_name+"</a></b>";
            htm +=  "<p>Type: <b style='color: #FF8C00;'>"+value.type+"</b></p>";
            htm +=  "<p style='margin-left:10px;'>Hour: "+value.total_hour+" hours</p>";
            htm +=  "<p style='margin-left:10px;'>Start: "+ DOTB.util.DateUtils.formatDate(new Date(value.start_study)) +"</p>";
            htm +=  "<p style='margin-left:10px;'>Finish: "+ DOTB.util.DateUtils.formatDate(new Date(value.end_study))+"</p>";
        });
        $('input[name=outstanding_list]').val(JSON.stringify(outstanding_list));
        htm +=  "<hr>";
        htm +=  "<b>Payment</b><br>";
        if(obj.left_list == 0)
            htm += "-none-<br>";
        $.each(obj.left_list, function( key, value ) {
            htm +=  "<p><a  style='text-decoration: none;' href='#bwc/index.php?module=J_Payment&action=DetailView&record="+key+"'>"+value+"</a></p>";
        });
        htm +=  "<hr>";
        htm +=  "<a  style='text-decoration: none; float: right; font-weight: bold;' href='#bwc/index.php?module=Contacts&action=DetailView&record="+obj['info']['id']+"'>More Info >></a><br>";
    }else
        htm += "<em font-style:normal;'> -- No Infomation -- </em>";

    if (show) {
        $('#dialog_student_info').html(htm);
        $('#dialog_student_info').attr('title','Student Information')

        $('#dialog_student_info').dialog({
            resizable: false,
            width:'auto',
            height:'500',
            modal: false,
            visible: true,
            position: {
                my: 'top',
                at: 'right',
                of: event
            }
        });

        $('#dialog_student_info').effect("highlight", {color: '#ff9933'}, 1000);
    }

    //Show Payment List
    var html    = '';
    var count   = 0;
    $.each(obj.top_list, function( key, value ) {
        html += "<tr>";
        if(value['is_expired'])
            html += "<td align='right'>";
        else
            html += "<td align='right'><input type='checkbox' style='vertical-align: baseline;zoom: 1.2;' class='pay_check' value='"+value['payment_id']+"'"+value['checked']+">";


        html += "<input type='hidden' class='assigned_user_id' value='"+value['assigned_user_id']+"'/>";
        html += "<input type='hidden' class='assigned_user_name' value='"+value['assigned_user_name']+"'/>";
        html += "<input type='hidden' class='closed_sale_user_id' value='"+value['closed_sale_user_id']+"'/>";
        html += "<input type='hidden' class='closed_sale_user_name' value='"+value['closed_sale_user_name']+"'/>";
        html += "<input type='hidden' class='pt_demo_user_id' value='"+value['pt_demo_user_id']+"'/>";
        html += "<input type='hidden' class='pt_demo_user_name' value='"+value['pt_demo_user_name']+"'/>";

        html += "<input type='hidden' class='used_discount' value='"+value['used_discount']+"'/>";
        html += "<input type='hidden' class='use_type' value='"+value['use_type']+"'/><input type='hidden' class='pay_course_fee_id' value='"+value['course_fee_id']+"'/></td>";
        html += "<td align='center'><a  style='text-decoration: none;font-weight: bold;' href='#bwc/index.php?module=J_Payment&action=DetailView&record="+value['payment_id']+"'>"+value['payment_code']+"</a></td>";
        html += "<td align='center' class='pay_payment_type'>"+value['payment_type']+"</td>";
        html += "<td align='center'>"+value['payment_date']+"</td>";
        if(value['is_expired'])
            html += "<td align='center' style='color: red;'>"+value['payment_expired']+"</td>";
        else html += "<td align='center'>"+value['payment_expired']+"</td>";

        html += "<td align='center' class='pay_payment_amount'>"+Numeric.toFloat(value['payment_amount'])+"</td>";
        html += "<td align='center' class='pay_total_hours'>"+Numeric.toFloat(value['total_hours'],2,2)+"</td>";
        html += "<td align='center' class='pay_remain_amount'>"+Numeric.toFloat(value['remain_amount'])+"</td>";
        html += "<td align='center' class='pay_remain_hours'>"+Numeric.toFloat(value['remain_hours'],2,2)+"</td>";
        html += "<td align='center' class='pay_course_fee'>"+value['course_fee']+"</td>";
        html += "<td align='center'><a  style='text-decoration: none;' href='#bwc/index.php?module=Users&action=DetailView&record="+value['assigned_user_id']+"'>"+value['assigned_user_name']+"</a></td>";
        html += "</tr>";
        count++
    });
    if(count == 0){
        html += '<tr><td colspan="11" style="text-align: center;">No Payment Avaiable</td></tr>';
    }
    $('#tbodypayment').html(html);
    // Convert Link BWC Frame
    var bwcComponent = parent.DOTB.App.controller.layout.getComponent("bwc");
    bwcComponent.rewriteLinks();
}

//Ajax get Student Info
function ajaxGetStudentInfo(){
    $('#classes').multiselect('disable');
    $('#payment_type').prop('disabled',true).addClass('input_readonly');
    var current_team_id =  $('input[name=team_id]').val();

    DOTB.ajaxUI.showLoadingPanel();
    $.ajax({
        url: "index.php?module=J_Payment&action=handleAjaxPayment&dotb_body_only=true",
        type: "POST",
        async: true,
        data:  {
            type            : 'ajaxGetStudentInfo',
            enrollment_id   : record_id,
            current_team_id : current_team_id,
            payment_type    : payment_type_begin,
            student_id      : $('#contacts_j_payment_1contacts_ida').val(),
            payment_date    : $('#payment_date').val(),
        },
        dataType: "json",
        success: function(res){
            DOTB.ajaxUI.hideLoadingPanel();

            if(res.success == "1"){
                $('input#json_student_info').val(res.content);
                caculated();
                submitSponsor();
                submitDiscount();
                submitLoyalty();
                caculated();
            }else{
                $('input#json_student_info').val('');
                toastr.error(res.messenge);
            }


            showDialogStudent();
            $('#classes').multiselect('enable');
            $('#payment_type').prop('disabled',false).removeClass('input_readonly');
        },
    });
}

function generateClassMultiSelect(){
    $('#classes').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth: '225px',
        maxHeight: 400,
        enableHTML : true,
        optionLabel: function(element)
        {
            var start_date  = $(element).attr("start_date");
            var end_date    = $(element).attr("end_date");
            var class_name  = $(element).attr("class_name");
            var class_type  = $(element).attr("class_type");
            var class_status  = $(element).attr("class_status");
            var kind_of_course  = $(element).attr("kind_of_course");

            var sub_text = "<small>";
            sub_text += "<br>Class name: " + class_name;
            sub_text += "<br>Start - Finish: " + start_date+' - '+end_date;
            sub_text += "<br>Course: " + kind_of_course;

            switch (class_status){
                case 'In Progress':
                    var status = 'textbg_blue';
                    break;
                case 'Planning':
                    var status = 'textbg_green';
                    break;
                case 'Closed':
                    var status = 'Closed';
                    break;
                case 'Finished':
                    var status = 'textbg_red';
                    break;
            }

            sub_text += "<br>Status: <span class='"+status+"'>" + class_status + "</span>";

            sub_text += "</small>";
            return $(element).html() + sub_text;
        },
        onChange: function(option, checked, select) {
            //Calculate End Date - Start Date
            var minStartDate = 2066289000000; //Year 2035
            var maxEndDate = 939513600000;    //Year 1999
            var countSelected   = 0;
            var countOuting     = 0;

            $('#classes option:selected').each(function(index, brand){
                var start = DOTB.util.DateUtils.parse($(this).attr("start_date"),cal_date_format).getTime();
                var end = DOTB.util.DateUtils.parse($(this).attr("end_date"),cal_date_format).getTime();
                if(minStartDate > start)
                    minStartDate = start;
                if(maxEndDate < end)
                    maxEndDate = end;
                // Open readonly Tuition Hours
                countSelected++;
                var class_type = $(this).attr("class_type");

                //Count Kind of course
                var kind_of_course = $(this).attr("kind_of_course");
                if(kind_of_course == 'Outing Trip' || kind_of_course == 'KIDS CAMP' || kind_of_course == 'Short Course' || kind_of_course == 'SHORT COURSE' || kind_of_course == 'Event')
                    countOuting++;
            });

            $('#tuition_hours').addClass('input_readonly').prop('readonly', true);

            if(countOuting == countSelected && countSelected == 1){
                $('#tuition_fee').removeClass('input_readonly').prop('readonly', false).effect("highlight", {color: '#ff9933'}, 3000);
                removeFromValidate('EditView', 'j_coursefee_j_payment_1j_coursefee_ida[]');
                $('label[for=j_coursefee_j_payment_1j_coursefee_ida]').hide();
                $('#coursefee').val('').prop("disabled", true).next(".select2-container").hide();
                var is_outing = true;
            }else{
                $('#tuition_fee').addClass('input_readonly').prop('readonly', true);
                addToValidate('EditView', 'j_coursefee_j_payment_1j_coursefee_ida[]', 'multienum', true,'Course Fee ID' );
                $('label[for=j_coursefee_j_payment_1j_coursefee_ida]').show();
                $('#coursefee').prop("disabled", false).next(".select2-container").show();
                var is_outing = false;
            }

            if($('#classes option:selected').length == 0)
                $('#class_start, #class_end, #start_study, #end_study').val('');
            else{
                //    $('#start_study').val(DOTB.util.DateUtils.formatDate(new Date()));  //Fix loi enrollment full lop
                $('#start_study,#class_start').val(DOTB.util.DateUtils.formatDate(new Date(minStartDate)));
                $('#end_study, #class_end').val(DOTB.util.DateUtils.formatDate(new Date(maxEndDate)));
            }
            //Check Outstanding
            var oustanding = outstandingChecking(option.val(), checked);
            calSession(true);
            if(countSelected > 0 && !is_outing){
                $("#coursefee").trigger('change');     //Mới thay đổi
            }else{
                $("#coursefee").val('');
            }
            if(is_outing) $('#is_outing').val('1');
            else $('#is_outing').val('0');
            generateClassSchedule();
        },
        filterPlaceholder: 'Select class'
    });
}

function outstandingChecking(class_id, checked){
    //Check Outstanding
    var outstanding_list = $('input[name=outstanding_list]').val();
    if(outstanding_list != '')
        var obj_outstanding = JSON.parse(outstanding_list);
    else obj_outstanding = '';

    var countOst = 0;
    $.each(obj_outstanding, function( key, value ) {
        if(class_id == value.class_id){
            countOst++;
            classOst    = value.class_id;
            student_name= value.student_name;
            classNameOst= value.class_name;
            startOst    = DOTB.util.DateUtils.formatDate(new Date(value.start_study));
            endOst      = DOTB.util.DateUtils.formatDate(new Date(value.end_study));
            hourOst     = Numeric.toFloat(value.total_hour,2,2);
            hourOstUtilNow     = Numeric.toFloat(value.total_revenue_util_now,2,2);
            hourRest     = Numeric.toFloat(value.total_hour - value.total_revenue_util_now,2,2);
        }
    });
    if(countOst > 0 && checked){
        $.confirm({
            title: 'Confirm!',
            content: 'Student <b>'+student_name+'</b> has been added outstanding <br>in class <b>'+classNameOst+'</b><br><br>Total Outstanding Hours(until '+$('#payment_date').val()+'): <b>'+hourOstUtilNow+' hours</b>.<br> Total continuing hours: <b>'+hourRest+' hours</b>.<br>Total hours: <b>'+hourOst+' hours</b>.<br>Does he/she want to pay now ?',
            buttons: {
                "OK": {
                    btnClass: 'btn-blue',
                    action: function(){
                        $('#classes').multiselect('select', class_id, false);
                        $('#classes').removeAttr('multiple').val(class_id).multiselect("destroy").addClass('input_readonly').find('option:not(:selected)').prop('disabled', true);
                        $('#start_study').val(startOst).addClass('input_readonly').prop('readonly', true);
                        $('#end_study').val(endOst).addClass('input_readonly').prop('readonly', true);
                        $('#start_study_trigger, #end_study_trigger').hide();
                        $('input[name=is_outstanding]').val('1');
                        calSession(false);
                        return true;             //not generate start date
                    }
                },
                "Cancel": {
                    action: function(){
                        $('#classes').val('').attr('multiple','multiple').multiselect("destroy").find('option:not(:selected)').prop('disabled', false);
                        generateClassMultiSelect();
                        $('#classes').multiselect('deselect', class_id).multiselect('refresh');
                        $('#start_study').val('').removeClass('input_readonly').prop('readonly', false);
                        $('#end_study').val('').removeClass('input_readonly').prop('readonly', false);
                        $('#start_study_trigger, #end_study_trigger').show();
                        $('input[name=is_outstanding]').val('0');

                        toastr.success('Please select another class to make enrollment!');
                        calSession(true);
                        return true;
                    }
                },
            }
        });
    }else
        return false;

}

function calSession(generate_start_date){
    if($('#start_study').val() != '' && $('#end_study').val() != ''){
        var start_study         = DOTB.util.DateUtils.parse($('#start_study').val(),cal_date_format);
        var end_study           = DOTB.util.DateUtils.parse($('#end_study').val(),cal_date_format);
        var is_outstanding      = $('input[name=is_outstanding]').val();
        //        var paid_hours          = Numeric.parse($('#paid_hours').val());
        //        var paid_amount         = Numeric.parse($('#paid_amount').val());
        //        var is_over_paidhours   = $('#is_over_paidhours').val();

        YAHOO.widget.DateMath._addDays(end_study,1) //+ 1days
        var now_date = Date.today();
        if(start_study < now_date && is_outstanding != '1')
            toastr.success('Make sure to add student to this class, because this class has already started and some lesson finished !');

        var count = 0
        var tuition_hours= 0;
        var class_list = {};
        var set_end= '';
        if(generate_start_date)
            $('#start_study').val(DOTB.util.DateUtils.formatDate(new Date()));
        $('#classes option:selected').each(function(index, brand){
            var class_ = $(this);
            var seleted_class_id = $(this).val();
            isHistory(seleted_class_id);
            class_list[seleted_class_id] =  {};
            var start_obj 	= '';
            var end_obj 	= '';
            var hour_obj 	= 0;
            var count_inside= 0;

            // Calculate tuition hours
            obj = JSON.parse(class_.attr("json_ss"));
            $.each(obj, function( key, value ) {
                if((new Date(key) <= end_study) && (new Date(key) >= start_study)){
                    //                    if(is_over_paidhours == '0' && paid_hours > 0 && (tuition_hours + Numeric.parse(value)) > paid_hours ){
                    //                        set_end = end_obj;
                    //                        return false;
                    //                    }

                    count++;
                    if(count == 1 && generate_start_date) //Set start study is first date schedule
                        $('#start_study').val(DOTB.util.DateUtils.formatDate(new Date(key)));
                    count_inside++;
                    tuition_hours	= tuition_hours + Numeric.parse(value);
                    hour_obj		= hour_obj + Numeric.parse(value);
                    if(count_inside == 1) start_obj = key;
                    end_obj = key;

                }
            });
            class_list[$(this).val()]['class_id']       = $(this).val();
            class_list[$(this).val()]['total_hour'] 	= hour_obj;
            class_list[$(this).val()]['start_study'] 	= start_obj;
            class_list[$(this).val()]['end_study'] 		= end_obj;
        });
        $('#sessions').val(count);
        $('#tuition_hours').val(Numeric.toFloat(tuition_hours,2,2));

        var class_content = JSON.stringify(class_list);
        $('input[name=content]').val(class_content);

        //        if(set_end != '')
        //            $('#end_study').val(DOTB.util.DateUtils.formatDate(new Date(set_end))).effect("highlight", {color: '#ff9933'}, 1000);
        //
        var tuition_fee = Numeric.toInt(calCourseFee(tuition_hours));
        $('#tuition_fee').val(tuition_fee);
    }
    else{
        $('#sessions').val(0);
        $('#tuition_hours').val(0);
        $('#tuition_fee').val(0);
    }

    //tinh toan lai before discount
    caculated();
    //Nap lai discount
    submitSponsor();
    submitDiscount();
    submitLoyalty();
    //tinh toan lai so cuoi
    caculated();
}
//Check Class is history Class
function isHistory(class_id){
    var json_class = $('#class_list').val();
    var found = 0;
    if(json_class != '' && json_class != null){
        obj_class = JSON.parse(json_class);

        $.each(obj_class, function( key, idclass ) {
            if(idclass.id == class_id)
                found++;
        });
    }
    if(found > 0){
        toastr.error('Class has been learning');
        return true;
    }
    else return false;
}

function showDialogDiscount(){
    $( "#dialog_discount" ).dialog({
        resizable: false,
        width: 700,
        height: 500,
        modal: true,
        hideCloseButton: true,
        buttons: {
            "Submit":{
                click:function() {
                    submitSponsor();
                    submitDiscount();
                    submitLoyalty();
                    caculated();
                    $(this).dialog('close');
                },
                class: 'button primary',
                text: DOTB.language.get('J_Payment', 'LBL_SUBMIT'),
            },
            "Cancel":{
                click:function() {
                    $(this).dialog('close');
                },
                class: 'button',
                text: DOTB.language.get('J_Payment', 'LBL_CANCEL'),
            },
        },
        beforeClose: function(event, ui) {
            $("body").css({ overflow: 'inherit' });
        },
    });
}
function showDialogSponsor(){
    $( "#dialog_sponsor" ).dialog({
        resizable: false,
        width: 700,
        modal: true,
        hideCloseButton: true,
        buttons: {
            "Submit":{
                click:function() {
                    submitSponsor();
                    submitDiscount();
                    submitLoyalty();
                    caculated();
                    $(this).dialog('close');
                },
                class: 'button primary',
                text: 'Submit',
            },
            "Cancel":{
                click:function() {
                    var sponsor_list = $('#sponsor_list').val();
                    if(sponsor_list == '' || sponsor_list == '{}' || sponsor_list == '[]'){
                        $('.sponsor_number').not(':eq(0)').val('');
                        $('.foc_type').not(':eq(0)').val('');
                        $('.sponsor_amount').not(':eq(0)').val('');
                        $('.sponsor_percent').not(':eq(0)').val('');
                        $('.btnRemoveSponsor').not(':eq(1)').not(':eq(0)').trigger('click');
                    }else{
                        submitSponsor();
                        submitDiscount();
                        submitLoyalty();
                        caculated();
                    }
                    $(this).dialog('close');
                },
                class: 'button',
                text: 'Cancel',
            }
        },
        beforeClose: function(event, ui) {
            $("body").css({ overflow: 'inherit' });
        },
    });
}
function showDialogLoyalty(){
    $( "#dialog_loyalty" ).dialog({
        resizable: false,
        width: 600,
        modal: true,
        hideCloseButton: true,
        buttons: {
            "Submit":{
                click:function() {
                    submitSponsor();
                    submitDiscount();
                    submitLoyalty();
                    caculated();
                    $(this).dialog('close');
                },
                class: 'button primary',
                text: 'Submit',
            },
            "Cancel": {
                click:function() {
                    $(this).dialog('close');
                },
                class: 'button',
                text: 'Cancel',
            }


        },
        beforeClose: function(event, ui) {
            $("body").css({ overflow: 'inherit' });
        },
    });
}
function generateCourseFee(){
    var course_type  = '';
    var len_course   = $("#coursefee option:selected").length;

    var atype   = $("#coursefee option:selected:eq(0)").attr('type');
    var ah_w    = $("#coursefee option:selected:eq(0)").attr('h_w');
    var aprice  = 0;  //su dung cho goi hoc theo gio
    var ahour   = 0;  //su dung cho goi hoc theo gio
    var arr_exp = [];

    //Lock CourseFee By Type
    if(atype != '' && typeof atype != 'undefined'){
        $("#coursefee option[type!='"+atype+"']").attr("disabled",true);
        $('#coursefee').select2();
    }else{
        $("#coursefee option").removeAttr('disabled');
        $('#coursefee').select2();
    }
    $.each($("#coursefee option:selected"), function(key, coursefee){

        var cHour  = Numeric.parse($(this).attr('hour'));
        var cID    = $(this).val();
        var cPrice = Numeric.parse($(this).attr('price'));

        aprice += cPrice; //su dung cho goi hoc theo gio
        ahour  += cHour;  //su dung cho goi hoc theo gio

        if(atype == 'Sessions') course_type     = 'sessions'
        if(atype == 'Hour/Month') course_type   = 'months'
        if(atype == 'Hour/Week') course_type    = 'weeks'


        var json_exp = $(this).attr('duration_exp');
        if(json_exp != '' && json_exp != null){
            obj_exp = JSON.parse(json_exp);
            if(arr_exp.length == 0){
                $.each(obj_exp, function(idx, obj_e){
                    var expArr = {
                        id  : [cID],
                        json: obj_e,
                        hour: cHour * Numeric.parse(obj_e),
                        price: cPrice,
                    };
                    arr_exp.push(expArr);
                });
            }else{
                arr_exp.map(function (arr_exp1, idx) {

                    $.each(obj_exp, function(idx, obj_e){
                        var tHour  = cHour * Numeric.parse(obj_e);
                        var ttHour = arr_exp1.hour + tHour;

                        var expArr = {
                            id   : arr_exp1.id.concat(cID),
                            json : (Numeric.parse(arr_exp1.json) + Numeric.parse(obj_e)) + ' ' + course_type,
                            hour : ttHour,
                            price: (arr_exp1.price * (arr_exp1.hour/ttHour)) + (cPrice * (tHour/ttHour)),
                        };
                        arr_exp.push(expArr);

                    });
                });
            }
        }
    });

    if((atype == 'Sessions') || (atype == 'Hour/Week') || (atype == 'Hour/Month')){
        $('.duration_exp').show();
        addToValidate('EditView','duration_exp','enum',true,DOTB.language.get('J_Payment', 'LBL_DURATION_EXP'));
    }else{
        $('.duration_exp').hide();
        removeFromValidate('EditView','duration_exp');
    }


    var selected = $('select#duration_exp').val();
    $('select#duration_exp option:not(:first)').remove();

    aprice = aprice / len_course;
    ahour  = ahour / len_course;

    $.each(arr_exp, function( key, value ){
        if(value.id.length == len_course && ((atype == 'Sessions') || (atype == 'Hour/Week') || (atype == 'Hour/Month'))){ //combo 3
            $('select#duration_exp').append($("<option></option>")
                .attr("hour",value.hour)
                .attr("price",value.price)
                .attr("value",value.json)
                .text(value.json));

            if($('select#duration_exp').val() == '' && record_id == '')
                $('select#duration_exp option[value="'+value.json+'"]').prop('selected', true);
            else{
                $('select#duration_exp option[value="'+selected+'"]').prop('selected', true);
            }
            //Set value cho truong hop Enrollment
            aprice = value.price;
            ahour = value.hour;
        }
    });

    if(len_course > 1){
        app.alert.show('message-id', {
            level: 'success',
            title: 'You are choosing Combo Prices!',
            autoClose: true
        });
    }

    //assign
    $("#aprice").val(aprice);
    $("#ahour").val(ahour);
    $("#atype").val(atype);

}
//Calculate Course Fee
function calCourseFee(tuition_hours){
    if((tuition_hours == '' || typeof tuition_hours == 'undefined')) tuition_hours = Numeric.parse($('#tuition_hours').val());

    var payment_type = $("#payment_type").val();
    var aprice       = Numeric.parse($("#aprice").val());
    var ahour        = Numeric.parse($("#ahour").val());
    var atype        = $("#atype").val();

    //xoa atype
    // if(atype == 'Hour/Month'){
    //     $("#number_of_payment").val('Monthly-plan').trigger('change');
    // }

    if((atype == 'Sessions' || atype == 'Hour/Month' || (atype == 'Hour/Week')) && payment_type == 'Cashholder' ){
        var duration_exp = $('select#duration_exp').val();
        ahour  = Numeric.parse($('select#duration_exp option:selected').attr('hour'));
        aprice = Numeric.parse($('select#duration_exp option:selected').attr('price'));

        tuition_hours   = ahour;
        $('#tuition_hours').val(Numeric.toFloat(tuition_hours,2,2)).prop('readonly',true).addClass('input_readonly');

        tuition_fee = tuition_hours * aprice;

    }else if((atype == 'Sessions' || atype == 'Hour/Month' || (atype == 'Hour/Week')) && payment_type == 'Enrollment' ){
        var duration_exp = $('select#duration_exp').val();

        tuition_fee = aprice * tuition_hours;
        if(payment_type == 'Cashholder')
            $('#tuition_hours').prop('readonly',false).removeClass('input_readonly');
    }else{
        price = aprice / ahour;
        tuition_fee = price * tuition_hours;
        if(payment_type == 'Cashholder'){

            $('#tuition_hours').prop('readonly',false).removeClass('input_readonly');
            if(tuition_hours == 0 && tuition_fee == 0){
                $('#tuition_hours').val(Numeric.toFloat(ahour,2,2)).trigger('change');
            }
        }

    }
    return tuition_fee;
}

function setLoyaltyLevel(){
    var current_level        = $('#loy_loyalty_mem_level').val();
    var net_amount           = Numeric.parse($('#loy_net_amount').val());
    var amount_bef_discount  = Numeric.parse($('#amount_bef_discount').val());
    var discount_amount      = Numeric.parse($('#discount_amount').val());
    var final_sponsor        = Numeric.parse($('#final_sponsor').val());
    var loyalty_amount       = Numeric.parse($('#loyalty_amount').val());
    var payment_amount       = Numeric.parse($('#payment_amount').val());
    var sum_current_amount   = net_amount + payment_amount + discount_amount + final_sponsor + loyalty_amount;

    var overwrite_loyalty_point = Numeric.parse($('#overwrite_loyalty_point').val());//Discount Loyalty Point

    var rate_out            = Numeric.parse($('#loy_loyalty_rate_out_value').val());//Get Loyalty Rate Out From Ajax

    var total_dis_spon_loy = (discount_amount + final_sponsor);
    //add Loyalty Reward
    var accrual_rate_value = $('input#accrual_rate_value').val();

    if($("#is_installment").is(':checked'))//Xu ly tra gop
        accrual_rate_value = 0;

    //    if(((total_dis_spon_loy /  amount_bef_discount) * 100 ) >= 30) //Over discount 30%
    //        accrual_rate_value = 0;

    $('span#accrual_rate_label').text( '('+(accrual_rate_value * 100)+'%)' );
    $('input#total_rewards_amount').val(Numeric.toInt(Math.floor ( (payment_amount * accrual_rate_value) / rate_out ) * rate_out));

    if(overwrite_loyalty_point > 0){
        if(accrual_rate_value > 0)
            $('span#accrual_rate_label').text( '('+(accrual_rate_value * 100)+'% + '+Numeric.toFloat(overwrite_loyalty_point,0,0)+'pts)' );
        else
            $('span#accrual_rate_label').text('('+Numeric.toFloat(overwrite_loyalty_point,0,0)+'pts)');
        $('input#total_rewards_amount').val(Numeric.toInt( (Math.floor((payment_amount * accrual_rate_value) / rate_out ) + overwrite_loyalty_point) * rate_out));
    }else if(overwrite_loyalty_point == '-1'){
        $('span#accrual_rate_label').text( '('+(accrual_rate_value * 100)*2+'%)');
        $('input#total_rewards_amount').val(Numeric.toInt( (Math.floor((payment_amount * accrual_rate_value) / rate_out ) * 2) * rate_out));
    }

    if(payment_amount <= 0 || payment_amount == '')
        sum_current_amount   = net_amount;

    var rank_link            = [];
    var level                = 'N/A';
    var html                 = '';
    if(typeof DOTB.language.languages['app_list_strings'] != 'undefined')
        rank_link = DOTB.language.languages['app_list_strings']['loyalty_rank_list'];

    if(typeof rank_link != 'undefined'){
        if(sum_current_amount >= parseInt(rank_link['Blue']))
            level = 'Blue';
        if(sum_current_amount >= parseInt(rank_link['Gold']))
            level = 'Gold';
        if(sum_current_amount >= parseInt(rank_link['Platinum']))
            level = 'Platinum';
    }
    //Set HTML
    if(level == 'Platinum'){
        html = '<label><span class="textbg_black">'+level+'</span></label>';
    }else if(level == 'Gold'){
        html = '<label><span class="textbg_yellow">'+level+'</span></label>';
    }else if(level == 'Blue'){
        html = '<label><span class="textbg_bluelight">'+level+'</span></label>';
    }else{
        html = '<label><span class="textbg_nocolor">'+level+'</span></label>';
    }
    $('.loy_loyalty_mem_level').html(html);
    $('#loy_loyalty_mem_level').val(level);
    return level;
}

function caculated(){
    // Caculate Payment list
    var payment_type = $('#payment_type').val();

    var payment_list = {};
    payment_list['paid_list']       =  {};
    payment_list['deposit_list']    =  {};
    var total_used_amount  = 0;
    var total_used_hours  = 0;
    var total_deposit_amount  = 0;
    var tuition_fee         = Numeric.parse($('#tuition_fee').val());
    var amount_bef_discount = Numeric.parse($('#amount_bef_discount').val());
    var discount_amount     = Numeric.parse($('#discount_amount').val());
    var tuition_hours       = Numeric.parse($('#tuition_hours').val());
    var discount_percent    = Numeric.parse($('#discount_percent').val());
    var loyalty_amount      = Numeric.parse($('#loyalty_amount').val());
    var loyalty_percent     = Numeric.parse($('#loyalty_percent').val());
    var duration_exp        = $('select#duration_exp').val();
    var af_duration_exp     = duration_exp;
    var payment_amount      = 0;
    var remaining_freebalace      = 0;

    //discount hours
    var dis_hours      = Numeric.parse($('#dis_hours').val());

    var final_sponsor           = Numeric.parse($('#final_sponsor').val());
    var final_sponsor_percent   = Numeric.parse($('#final_sponsor_percent').val());

    //
    var total_after_discount = Numeric.parse($('#total_after_discount').val());

    var price_enroll = (tuition_fee) / (tuition_hours); // đơn giá tổng
    if (!isFinite(price_enroll)) price_enroll = 0;
    var total_hours = Numeric.parse(tuition_hours);

    // add paid payment to json
    var count_pay = 0;

    $('.pay_check:checked').each(function(index, brand){
        var payment_related_type = $(this).closest('tr').find('.pay_payment_type').text();
        var use_type    = $(this).closest('tr').find('.use_type').val();
        var paid_type   = ["Cashholder"];
        var used_amount = Numeric.parse($(this).closest('tr').find('.pay_remain_amount').text());
        var used_hours  = Numeric.parse($(this).closest('tr').find('.pay_remain_hours').text());
        if(($.inArray(payment_related_type,paid_type) >= 0 || use_type == "Hour") && (total_hours > 0) && (used_hours > 0)){
            var temp_price = used_amount / used_hours;
            total_hours = total_hours - used_hours;
            if(total_hours < 0){
                used_hours = used_hours + total_hours;
                total_hours = 0;
            }
            used_amount = temp_price * used_hours;

            total_used_amount += used_amount;
            total_used_hours += used_hours;

            payment_list['paid_list'][$(this).val()] = {};
            payment_list['paid_list'][$(this).val()]["id"] = $(this).val();
            payment_list['paid_list'][$(this).val()]["used_amount"] = used_amount;
            payment_list['paid_list'][$(this).val()]["used_hours"] = used_hours;
            count_pay++;

        }
    });
    if (payment_type == "Cashholder") amount_bef_discount = calCourseFee(total_hours);
    else if (payment_type == "Enrollment") amount_bef_discount = price_enroll * total_hours;

    //Get - áp dụng cho Discount và Sponsor
    var coursefee_hour = parseInt($("#coursefee option:selected").attr('type'));
    var total_after_discount = amount_bef_discount - discount_amount - final_sponsor;

    payment_amount = total_after_discount - loyalty_amount;
    var total_discount_sponsor = loyalty_amount + discount_amount + final_sponsor;
    // add deposit payment to json
    $('.pay_check:checked').each(function(index, brand){
        var payment_type = $(this).closest('tr').find('.pay_payment_type').text();
        var use_type = $(this).closest('tr').find('.use_type').val();
        var used_amount = Numeric.parse($(this).closest('tr').find('.pay_remain_amount').text());
        if((payment_type == 'Deposit' || use_type == "Amount") && (payment_amount > 0) && (used_amount > 0)){
            payment_amount = payment_amount - used_amount;
            if(payment_amount < 0){
                used_amount = used_amount + payment_amount;
                remaining_freebalace += payment_amount;
                payment_amount = 0;
            }
            total_deposit_amount += used_amount;

            payment_list['deposit_list'][$(this).val()] = {};
            payment_list['deposit_list'][$(this).val()]["id"] = $(this).val();
            payment_list['deposit_list'][$(this).val()]["used_amount"] = used_amount;
            payment_list['deposit_list'][$(this).val()]["used_hours"] = 0;
            count_pay++;
        }
    });
    var str_json_payment_list = '';
    if(count_pay > 0)
        str_json_payment_list = JSON.stringify(payment_list);

    $('#payment_list').val(str_json_payment_list);

    if(total_used_hours > 0)
        $('#paid_amount').closest('table').closest('tr').show();
    else
        $('#paid_amount').closest('table').closest('tr').hide();

    if(total_deposit_amount > 0)
        $('#deposit_amount').closest('table').closest('tr').show();
    else
        $('#deposit_amount').closest('table').closest('tr').hide();
    //Assign money
    $('#tuition_fee').val(Numeric.toInt(tuition_fee));
    //không làm tròn 2 số này
    $('#paid_amount').val(Numeric.toFloat(total_used_amount));
    $('#deposit_amount').val(Numeric.toFloat(total_deposit_amount));

    $('#amount_bef_discount').val(Numeric.toInt(amount_bef_discount));
    $('#total_after_discount').val(Numeric.toInt(total_after_discount));
    $('#total_discount_sponsor').val(Numeric.toInt(total_discount_sponsor));
    $('#remaining_freebalace').val(Numeric.toFloat(Math.abs(remaining_freebalace)));
    $('#payment_amount').val(Numeric.toInt(payment_amount));
    $('#af_duration_exp').val(af_duration_exp);
    //Assign hour
    $('#tuition_hours').val(Numeric.toFloat(tuition_hours,2,2));
    $('#paid_hours').val(Numeric.toFloat(total_used_hours,2,2));

    $('#total_hours').val(Numeric.toFloat(total_hours + dis_hours,2,2));

    //Bổ sung hàm tự động tính tiền Split Payment
    //lay % installment
    var is_installment = false;
    if($('#installment_plan').val() != '' && $('#is_installment').is(':checked')&& (payment_type == "Cashholder" || payment_type == "Enrollment")){
        installment_plan = $('#installment_plan').val().replace( /^\D+/g, '');
        is_installment = true;
    }

    if(is_installment){

        var pmd_1 = (amount_bef_discount * '0.3') + (total_after_discount * Numeric.parse(installment_plan)) - (total_discount_sponsor);
        var pmd_2 = amount_bef_discount * '0.7';
        if(installment_plan != ''){
            if(total_deposit_amount > 0){
                if(pmd_1 <= total_deposit_amount) {
                    $('#number_of_payment').find('option').prop("disabled", false);
                    $('#number_of_payment').val('1').trigger('change');
                    $('#number_of_payment').find('option').prop("disabled", true);
                    $('#number_of_payment option:selected').prop("disabled", false);
                    autoGeneratePayment();
                    $("#payment_amount_1").val(Numeric.toInt(pmd_2-(total_deposit_amount-pmd_1)));
                }
                else{
                    $('#number_of_payment').find('option').prop("disabled", false);
                    $('#number_of_payment').val('2').trigger('change');
                    $('#number_of_payment').find('option').prop("disabled", true);
                    $('#number_of_payment option:selected').prop("disabled", false);
                    autoGeneratePayment();
                    $("#payment_amount_1").val(Numeric.toInt(pmd_1-total_deposit_amount));
                    $("#payment_amount_2").val(Numeric.toInt(pmd_2));
                }
            }
            else {
                $('#number_of_payment').find('option').prop("disabled", false);
                $('#number_of_payment').val('2').trigger('change');
                $('#number_of_payment').find('option').prop("disabled", true);
                $('#number_of_payment option:selected').prop("disabled", false);
                autoGeneratePayment();
                $("#payment_amount_1").val(Numeric.toInt(pmd_1));
                $("#payment_amount_2").val(Numeric.toInt(pmd_2));
            }
            var payment_amount_installment = Numeric.parse( $("#payment_amount_1").val()) +  Numeric.parse( $("#payment_amount_2").val());
            $('#payment_amount').val(Numeric.toInt(payment_amount_installment));
        }else{
            //TH Trả góp Credit
            $('#number_of_payment').find('option').prop("disabled", false);
            $('#number_of_payment').val('1').trigger('change');
            $('#number_of_payment').find('option').prop("disabled", true);
            $('#number_of_payment option:selected').prop("disabled", false);
        }
    }
    else {
        $('#payment_amount').val(Numeric.toInt(payment_amount));
        autoGeneratePayment();
    }


    setLoyaltyLevel();
}

function ajaxCheckVoucherCode(self ,student_id){
    var voucher_code    = self.find('.sponsor_number').val().replace(/ /g,'');

    if(voucher_code != ''){
        //Ajax check Sponsor code
        $.ajax({
            url: "index.php?module=J_Payment&action=handleAjaxPayment&dotb_body_only=true",
            type: "POST",
            async: false,
            data:  {
                type            : 'ajaxCheckVoucherCode',
                voucher_code    : voucher_code,
                student_id      : student_id,
                payment_id      : record_id,
                payment_date    : $('#payment_date').val(),
            },
            dataType: "json",
            success: function(res){
                DOTB.ajaxUI.hideLoadingPanel();
                if(res.success == "1"){

                    var discount_amount = '<br>Discount: '+res.discount_amount;
                    var discount_percent= '<br>Discount %: '+res.discount_percent;
                    if(res.discount_amount == 0) discount_amount = '';
                    if(res.discount_percent == 0) discount_percent = '';

                    var description = ''
                    if(res.description != '') description = ' ('+res.description+')';

                    var student = '';
                    if(res.type == 'Loyalty') student = '<br>Student Name: ' + res.student_name;

                    if(res.status == 'Expired' || res.status == 'Inactive' ){
                        self.find('.sponsor_amount, .sponsor_percent, .voucher_id, .sponsor_number, .foc_type').val('');

                    }else{
                        self.find('.sponsor_amount').val(res.discount_amount);
                        self.find('.sponsor_percent').val(res.discount_percent);
                        self.find('.loyalty_points').val(res.loyalty_points);
                        self.find('.voucher_id').val(res.voucher_id);
                        self.find('.type').val(res.type);
                        self.find('.foc_type').val(res.foc_type);
                        self.find('.sponsor_number').val(res.sponsor_number);
                        self.find('.description').val(res.description);
                    }
                    self.find('.foc_type').trigger('change');

                    $.alert('Sponsor: '+ res.sponsor_number + student + res.status_color+'<br>'+ description +'<br>Expires: ' + res.end_date + discount_amount + discount_percent + '<br>Total Redemption: '+ res.used_time);
                    // Convert Link BWC Frame
                    var bwcComponent = parent.DOTB.App.controller.layout.getComponent("bwc");
                    bwcComponent.rewriteLinks();

                }else if(res.success == "0"){
                    self.find('.sponsor_amount, .sponsor_percent, .voucher_id, .sponsor_number, .loyalty_points, .type, .foc_type, .description').val('');
                    $.alert('Sponsor not fould !');
                }
                calSponsor();
            },
        });
        //END
    }

}

function calLoyalty(){
    var points              = Number(Numeric.parse($('#loy_loyalty_points').val()));
    var max_points          = Number(Numeric.parse($('#loy_total_points').val()));
    var rate_out            = Numeric.parse($('#loy_loyalty_rate_out_value').val());
    var rate_out_id         = $('#loy_loyalty_rate_out_id').val();
    var total_after_discount= Numeric.parse( $('#total_after_discount').val());
    var catch_limit         = $('#catch_limit').val();
    var limited_discount    = Numeric.parse($('#limited_discount_amount').val());    //limit discount
    var discount_amount     = Numeric.parse($('#discount_amount').val());
    var max_policy_points   = Number((limited_discount - discount_amount) / rate_out);
    if(max_points <= 0)
        $('#loy_loyalty_points').val(0).prop('disabled',true).addClass('input_readonly');
    else
        $('#loy_loyalty_points').prop('disabled',false).removeClass('input_readonly');


    if( (points < min_points || points > max_points || isNaN(points)) && max_points > 0 ){
        toastr.error('Invalid Value: '+points+'. Loyalty Point should be within the valid range '+min_points+' -> '+max_points);
        $('#loy_loyalty_points').val(1).effect("highlight", {color: '#ff9933'}, 1000);
        calLoyalty();
        return ;
    }

    if(max_policy_points > 0 && points > max_policy_points){
        toastr.error('Note: Limited Discount '+limit_discount_percent+'%. Maximum loyalty points can be use: '+max_policy_points+' points.');
        $('#loy_loyalty_points').val(max_policy_points).effect("highlight", {color: '#ff9933'}, 1000);
        calLoyalty();
        return ;
    }

    //Tính Loyalty
    var amount_to_spend = points * rate_out;
    var blend_balance   = amount_to_spend - total_after_discount;
    var blend_point     = Math.floor(blend_balance/rate_out);
    if( blend_point > 0 ){
        toastr.error("Total Loyalty Spend must be greater than Total Payment Amount. Please, check the price & hours carefully!");
        $('#loy_loyalty_points').val(points - blend_point);
        calLoyalty();
        return ;
    }

    $('.loy_points_to_spend').text(Numeric.toFloat(points) + ' points ('+ Numeric.toFloat(amount_to_spend) +' VND)' );
    $('#loy_points_to_spend').val(Numeric.toFloat(points));
    $('#loy_amount_to_spend').val(Numeric.toFloat(amount_to_spend));
    $('.loy_total_points').text(Numeric.toFloat(max_points) + ' points');
    $('.loy_loyalty_rate_out_value').text(Numeric.toFloat(rate_out) + ' VND');
}

function submitLoyalty(){
    calLoyalty();
    var amount_bef_discount     = Numeric.parse($('#amount_bef_discount').val());
    var loy_loyalty_mem_level   = $('#loy_loyalty_mem_level').val();
    var loyalty_list            = {};
    loyalty_list['points_to_spend'] = $('#loy_points_to_spend').val();
    loyalty_list['amount_to_spend'] = $('#loy_amount_to_spend').val();
    loyalty_list['max_points']  = $('#loy_total_points').val();
    loyalty_list['min_points']  = min_points;
    loyalty_list['rate_out']    = $('#loy_loyalty_rate_out_value').val();
    loyalty_list['rate_out_id'] = $('#loy_loyalty_rate_out_id').val();
    if(Numeric.parse(loyalty_list['amount_to_spend']) > 0){
        var loyalty_percent = (Numeric.parse(loyalty_list['amount_to_spend']) / amount_bef_discount) * 100;
        $('#loyalty_list').val(JSON.stringify(loyalty_list));
        $('#loyalty_amount').val(loyalty_list['amount_to_spend']);
        $('#loyalty_percent').val(Numeric.toFloat(loyalty_percent,2,2));
    }else{
        $('#loyalty_list').val('');
        $('#loyalty_amount').val(0);
        $('#loyalty_percent').val(Numeric.toFloat(0,2));
    }
}


function calSponsor(){
    var total_sponsor_percent       = 0;
    var total_sponsor_amount        = 0;
    var count_referal               = 0;
    var amount_bef_discount         = Numeric.parse($('#amount_bef_discount').val());
    $('.row_tpl_sponsor').not(":eq(0)").each(function(index, brand){
        var sponsor_amount = Numeric.parse($(this).find('.sponsor_amount').val());
        var sponsor_percent = Numeric.parse($(this).find('.sponsor_percent').val());

        total_sponsor_amount += (sponsor_amount)

        total_sponsor_percent  += sponsor_percent;
    });

    //Tính Sponsor
    $('.sponsor_amount_bef_discount').text(Numeric.toInt(amount_bef_discount));
    $('.total_sponsor_amount').text(Numeric.toInt(total_sponsor_amount));
    $('.total_sponsor_percent').text(Numeric.toFloat(total_sponsor_percent,2,2));

    var total_sponsor_percent_to_amount = ((amount_bef_discount - total_sponsor_amount) * total_sponsor_percent / 100);

    var final_sponsor = total_sponsor_amount + total_sponsor_percent_to_amount;
    var final_sponsor_percent = (final_sponsor / amount_bef_discount) * 100;

    if(final_sponsor > amount_bef_discount )  {
        final_sponsor = amount_bef_discount;
        final_sponsor_percent = 100;
    }

    $('.final_sponsor').text(Numeric.toInt(final_sponsor));
    $('.final_sponsor_percent').val(Numeric.toFloat(final_sponsor_percent,2,2));
    $('.total_sponsor_percent_to_amount').val(Numeric.toInt(total_sponsor_percent_to_amount));

}

function submitSponsor(){
    calSponsor();
    var sponsor_list = {};
    var count = 0;
    var count_error = 0;
    var total_sponsor_percent_to_amount  = Numeric.parse($('.total_sponsor_percent_to_amount').val());
    var total_sponsor_percent            = Numeric.parse($('.total_sponsor_percent').text());
    var amount_bef_discount         = Numeric.parse($('#amount_bef_discount').val());
    $('.row_tpl_sponsor').not(":eq(0)").each(function(index, brand){
        var total_sponsor_down = 0;
        var sponsor_number  = $(this).find('.sponsor_number').val();
        var foc_type        = $(this).find('.foc_type').val();
        var loyalty_points  = $(this).find('.loyalty_points').val();
        var type            = $(this).find('.type').val();
        var voucher_id      = $(this).find('.voucher_id').val();
        var sponsor_amount  = Numeric.parse($(this).find('.sponsor_amount').val());
        var sponsor_percent = Numeric.parse($(this).find('.sponsor_percent').val());
        var description     = $(this).find('.description').val();
        if(sponsor_amount != 0 || sponsor_percent != 0 ){
            if(sponsor_number == '' || foc_type == ''){
                count_error++;
                return;
            }
        }
        if(sponsor_percent > 100){
            count_error++;
            return;
        }

        total_sponsor_down += (sponsor_amount)

        if(total_sponsor_percent != 0)
            total_sponsor_down += total_sponsor_percent_to_amount * (sponsor_percent/total_sponsor_percent);

        if(amount_bef_discount < total_sponsor_down) total_sponsor_down = amount_bef_discount
        if(sponsor_number != '' && foc_type != ''){
            sponsor_list[count]                     = {};
            sponsor_list[count]['voucher_id']       = voucher_id;
            sponsor_list[count]['sponsor_number']   = sponsor_number;
            sponsor_list[count]['type']             = type;
            sponsor_list[count]['foc_type']         = foc_type;
            sponsor_list[count]['loyalty_points']   = loyalty_points;
            sponsor_list[count]['sponsor_amount']   = Numeric.toInt(sponsor_amount);
            sponsor_list[count]['sponsor_percent']  = Numeric.toFloat(sponsor_percent,2,2);
            sponsor_list[count]['total_down']       = Numeric.toInt(total_sponsor_down);
            sponsor_list[count]['description']      = description;
            count++;
        }
    });
    if(count_error > 0){
        toastr.error('Please fill out the information completely !');
        return false;
    }
    $('#sponsor_list').val(JSON.stringify(sponsor_list));
    $('#final_sponsor').val($('.final_sponsor').text());
    $('#final_sponsor_percent').val($('.final_sponsor_percent').val());
}

function reloadDiscount(){
    //Remove all selected
    $("select.discount_partnership option:selected").prop("selected", false);
    $('.dis_check').prop("checked", false);
    //Parse and Ship json
    var json = $('input#discount_list').val();
    if(json != '' && json != null){
        obj = JSON.parse(json);

        $.each(obj, function(id, dis_obj) {
            if(dis_obj.type == 'Partnership'){
                $.each($('input.dis_check'), function(index, brand) {
                    if($(this).val() == dis_obj.id){
                        $(this).closest('tr').find('select.discount_partnership').val(dis_obj.partnership_id);
                        $(this).closest('tr').find('.dis_check').prop('checked',true);
                    }
                });
            }
            else
                $('.dis_check[value=' + id + ']').prop('checked',true);
        });
    }
}

function disableDiscount(){
    var default_dis_list    = $("#coursefee option:selected").attr('default_dis_list');
    var payment_type = $('#payment_type').val();

    $.each($('input.dis_check'), function(index, brand) {
        $(this).closest('tr').show();
        $(this).prop('checked',false);
    });

    if(default_dis_list != '' && default_dis_list != null && payment_type == 'Cashholder' ){
        var default_dis_list = JSON.parse(default_dis_list);

        if(default_dis_list != '{}' && default_dis_list != '') {
            $.each($('input.dis_check'), function(index, brand) {
                var dis_id = $(this).val();
                if($.inArray( dis_id, default_dis_list ) == -1) {
                    $(this).closest('tr').hide();
                }
            });

        }
    }
}

function calDiscount(){
    checkAvailableDiscount();
    //Handle schema apply with discount
    $('.dis_amount_bef_discount').text($('#amount_bef_discount').val());
    var dis_amount_bef_discount = Numeric.parse($('#amount_bef_discount').val());
    var dis_total_hours     = Numeric.parse($('#total_hours').val());
    var dis_tuition_hours   = Numeric.parse($('#tuition_hours').val());
    var current_loyalty     = $('#loy_loyalty_mem_level').val();
    var final_sponsor   = Numeric.parse($('#final_sponsor').val());
    var loyalty_amount  = Numeric.parse($('#loyalty_amount').val());
    var accrual_rate_value = 0;
    var is_accumulate       = $("#coursefee option:selected").attr('is_accumulate');
    if(is_accumulate == 1){
        if(typeof DOTB.language.languages['app_list_strings'] != 'undefined')
            accrual_rate_value = Numeric.parse(DOTB.language.languages['app_list_strings']['default_loyalty_rate']['Accrual Rate ('+current_loyalty+')']);
    }

    var dis_discount_amount     = 0;
    var dis_loyalty_point       = 0;
    var dis_discount_percent    = 0;
    var chain_discount_percent  = 0;
    var partnership_amount      = 0;
    var partnership_percent     = 0;
    var dis_total_discount      = 0;
    var dis_total_discount_amount      = 0;
    var dis_total_discount_percent     = 0;
    var dis_chain_discount = 0;
    var dis_trade_discount = 0;
    var dis_hours = 0;
    var payment_type    = $('#payment_type').val();

    var maximum_percent = 0;

    $('.dis_check').each(function(index, brand){
        var dis_type            = $(this).closest('tr').find('input.dis_type').val();
        if(dis_type == 'Other' || dis_type == 'Hour'){
            var dis_content_json    = $(this).closest('tr').find('input.dis_content').val();
            if(dis_content_json != '' && dis_content_json != null )
                var dis_obj = JSON.parse(dis_content_json);

            var cr_maximum = Numeric.parse($(this).attr('maximum_percent'));
            if(cr_maximum > maximum_percent && $(this).is(":checked"))
                maximum_percent = cr_maximum;

            var dis_amount         = Numeric.parse($(this).closest('tr').find('.dis_amount').val());
            var dis_percent        = Numeric.parse($(this).closest('tr').find('.dis_percent').val());
            var has_class          = $(this).closest('tr').find(".dis_hours").hasClass("input_readonly");
            dis_hours          = Numeric.parse($(this).closest('tr').find(".dis_hours").val());
            if(dis_type == 'Hour' && payment_type == 'Cashholder' ){
                if(typeof dis_obj != 'undefined' && has_class){
                    var catch_hour  = 0;
                    var rph = 0;
                    var pmh = 0;
                    $.each(dis_obj.discount_by_hour, function(index, value){
                        if(dis_tuition_hours >= Numeric.parse(value.hours)){
                            catch_hour++;
                            rph = dis_tuition_hours - Numeric.parse(value.hours);
                            pmh = Numeric.parse(value.promotion_hours);
                        }
                    });

                    dis_hours = pmh;
                }
                dis_amount = 0;
                $(this).closest('tr').find("td:eq(3)").text(dis_amount == "0"? ""  : Numeric.toInt(dis_amount));
                $(this).closest('tr').find(".dis_amount").val(dis_amount == "0" ? ""  : Numeric.toInt(dis_amount));
                $(this).closest('tr').find(".dis_hours").val(Numeric.toFloat(dis_hours,2,2));
            }
            if(dis_type == 'Other' && $(this).is(":checked")){
                dis_percent = Numeric.parse($(this).closest('tr').find('.dis_percent').val());
            }
            if($(this).is(":checked")){
                var is_chain_discount  = $(this).attr('is_chain_discount');
                var is_trade_discount  = $(this).attr('is_trade_discount');

                if(is_chain_discount == 1)
                    dis_chain_discount++;
                if(is_trade_discount == 1)
                    dis_trade_discount++;
                dis_discount_amount     += dis_amount;
                if(chain_discount_percent > 0) //Chain Discount
                    chain_discount_percent *= (1 - (dis_percent/100));
                else
                    chain_discount_percent = (1 - (dis_percent/100));

                dis_discount_percent += (dis_percent / 100);

                //Xu ly disable accrual_rate_value
                var is_acc_dis = $(this).attr('is_accumulate');
                if(is_acc_dis == 0)
                    accrual_rate_value = 0;
            }
        }
    });

    // calculate Partnership
    $('select.discount_partnership').each(function(index, brand){
        var partnership_percent = 0;
        var partnership_amount  = 0;
        var partnership_loyalty_point  = 0;
        var is_auto_set         = $(this).closest('tr').find('.dis_check').attr('is_auto_set');

        //Auto set Partnership
        if(is_auto_set == '1'){
            var value_set = '';
            $(this).find('option').each(function(index, value){
                var apply_with_loyalty  = $(this).attr("apply_with_loyalty");
                var apply_with_hour     = Numeric.parse($(this).attr("apply_with_hour"));
                if( ((current_loyalty == apply_with_loyalty) && (apply_with_loyalty != '')) || (dis_tuition_hours >= apply_with_hour && apply_with_hour > 0)){
                    value_set = value.value;
                }
            });
            $(this).val(value_set);
        }

        if(($(this).val() != '') && ($(this).val() != null)){
            partnership_amount  = Numeric.parse($(this).find('option:selected').attr("dis_amount"));
            partnership_percent = Numeric.parse($(this).find('option:selected').attr("dis_percent"));
            partnership_loyalty_point = Numeric.parse($(this).find('option:selected').attr("loyalty_point"));
            apply_with_loyalty  = $(this).find('option:selected').attr("apply_with_loyalty");
            if(($(this).closest('tr').find('.dis_check').is(":checked"))){
                var is_chain_discount   = $(this).closest('tr').find('.dis_check').attr('is_chain_discount');
                var is_trade_discount   = $(this).closest('tr').find('.dis_check').attr('is_trade_discount');

                if(is_chain_discount == 1)
                    dis_chain_discount++;

                if(is_trade_discount == 1)
                    dis_trade_discount++;

                dis_discount_amount  += partnership_amount;

                if(chain_discount_percent > 0) //Chain Discount
                    chain_discount_percent *= (1 - (partnership_percent/100));
                else
                    chain_discount_percent = (1 - (partnership_percent/100));


                dis_discount_percent += (partnership_percent/ 100);

                //Xet Loyalty Reward by Discount
                var is_acc_dis      = $(this).closest('tr').find('.dis_check').attr('is_accumulate');
                if(is_acc_dis == 0) accrual_rate_value = 0;
                dis_loyalty_point += partnership_loyalty_point;
            }
        }

        //assign
        $(this).parent().parent().find("td:eq(2)").text(partnership_percent == "0"? "" : Numeric.toFloat(partnership_percent),2,2);
        $(this).parent().parent().find("td:eq(3)").text(partnership_amount == "0"? ""  : Numeric.toInt(partnership_amount));
    });

    if(chain_discount_percent > 0)
        chain_discount_percent = (1 - chain_discount_percent);
    else chain_discount_percent = 0;

    //Apply chain discount
    if(dis_chain_discount > 0){
        dis_discount_percent = chain_discount_percent;
    }
    //END:

    dis_total_discount_amount       = dis_discount_amount;

    if(dis_trade_discount > 0)
        dis_total_discount_percent      = (dis_discount_percent) * dis_amount_bef_discount;
    else
        dis_total_discount_percent      = (dis_discount_percent)*(dis_amount_bef_discount - dis_total_discount_amount - loyalty_amount  - final_sponsor);

    dis_total_discount              = dis_total_discount_amount + dis_total_discount_percent;
    //assign
    $('.dis_total_discount').text(Numeric.toInt(dis_total_discount));

    $('.dis_discount_percent').text(Numeric.toFloat(dis_discount_percent*100,2,2));
    $('.dis_discount_percent_p').val(Numeric.toFloat(dis_discount_percent*100,2,2));
    $('.dis_discount_amount').text(Numeric.toInt(dis_total_discount_amount));

    var limit_percent = limit_discount_percent;
    if(maximum_percent > 0)           //Bo dien kien thay doi limit
        limit_percent = maximum_percent;

    //Compare with limit - Limited Discount chỉ áp dụng cho Discount
    var limited_discount    = ((((limit_percent/100) - accrual_rate_value) * dis_amount_bef_discount) + (accrual_rate_value * final_sponsor)) / (1 - accrual_rate_value);    //limit discount

    var catch_limit = false;
    $('#catch_limit').val('0');
    if( (dis_total_discount) >= limited_discount){
        dis_total_discount = limited_discount;
        catch_limit = true;
        $('#catch_limit').val('1');
    }
    var dis_final_discount_percent = Numeric.toFloat((dis_total_discount / (dis_amount_bef_discount)) * 100,2,2);

    if(catch_limit)
        $('.dis_alert_discount').html("&nbsp;&nbsp;&nbsp;(limited "+limit_percent+"%)").show();
    else $('.dis_alert_discount').hide();
    //assign final discount
    $('.dis_final_discount').text(Numeric.toInt(dis_total_discount));
    $('.dis_final_discount_percent').val(dis_final_discount_percent);
    $('.dis_discount_percent_to_amount').val(Numeric.toInt(dis_total_discount_percent));
    $('#limited_discount_amount').val();
    $('span#accrual_rate_label').text( '('+(accrual_rate_value * 100)+'%)' );
    $('input#accrual_rate_value').val(accrual_rate_value);

    //Xu ly clear loyalty
    var limited_discount_amount = Numeric.toInt(limited_discount);
    $('#limited_discount_amount').val(limited_discount_amount);
    $('#overwrite_loyalty_point').val(Numeric.toFloat(dis_loyalty_point,0,0));

    setLoyaltyLevel();
}

function submitDiscount(){
    calDiscount();
    var discount_list = {};
    var count = 0;
    var description = 'Chiết khấu: ';
    var catch_limit =  $('#catch_limit').val();
    var dis_discount_percent_to_amount  = Numeric.parse($('.dis_discount_percent_to_amount').val());
    var discount_percent                = Numeric.parse($('.dis_discount_percent_p').val());//Chain Discount

    var total_discount = Numeric.parse($('.dis_total_discount').text());
    var final_discount = Numeric.parse($('.dis_final_discount').text());

    //discount hour
    var total_hours = Numeric.parse($('#total_hours').val());
    var dis_hours   = 0;

    $('.dis_check:checked').each(function(index, brand){
        var dis_type            = $(this).closest('tr').find('input.dis_type').val();
        if(dis_type == 'Other' || dis_type == 'Hour'){
            var dis_percent     = Numeric.parse($(this).closest('tr').find('.dis_percent').val());
            var dis_amount      = Numeric.parse($(this).closest('tr').find('.dis_amount').val());
            var dis_is_catch_limit    = $(this).closest('tr').find('input.dis_is_catch_limit').val();
            var total_down      = dis_amount;

            var row_dis_hours = Numeric.parse($(this).closest('tr').find('.dis_hours').val());

            if(discount_percent != 0)
                total_down += (dis_discount_percent_to_amount * (dis_percent/discount_percent));
            if(catch_limit == '1' && dis_is_catch_limit == 1)
                total_down = (total_down * (final_discount) / (total_discount));

            count++;
            discount_list[$(this).val()] =  {};
            discount_list[$(this).val()]['id']          =  $(this).val();
            discount_list[$(this).val()]['type']        =  'Discount';
            discount_list[$(this).val()]['dis_percent']  = Numeric.toFloat(dis_percent,2,2);
            discount_list[$(this).val()]['dis_amount']   = Numeric.toInt(dis_amount);
            discount_list[$(this).val()]['total_down']   = Numeric.toInt(total_down);
            if(count == 1)
                var des =  $(this).closest('tr').find('.dis_name').text();
            else var des = ', '+$(this).closest('tr').find('.dis_name').text();
            if(dis_type == 'Hour'){
                //add to field dis_hours
                dis_hours += row_dis_hours;
            }
            description = description + des;
        }
    });

    //partnership
    $('select.discount_partnership').each(function(index, brand){
        if(($(this).val() != '') && ($(this).val() != null) && ($(this).closest('tr').find('.dis_check').is(":checked"))){
            var dis_percent     = Numeric.parse($(this).find('option:selected').attr("dis_percent"));
            var dis_amount      = Numeric.parse($(this).find('option:selected').attr("dis_amount"));
            var dis_is_catch_limit      = $(this).closest('tr').find('input.dis_is_catch_limit').val();
            var total_down      = dis_amount;
            var dis_partnership_name= $(this).closest('tr').find(".dis_name").text();

            if(discount_percent != 0)
                total_down  += (dis_discount_percent_to_amount * (dis_percent/discount_percent));

            if(catch_limit == '1' && dis_is_catch_limit == 1)
                total_down = (total_down * (final_discount) / (total_discount));

            count++;
            var dis_partnership_id = $(this).closest('tr').find(".dis_check").val();
            discount_list[dis_partnership_id] = {};
            discount_list[dis_partnership_id]['id']           = dis_partnership_id;
            discount_list[dis_partnership_id]['type']         = 'Partnership';
            discount_list[dis_partnership_id]['dis_percent']  = Numeric.toFloat(dis_percent,2,2);
            discount_list[dis_partnership_id]['dis_amount']   = Numeric.toInt(dis_amount);
            discount_list[dis_partnership_id]['total_down']   = Numeric.toInt(total_down);
            discount_list[dis_partnership_id]['partnership_id']= $(this).val();
            if(count == 1)
                description = description;
            else
                description = description + ', ';
            description = description + dis_partnership_name + ': ' + $(this).find('option:selected').text();
        }
    });
    var str_json_discount = '';
    var str_json_discount = JSON.stringify(discount_list);
    if (description == "Chiết khấu: ") description = '';
    //Add Sponsor Description
    var sponsor_list = $('#sponsor_list').val();
    if(sponsor_list != '' && typeof sponsor_list != 'undefined'){
        var sponsor_objs = JSON.parse(sponsor_list);
        $.each(sponsor_objs, function( key, sponsor_obj ) {
            description = description + ", Sponsor Code: " +sponsor_obj.sponsor_number;
        });
    }
    //add field dis_hours
    $('#dis_hours').val(Numeric.toFloat(dis_hours,2,2));
    $('#description').val(description);
    $('#discount_list').val(str_json_discount);
    $('#discount_amount').val($('.dis_final_discount').text());
    $('#discount_percent').val($('.dis_final_discount_percent').val());
    $('#sub_discount_amount').val($('.dis_discount_amount').text());
    $('#sub_discount_percent').val($('.dis_discount_percent').text());
}

function switchPaymentType(){
    var type = $('#payment_type').val();

    if(record_id == '' && (duplicate_id == '' || typeof duplicate_id == 'undefined')){  //In Case Create
        $('#tuition_hours').val('');
        $('#tuition_fee').val('');
        $('#amount_bef_discount').val('');
        $('#payment_amount').val('');
        $('.dis_check').prop('checked',false);
        submitSponsor();
        submitDiscount();
        submitLoyalty();
        caculated();
    }
    switch (type) {
        case 'Cashholder':
            $('#tuition_hours').prop('readonly',false).removeClass('input_readonly');
            $('#payment_amount').prop('readonly',true).addClass('input_readonly');
            $('#amount_bef_discount').prop('readonly',true).addClass('input_readonly');

            $("#is_free_book").closest('tr').hide();
            $('#detailpanel_1').show();

            $('#duration_exp').closest('table').closest('tr').show();
            $('#amount_bef_discount').closest('table').closest('tr').show();
            $('#total_discount_sponsor').closest('table').closest('tr').show();
            $('#total_discount_sponsor').closest('table').closest('td').show().prev().show().closest('tr').show();
            $('#total_after_discount').closest('td').show().prev().show().closest('tr').show();
            $('#total_rewards_amount').closest('td').show().prev().show();

            $( "#tab_discount" ).tabs( "enable" );
            $('a[href="#discount"]').click();

            $('#kind_of_course').closest('td').next().show().next().show().closest('tr').show();

            addToValidate('EditView', 'j_coursefee_j_payment_1j_coursefee_ida[]', 'multienum', true,'Course Fee' );
            addToValidate('EditView','kind_of_course','enum',true,DOTB.language.get('J_Payment', 'LBL_KIND_OF_COURSE'));
            break;
        case 'Deposit':
        case 'Placement Test':
        case 'Transfer Fee':
        case 'Cambridge':
        case 'Other':
        case 'Transfer Fee':
        case 'Delay Fee':

            $('#tuition_hours').prop('readonly',true).addClass('input_readonly');
            $('#payment_amount').prop('readonly',false).removeClass('input_readonly');
            $("#coursefee").val('').trigger('change');

            $("#is_free_book").closest('tr').hide();
            $('#detailpanel_1').hide();

            $('#duration_exp').closest('table').closest('tr').hide();
            $('#amount_bef_discount').closest('table').closest('tr').hide();
            $('#total_discount_sponsor').closest('table').closest('tr').hide();
            $('#total_discount_sponsor').closest('table').closest('td').hide().prev().hide().closest('tr').hide();
            $('#total_after_discount').closest('td').hide().prev().hide().closest('tr').hide();
            $('#total_rewards_amount').closest('td').hide().prev().hide();

            if(type == 'Deposit'){
                $('#kind_of_course').closest('td').next().hide().next().hide().closest('tr').show();
                addToValidate('EditView','kind_of_course','enum',true,DOTB.language.get('J_Payment', 'LBL_KIND_OF_COURSE'));
            }else
                removeFromValidate('EditView', 'kind_of_course');


            removeFromValidate('EditView', 'j_coursefee_j_payment_1j_coursefee_ida[]');
            removeFromValidate('EditView', 'duration_exp');
            break;
        case 'Product':
            $('#tblbook').show();
            $('#detailpanel_1').hide();
            $("#is_free_book").closest('tr').show();

            $('#duration_exp').closest('table').closest('tr').hide();
            $('#amount_bef_discount').closest('table').closest('tr').hide();
            $('#total_discount_sponsor').closest('table').closest('td').hide().prev().hide().closest('tr').show();
            $('#total_after_discount').closest('td').hide().prev().hide().closest('tr').show();
            $('#total_rewards_amount').closest('td').hide().prev().hide();

            $( "#tab_discount" ).tabs( "enable" );
            $('a[href="#loyalty"]').click();
            $('#tab_discount').tabs("option","disabled", [0,1]);

            $('#payment_amount').prop('readonly',true).addClass('input_readonly');

            removeFromValidate('EditView', 'kind_of_course');
            removeFromValidate('EditView', 'j_coursefee_j_payment_1j_coursefee_ida[]');
            removeFromValidate('EditView', 'duration_exp');
            break;
    }
}
function calBookPayment(){
    var total_pay = 0;
    $('#tblbook tbody tr').each(function(index, brand){
        var book_price      = Numeric.parse($(this).find('select.book_id option:selected').attr('price'));
        var book_unit      = $(this).find('select.book_id option:selected').attr('unit');
        var book_quantity   = parseInt($(this).find('.book_quantity').val());
        var book_cost       = (book_price * book_quantity);
        if(window.location.href.indexOf('primary_id') != -1)
            book_cost =0;
        $(this).find('.book_price').val(Numeric.toInt(book_price));
        $(this).find('.book_amount').val(Numeric.toInt(book_cost));
        $(this).find('.book_unit').text(book_unit);
        total_pay           = total_pay + book_cost;
    });

    if($('#is_free_book').is(':checked'))
        $('#amount_bef_discount, #total_after_discount').val(0);
    else
        $('#amount_bef_discount, #total_after_discount, #total_book_pay').val(Numeric.toInt(total_pay));

    setLoyaltyLevel();
    submitLoyalty();
    caculated();
    autoGeneratePayment();
}
function handleRemoveRow(){
    calBookPayment();
}

//Validate start study date
function validateStart(){
    $classStart   = DOTB.util.DateUtils.parse($('#class_start').val(),cal_date_format).getTime();
    $classEnd     = DOTB.util.DateUtils.parse($('#class_end').val(),cal_date_format).getTime();
    //get date start study
    $date_start = DOTB.util.DateUtils.parse($('#start_study').val(),cal_date_format);
    if($date_start==false){
        toastr.error('Invalid date');
        $('#start_study').val('');
    }else{
        $start = $date_start.getTime();
        if($start < $classStart || $start > $classEnd){
            toastr.error('Invalid date range. Please, choose another date!!')
            $('#start_study').val('');
        }
    }
}

//Validate start study date
function validateEnd(){
    $classStart   = DOTB.util.DateUtils.parse($('#class_start').val(),cal_date_format).getTime();
    $classEnd     = DOTB.util.DateUtils.parse($('#class_end').val(),cal_date_format).getTime();
    //get date start study
    $date_end = DOTB.util.DateUtils.parse($('#end_study').val(),cal_date_format);
    if($date_end==false){
        toastr.error('Invalid date');
        $('#end_study').val('');
    }else{
        $end = $date_end.getTime();
        if($end < $classStart || $end > $classEnd){
            toastr.error('Invalid date range. Please, choose another date!!')
        }
    }
}

function isInSchedule(checking_date){
    var checking_date = DOTB.util.DateUtils.parse(checking_date,cal_date_format);
    var count_err = 0;
    $('#classes option:selected').each(function(index, brand){
        obj = JSON.parse($(this).attr("json_ss"));
        if( checking_date != ''){
            flag = DOTB.util.DateUtils.formatDate(checking_date,false,"Y-m-d") in obj;
            if(flag)
                count_err++;
        }
    });
    if(count_err>0)
        return true;
    else{
        toastr.error('Date not in class schedule !');
        return false;
    }

}

//Add by Lap Nguyen - show Schedule when select Class
function generateClassSchedule(){
    var html = "";
    $("#classes option:selected").each(function(){
        html += "<b>"+$(this).attr("class_name") + "</b>: "+ $(this).attr("start_date");
        if($(this).attr("class_type") == 'Normal Class') html +=  " - "+ $(this).attr("end_date")
        html += $(this).attr("main_schedule");
    });

    $('#div_sclass_schedule').html(html);
}

function showClassSchedule(){
    if ($("#div_sclass_schedule").is(":visible")){
        $("#div_sclass_schedule").hide();
        $("#btn_show_hide_schedule").val(DOTB.language.get('J_Payment', 'LBL_SHOW_SCHEDULE'));
    }
    else {
        $("#div_sclass_schedule").show();
        $("#btn_show_hide_schedule").val(DOTB.language.get('J_Payment', 'LBL_HIDE_SCHEDULE'));
    }
}
function isEmpty(str) {
    return typeof str == 'string' && !str.trim() || typeof str == 'undefined' || str === null;
}


// check available discount
function checkAvailableDiscount(){
    //release all
    $('.dis_check').each(function(index, focus){
        var dis_check_id            = $(this).closest('tr').find(".dis_check").val();
        var disable_discount_list   = $(this).closest('tr').find(".disable_discount_list").val();
        var dis_name                = $(this).closest('tr').find(".dis_name").text();

        if(typeof disable_discount_list != 'undefined' && disable_discount_list != '' && disable_discount_list != '[]'){
            var disable_obj = JSON.parse(disable_discount_list);
            $.each(disable_obj, function(index, value){
                $('#row_'+value).removeClass("locked").addClass("unlocked").find("td").css("background","");
                $('#row_'+value).find('.dis_check').show();
                $('#row_'+value).attr("title",'');
            });
        }
    });

    //Check available
    $('.dis_check:checked').each(function(index, focus){
        var dis_check_id            = $(this).closest('tr').find(".dis_check").val();
        var disable_discount_list   = $(this).closest('tr').find(".disable_discount_list").val();
        var dis_name                = $(this).closest('tr').find(".dis_name").text();
        if($(this).is(':checked')){
            if(typeof disable_discount_list != 'undefined' && disable_discount_list != '' && disable_discount_list != '[]'){
                var disable_obj = JSON.parse(disable_discount_list);

                $.each(disable_obj, function(index, value){
                    $('#row_'+value).removeClass("unlocked").addClass("locked").find("td").css("background","bisque");
                    $('#row_'+value).find('.dis_check').prop("checked",false).hide();
                    $('#row_'+value).attr("title",'Do not apply with discount: '+dis_name);
                });

            }
        }
    });
}



function generateKOC(){
    //change koc
    var json_koc = $("#coursefee option:selected").attr('kind_of_course');
    if(json_koc != '' && typeof json_koc != 'undefined'){
        json_koc = JSON.parse(json_koc);
        $('#kind_of_course option').prop('disabled',true);

        $.each(json_koc, function( key, koc ){
            $('#kind_of_course option[value="'+koc+'"]').prop('disabled',false);
            if(record_id == '')
                $('#kind_of_course').val(koc);
        });
    }else
        $('#kind_of_course option').prop('disabled',false);
}
function collapseDiscount(id){
    $('a#collapseLink'+id).hide();
    $('a#expandLink'+id).show();
    $('tr.discount_group'+id).hide();
}
function expandDiscount(id){
    $('a#collapseLink'+id).show();
    $('a#expandLink'+id).hide();
    $('tr.discount_group'+id).show();
}
Calendar.setup ({
    inputField : "pay_dtl_invoice_date_1",
    daFormat : cal_date_format,
    button : "pay_dtl_invoice_date_1_trigger",
    singleClick : true,
    dateStr : "",
    step : 1,
    weekNumbers:false
});
Calendar.setup ({
    inputField : "pay_dtl_invoice_date_2",
    daFormat : cal_date_format,
    button : "pay_dtl_invoice_date_2_trigger",
    singleClick : true,
    dateStr : "",
    step : 1,
    weekNumbers:false
});
Calendar.setup ({
    inputField : "pay_dtl_invoice_date_3",
    daFormat : cal_date_format,
    button : "pay_dtl_invoice_date_3_trigger",
    singleClick : true,
    dateStr : "",
    step : 1,
    weekNumbers:false
});
