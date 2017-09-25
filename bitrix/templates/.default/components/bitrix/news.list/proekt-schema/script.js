$(document).ready(function () {
    var browserClientWidth = document.body.clientWidth,
        mobileWidth = 678;

    if (browserClientWidth >= mobileWidth) {
        $('.awModlinkImg').fancybox({type: 'iframe', width: '70%', autoSize: true})
    } else {
        $('.awModlinkImg').click(function (e) {
            e.preventDefault();
        });
    }
});