$(document).ready(function () {
    displayByType();

    $("select[name='type']").on("change", function () {
        displayByType();
    });
});

function displayByType() {
    var checkbox = $("#toggle_textonly");
    if ($("select[name='type']").val() === "sms") {
        if (checkbox.prop('checked') == false) {
            checkbox.trigger('click');
            checkbox.addClass('hidden');
        }
        $(".tr_attachments").hide();
        $("#upload_form").hide();
    } else {
        $(".tr_attachments").show();
        $("#upload_form").show();
        checkbox.removeClass('hidden');
    }
}