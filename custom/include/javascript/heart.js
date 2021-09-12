$(function () {
    $(".heart").live("click", function (e) {
        if (e.target !== this) return;
        if ($(this).hasClass("is-active")) return;
        $(this).toggleClass("active");
        $(this).find('.fa-favorite').click();
    });

    $(".is-active").live("click",function(e){
        if (e.target !== this) return;
        $(this).removeClass("is-active");
        $(this).find('.fa-favorite').click();
    })
});