var record_id       = $('input[name=record]').val();
var duplicateId       = $('input[name=duplicateId]').val();
$(document).ready(function(){
    $('.table-striped').selectableList();
    //add gift
    $('#tblLevelConfig').multifield({
        section :   '.row_tpl', // First element is template
        addTo   :   '#tbodylLevelConfig', // Append new section to position
        btnAdd  :   '#btnAddrow', // Button Add id
        btnRemove:  '.btnRemove', // Buton remove id,
    });
    // add partnership
    $('#tblpa').multifield({
        section :   '.row', // First element is template
        addTo   :   '#tbodypa', // Append new section to position
        btnAdd  :   '#btnAdd', // Button Add id
        btnRemove:  '.btn_Remove', // Buton remove id,
    });
    //add Discount by Hour
    $('#tblHourConfig').multifield({
        section :   '.row', // First element is template
        addTo   :   '#tbodyHourConfig', // Append new section to position
        btnAdd  :   '#btnAddrowHour', // Button Add id
        btnRemove:  '.btnRemoveHour', // Buton remove id,
    });
    //add Discount by Block
    $('#tblBlockConfig').multifield({
        section :   '.row', // First element is template
        addTo   :   '#tbodyBlockConfig', // Append new section to position
        btnAdd  :   '#btnAddrowRange', // Button Add id
        btnRemove:  '.btnRemoveRange', // Buton remove id,
    });

    $('#type').live('change', function(){
        if($('#type').val()=='Gift'){
            $('#div_hour').css("display","none");
            $('#div_partnership').css("display","none");
            $('#div_rewards').css("display","none");
            $('#discount_percent, #discount_amount').prop('disabled',true);
            if(record_id == '' && duplicateId == '') $('#discount_percent, #discount_amount').val('');
        }
        if($('#type').val()=='Partnership'){
            $('#div_hour').css("display","none");
            $('#div_partnership').css("display","");
            $('#div_rewards').css("display","none");
            $('#discount_percent, #discount_amount').prop('disabled',true);
            if(record_id == '') $('#discount_percent, #discount_amount').val('');
        }
        if($('#type').val()=='Reward'){
            $('#div_hour').css("display","none");
            $('#div_partnership').css("display","none");
            $('#div_rewards').css("display","");
            $('#discount_percent, #discount_amount').prop('disabled',false);
            if(record_id == '' && duplicateId == '') $('#discount_percent, #discount_amount').val('');
        }
        if($('#type').val()=='Other'){
            $('#div_hour').css("display","none");
            $('#div_partnership').css("display","none");
            $('#div_rewards').css("display","none");
            $('#discount_percent, #discount_amount').prop('disabled',false);
            if(record_id == '' && duplicateId == '') $('#discount_percent, #discount_amount').val('');
        }
        if($('#type').val()=='Hour'){
            $('#div_hour').css("display","");
            $('#div_partnership').css("display","none");
            $('#div_rewards').css("display","none");
            $('#discount_percent, #discount_amount').prop('disabled',true);
            if(record_id == '' && duplicateId == '') $('#discount_percent, #discount_amount').val('');
        }

    });
    $('#type').trigger('change');

});
// check require khi chọn type mà không chọn giá trị đi kèm
check_form = function(formname) {
    if (typeof (siw) != 'undefined' && siw && typeof (siw.selectingSomething) != 'undefined' && siw.selectingSomething)
        return false;

    type= $('#type').val();
    book_name=$('#book_name').val();
    qty_book=$('#qty_book').val();
    if(type=='Gift' && book_name==""){
        $('.required').remove(); //xoa dong thong bao loi
        add_error_style(formname,'book_name','Missing required field',true);
        return false;
    }
    if(type=='Gift' && qty_book==""){
        $('.required').remove(); //xoa dong thong bao loi
        add_error_style(formname,'qty_book','Missing required field',true);
        return false;
    }
    if( validate_form(formname, '')) {
        document.forms[formname].submit();
    }
}


// Show popup search Partnership
function clickChoosePa(thisButton){
    current =  thisButton;
    open_popup('J_Partnership', 600, 400, "", true, false, {"call_back_function":"set_return_pa","form_name":"EditView","field_to_name_array":{"id":"pa_id","name":"pa_name"}}, "single", true);
};

//function set_return of open popup Partnership
function set_return_pa(popup_reply_data, filter) {
    var form_name = popup_reply_data.form_name;

    var name_to_value_array = popup_reply_data.name_to_value_array;
    for (var the_key in name_to_value_array) {
        var val = name_to_value_array[the_key].replace(/&amp;/gi, '&').replace(/&lt;/gi, '<').replace(/&gt;/gi, '>').replace(/&#039;/gi, '\'').replace(/&quot;/gi, '"');

        switch (the_key)
        {
            case 'pa_name':
                current.parent().find(".pa_name").val(val);
                break;
            case 'pa_id':
                current.parent().find(".pa_id").val(val);
                break;
        }
    }
}