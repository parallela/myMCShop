//Needed variables:
var CSRF = $('meta[name="csrf-token"]').attr('content');


/*
| Cookies
 */
$(document).ready(function () {
    setTimeout(function () {
        $("#cookieConsent").fadeIn(200);
    }, 4000);
    $("#closeCookieConsent, .cookieConsentOK").click(function () {
        $("#cookieConsent").fadeOut(200);
    });
});

/*
| GDPR
 */

$(window).on('load', function () {
    $("#gdpr").modal('show');
});

function acceptGDPR() {
    $.ajax({
        url: '/gdpr',
        type: 'POST',
        dataType: 'JSON',
        data: {
            _token: CSRF,
            accepted: true,
        },
    });
}

/*
| Login/Register btns
*/
function signIn() {
    $("#signInBtn").addClass("disabled");
    $("#signInBtn").text("Saving...").delay(2000).queue(function (next) {
        $("#signInForm").submit();
        next();
    });
}

// handle links with @href started with '#' only
$(document).on('click', 'a[href^="/#"]', function (e) {
    // target element id
    var id = $(this).attr('href');

    // target element
    var $id = $(id);
    if ($id.length === 0) {
        return;
    }

    // prevent standard hash navigation (avoid blinking in IE)
    e.preventDefault();

    // top position relative to the document
    var pos = $id.offset().top;

    // animated top scrolling
    $('body, html').animate({scrollTop: pos});
});

/**
 * Scroll management
 */
$(document).ready(function () {

    var menu = $('.menu');
    var origOffsetY = menu.offset().top;

    function scroll() {
        if ($(window).scrollTop() >= origOffsetY) {
            menu.addClass('fixed-top');
        } else {
            menu.removeClass('sticky');
        }
    }

    $(document).scroll();

});

/*
| Payment button
 */
$(function () {
    setTimeout(function () {
        $("#payment").removeClass('disabled');
    }, 5000);

    $("#payment").on('click', function () {
        $("#payment").text('Connecting to PayPal... Please wait!');
        $("#payment").addClass('disabled');
        $("#paymentform").submit();
    });
});

/*
| Tooltip
 */
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})