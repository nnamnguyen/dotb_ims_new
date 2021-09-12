function runNow(){
    ajaxStatus.showStatus(DOTB.language.get('Schedulers','LBL_PLEASE_WAIT'));
    $.ajax({
        url: "index.php?module=Schedulers&action=handleajax&dotb_body_only=true",
        type: "POST",
        async: true,
        data:  {
            type        : "ajaxRunNow",
            record      : $("input[name='record']").val()
        },
        dataType: "json",
        success: function(res){
            if(res.success == "1"){
                toastr.success(DOTB.language.get('Schedulers','LBL_RUN_SUCCESSFULL'));
            }
            else{
                toastr.error(DOTB.language.get('Schedulers',res.error_label));
            }
            ajaxStatus.hideStatus();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            toastr.error(DOTB.language.get('Schedulers','LBL_AJAX_ERROR'));
            ajaxStatus.hideStatus();
        }
    });
}