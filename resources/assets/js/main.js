/**
 * Created by index on 24.06.2017.
 */
//$(document).ready(function () {
//    //E-mail Ajax Send
//    $("form").submit(function () { //Change
//        var th = $(this);
//        $.ajax({
//            type: "POST",
//            url: "mail.php", //Change
//            data: th.serialize()
//        }).done(function () {
//            alert("Thank you!");
//            setTimeout(function () {
//                // Done Functions
//                th.trigger("reset");
//            }, 1000);
//        });
//        return false;
//    });
//});

//$(document).ready(function () {
//    //E-mail Ajax Send
//    $(".filter").submit(function () {
//        event.preventDefault();
//        var th = $(this);
//        $.ajax({
//            type: "POST",
//            data: th.find('input').serializeArray()
//        }).done(function (data) {
//                window.location = data;
//        });
//        return false;
//    });
//});

$(window).load(function () {
    //slider
    $('.flexslider').flexslider({
        animation: "fade",
        directionNav: false,
        keyboard: false
    });
});

var mobile = device.mobile();
if(mobile == false) {
    //parallax
    $(window).stellar();
    //animate
    $(document).ready(function() {
        $('.description-Denvis, .photo-2, .photo-3').addClass("hidden").viewportChecker({
            classToAdd: 'visible animated fadeInUp'
        });
    });

    $(document).ready(function() {
        $('#temp-block-3 .block-1, #temp-block-3 .block-2, #temp-block-3 .block-3, #temp-block-3 .block-4, #temp-block-3 .block-5, #temp-block-6 .block-3, #temp-block-6 .block-4').addClass("hidden").viewportChecker({
            classToAdd: 'visible animated fadeInRight'
        });
    });

    $(document).ready(function() {
        $('#temp-block-6 .block-1, #temp-block-6 .block-2').addClass("hidden").viewportChecker({
            classToAdd: 'visible animated fadeInLeft'
        });
    });
} else{
}