/*
| Login button animation
 */

$(function () {
        $("#login").on('click', function () {
            $(this).addClass("disabled");
            setTimeout(function () {
                $("#login").removeClass("disabled");
            }, 3000);
        });

        $("#logout").on('click', function () {
            $(this).addClass("disabled");
            $(this).html('<b class="fa fa-refresh fa-spin"></b>');
        });

        $('.progress-bar').each(function () {
            var min = $(this).attr('aria-valuemin');
            var max = $(this).attr('aria-valuemax');
            var now = $(this).attr('aria-valuenow');
            var siz = (now - min) * 100 / (max - min);
            $(this).css('width', siz + '%');
        });

        $("#cartGo").on('click', function () {
            $("#cartGo").addClass("disabled");
            $("#cartGo").html('<b class="fa fa-refresh fa-spin"></b>');
            $("#cartSubmit").submit();
        });

        $("#gateway1").on('click', function () {
            $("#smsInputs").hide();
            $('#method').attr('action', "/cart/checkout/paypal");
        });

        $("#gateway2").on('click', function () {
            $("#smsInputs").show();
            $('#method').attr('action', "/cart/checkout/sms");
        });

        $('#isGift').on('click',function () {
            $(".gift").toggle(this.checked);
        });


    }
);

$(document).on('submit', '#coupon_add', function (e) {
    e.preventDefault();

    $("#couponSave").addClass('disabled');
    setTimeout(function () {
        $("#couponSave").removeClass('disabled');
    }, 2000);

    // Check coupon
    var couponform = $("#coupon_add");
    var data = couponform.serializeArray();

    $.ajax({

        url: '/cart/coupon/check',
        dataType: 'JSON',
        type: 'POST',
        data: data,

        success: function (data) {
            $("#couponheader").html(data.budget + "<br/>" + data.msg);
            $(".coupons").remove();
            $("#error").hide();
            $('#method').attr('action', "/cart/checkout/sms");
            $("#payment-content").remove();

        },

        error: function (data) {

            $("#error").html(data.responseJSON.toString());
            $("#error").show();
            setTimeout(function () {
                $("#error").hide();
            }, 6000)

        }

    });
});

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip({'placement': 'top'});
});
