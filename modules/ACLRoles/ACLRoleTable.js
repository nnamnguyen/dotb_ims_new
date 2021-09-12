$(document).ready(function () {
    // $("table #ACLRole").freezeHeader();
    // $("#ACLEditView_Access_Header_category").click(function () {
    //     alert('hello');
    // })
    var thead_width = [];
    $('#ACLRole thead tr td').each(function () {
        thead_width.push($(this).width())
    })
    debugger;
    var pos = $('#ACLRole_table_head').offset().top
    $(window).scroll(function(){
        var sticky = $('#ACLRole_table_head'),
            scroll = $(window).scrollTop();

        if (scroll >= pos) {
            sticky.addClass('fixed');
            $('#ACLRole thead tr td').each(function (index) {
                thead_width.push($(this).width(thead_width[index]))
            })
        }
        else sticky.removeClass('fixed');
    });
})
function changeALl(pos) {
    app.alert.show('message-id', {
        level: 'confirmation',
        messages: app.lang.get('LBL_CHANGE_ALL_ROLE', 'ACLRoles'),
        autoClose: false,
        onConfirm: function(){
            var class_name = $(pos).attr('class');
            $('select.'+class_name).each(function () {
                $(this).val(pos.value);
                $(this).trigger('blur');
            });
        },
        onCancel: function(){
        }
    });
}
