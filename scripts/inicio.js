$(document).ready(function () {
    $(".btn-group").hover(function () {
        $(this).find('.dropdown-menu').show();
        $("body").css("overflow-y", "hidden");
    }, function () {
        $(this).find('.dropdown-menu').hide();
        $("body").css("overflow-y", "auto");
    });
});