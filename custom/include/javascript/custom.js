$('.closeSubdetail').live('click', function () {
    if ($('.sidebar-content').prev().find('.sidebar-toggle').length == 0) {
        $('.sidebar-content').prev().removeClass('span8').addClass('span12');
        $('.sidebar-content').addClass('side-collapsed');
        $('.uxs-scroll-bar').addClass('dash-collapsed');
    }
});

