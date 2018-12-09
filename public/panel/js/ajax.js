$(document).ready(function () {
    var CSRF = $('meta[name="csrf-token"]').attr('content');
    var SLUG = $('meta[name="site-slug"]').attr('content');
    var tTimer;
    var dTypingInterval = 1000;

    $('#title-home').keyup(function () {
        clearTimeout(tTimer);
        if ($('#title').val) {
            tTimer = setTimeout(function () {
                $.ajax({
                    url: '/manage/site/' + SLUG + '/ajax/update/title',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        title: $("#title-home").val(),
                        _token: CSRF,
                    },

                    success: function (data) {
                        $("#loader-title").show().delay(1000).queue(function (next) {
                            $(this).hide();
                            $(".error-title").hide();
                            next();
                        });
                    },

                    error: function (data) {
                        $(".error-title").show();
                        $("#errorDesc").append(data.responseJSON);
                    },

                });
            }, dTypingInterval);
        }
    });

    $('#donation_text,#donation_goal').keyup(function () {
        clearTimeout(tTimer);
        if ($('#donation_text').val) {
            tTimer = setTimeout(function () {
                $.ajax({
                    url: '/manage/site/' + SLUG + '/ajax/update/design/static_content',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        donation_text: $("#donation_text").val(),
                        donation_amount: $("#donation_goal").val(),
                        for: 'donations',
                        _token: CSRF,
                    },

                    success: function (data) {
                        swal("Готово!", "Съдържанието беше обновено", "success")
                    },

                    error: function (data) {
                        swal({
                            title: "Проблем!",
                            text: "Нещо не е наред! Опитайте по-късно!",
                            dangerMode: true,
                            icon: "warning",
                            button: "Добре!",
                        });
                    },

                });
            }, dTypingInterval);
        }
    });

    $('#show_log_amount').keyup(function () {
        clearTimeout(tTimer);
        if ($('#donation_text').val) {
            tTimer = setTimeout(function () {
                $.ajax({
                    url: '/manage/site/' + SLUG + '/ajax/update/design/static_content',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        show_l_a: $("#show_log_amount").val(),
                        for: 'log_amount',
                        _token: CSRF,
                    },

                    success: function (data) {
                        swal("Готово!", "Съдържанието беше обновено", "success")
                    },

                    error: function (data) {
                        swal({
                            title: "Проблем!",
                            text: "Нещо не е наред! Опитайте по-късно!",
                            dangerMode: true,
                            icon: "warning",
                            button: "Добре!",
                        });
                    },

                });
            }, dTypingInterval);
        }
    });

    $("#is-sub").change(function() {
       var id = $(this).find("option:selected").attr('value');

       if(id == "true") {

       }

    });

    $('#logo').keyup(function () {
        clearTimeout(tTimer);
        if ($('#logo').val) {
            tTimer = setTimeout(function () {
                $.ajax({
                    url: '/manage/site/' + SLUG + '/ajax/update/design/static_content',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        logo: $("#logo").val(),
                        for: 'logo',
                        _token: CSRF,
                    },

                    success: function (data) {
                        swal("Готово!", "Съдържанието беше обновено", "success")
                        $("#logo-img").attr('src', data.img);
                    },

                    error: function (data) {
                        swal({
                            title: "Проблем!",
                            text: "Нещо не е наред! Опитайте по-късно!",
                            dangerMode: true,
                            icon: "warning",
                            button: "Добре!",
                        });
                    },

                });
            }, dTypingInterval);
        }
    });

    $('#keywords-home').keyup(function () {
        clearTimeout(tTimer);
        if ($('#keywords-home').val) {
            tTimer = setTimeout(function () {
                $.ajax({
                    url: '/manage/site/' + SLUG + '/ajax/update/keywords',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        keywords: $("#keywords-home").val(),
                        _token: CSRF,
                    },

                    success: function (data) {
                        $("#loader-keyword").show().delay(1000).queue(function (next) {
                            $(this).hide();
                            $(".error-keywords").hide();
                            next();
                        });
                    },

                    error: function (data) {
                        $(".error-keywords").show();
                        $("#errorDesc-keywords").append(data.responseJSON);
                    },

                });
            }, dTypingInterval);
        }
    });

    $("#move-sidebar").sortable({
        update: function (e, u) {
            var data = $(this).sortable('serialize');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': CSRF,
                }
            });
            $.ajax({
                url: '/manage/site/' + SLUG + '/design/sidebars/update/position',
                type: 'POST',
                data: data,
                dataType: 'JSON',
            });
        }

    });

    $("#design-form").change(function () {
        swal({
            title: "Сигурен ли си?",
            text: "След като натиснете \"OK\", дизайна ще бъде сменен!",
            dangerMode: false,
            icon: "warning",
            buttons: ["Отказ", true],
        }).then((change) => {
            if (change) {
                $.ajax({
                    url: '/manage/site/' + SLUG + '/design/change',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        _token: CSRF,
                        design: $("#design-form").val(),
                    },

                    success: function (data) {
                        swal("Готово!", "Дизайна е сменен успешно!", "success");
                        $("#preview-design").attr('src', data.url);
                    },

                    error: function (data) {
                        swal({
                            title: "Проблем!",
                            text: "Нещо не е наред! Опитайте по-късно!",
                            dangerMode: true,
                            icon: "warning",
                            button: "Добре!",
                        });
                    }
                });
            }
        });
    });

    $('#server_s').keyup(function () {
        clearTimeout(tTimer);
        if ($('#server_s').val) {
            tTimer = setTimeout(function () {
                $.ajax({
                    url: '/manage/site/' + SLUG + '/ajax/update/status',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        sstatus: $("#server_s").val(),
                        _token: CSRF,
                    },

                    success: function (data) {
                        swal('Обновено', 'Сървър статуса беше обновен!', 'success')
                    },

                    error: function (data) {
                        console.log(data.responseJSON);
                    },

                });
            }, dTypingInterval);
        }
    });

    // Ping api
    pinger();
    var interval = setInterval(pinger, 10000);

    function pinger() {
        var ping = new Ping();
        ping.ping("http://google.com", function (err, data) {
            if (err) {
                console.log('problem with pinging to google.com from the api');
            }
            $("#ping").text(data);
        });
    }

    if (window.location.pathname == "/manage/site/" + SLUG + "/coupons") {

        // Autocomplete names
        $.ajax({
            url: '/manage/site/' + SLUG + '/users/json',
            dataType: 'json',
            method: 'GET',

            success: function (data) {
                $("#coupon-to-user").autocomplete({
                    source: data,
                    minlength: 1,
                    autoFocus: true,
                    select: function (e, ui) {
                        $('#coupon-to-user').val(ui.item.value);
                    }
                });
            }
        });

        $("#coupon-datatable").DataTable({
            "language": {
                "lengthMenu": "Покажи _MENU_ записа",
                "zeroRecords": "Няма данни в тази таблица",
                "info": "_PAGE_ от _PAGES_",
                "infoEmpty": "Няма данни в тази страница",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Търси:"
            }
        });

        $("#coupon-datatable").Tabledit({
            url: '/manage/site/' + SLUG + '/coupons/update/data',
            hideIdentifier: true,
            restoreButton: false,
            buttons: {
                edit: {
                    class: 'btn btn-xs btn-info',
                    html: '<b class="fa fa-pencil"></b>',
                    action: 'edit',
                },
                save: {
                    class: 'btn btn-xs btn-info',
                    html: '<b class="fa fa-save"></b>',
                    action: 'save',
                },
                delete: {
                    class: 'btn btn-xs btn-danger',
                    html: '<b class="fa fa-trash-o"></b> ',
                    action: 'delete'
                },
                confirm: {
                    class: 'btn btn-xs btn-default',
                    html: 'Цъкни още веднъж!',
                }
            },
            columns: {
                identifier: [0, 'id'],
                editable: [[1, 'code'], [2, 'user'], [3, 'budget']]
            },
            onAjax: function (action, serialize) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                    }
                });
            },
        });
    }


    if (window.location.pathname == "/manage/site/" + SLUG + "/sms") {
        $('#sms-edit').Tabledit({
            url: '/manage/site/' + SLUG + '/sms/update/data',
            hideIdentifier: true,
            restoreButton: false,
            buttons: {
                edit: {
                    class: 'btn btn-xs btn-info',
                    html: '<b class="fa fa-pencil"></b>',
                    action: 'edit',
                },
                save: {
                    class: 'btn btn-xs btn-info',
                    html: '<b class="fa fa-save"></b>',
                    action: 'save',
                },
                delete: {
                    class: 'btn btn-xs btn-danger',
                    html: '<b class="fa fa-trash-o"></b> ',
                    action: 'delete'
                },
                confirm: {
                    class: 'btn btn-xs btn-default',
                    html: 'Цъкни още веднъж!',
                }
            },
            columns: {
                identifier: [0, 'id'],
                editable: [[1, 'text'], [2, 'number'], [3, 'servID'], [4, 'userID']]
            },
            onAjax: function (action, serialize) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                    }
                });
            },
        });
        $("#sms-edit").DataTable({
            "language": {
                "lengthMenu": "Покажи _MENU_ записа",
                "zeroRecords": "Няма данни в тази таблица",
                "info": "_PAGE_ от _PAGES_",
                "infoEmpty": "Няма данни в тази страница",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Търси:"
            }
        });
    }

    $("select[name=method]").change(function () {
        $.ajax({
            url: '/manage/site/' + SLUG + '/sms',
            type: 'POST',
            dataType: 'JSON',
            data: {
                _token: CSRF,
                method: $("select[name=method]").val(),
            },

            success: function (data) {
                swal("Готово!", "Метода е сменен!", "success");
                window.location.reload();
            },

            error: function (data) {
                var msg = data.responseJSON;
                swal({
                    title: "Проблем!",
                    text: "Нещо не е наред! Опитайте по-късно!",
                    dangerMode: true,
                    icon: "warning",
                    button: "Добре!",
                });
            }
        });
    });
});

function deleteSidebar(id) {
    var CSRF = $('meta[name="csrf-token"]').attr('content');
    var SLUG = $('meta[name="site-slug"]').attr('content');
    swal({
        title: "Сигурен ли си?",
        text: "След като натиснете \"OK\" менюто ще бъде изтрито завинаги!",
        icon: "warning",
        buttons: ["Отказ", true],
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {

            $.ajax({

                url: '/manage/site/' + SLUG + '/design/sidebars/delete/' + id,
                dataType: 'JSON',
                type: 'DELETE',
                data: {
                    _token: CSRF,
                },

                success: function (data) {
                    swal("Изтрито!", "Менюто беше изтрито!", "success");
                    $("#id-" + id).remove();
                },

                error: function (data) {
                    swal({
                        title: "Проблем с изтриването на менюто!",
                        text: "Това меню е статично и не може да бъде изтрито!",
                        dangerMode: true,
                        icon: "warning",
                        button: "Добре!",
                    });
                },
            });
        }
    });

}

function changeTitle(id) {
    var CSRF = $('meta[name="csrf-token"]').attr('content');
    var SLUG = $('meta[name="site-slug"]').attr('content');
    swal("Въведи новото заглавие:", {
        content: {
            element: "input",
            attributes: {
                placeholder: "Въведи новото име на менюто",
                type: "text",
                id: "new_title",
                minlenght: "4",
                value: $.trim($("#s-name-" + id).text()),
            }
        },
        buttons: ["Отказ", true],
    }).then((change) => {
        if ($.trim($("#new_title").val()).length > 3) {
            if ($.trim($("#new_title").val()) == $.trim($("#s-name-" + id).text())) {
                return false;
            }

            $.ajax({
                url: '/manage/site/' + SLUG + '/design/sidebars/update/' + id + '/title',
                dataType: 'JSON',
                type: 'POST',
                data: {
                    _token: CSRF,
                    title: $.trim($("#new_title").val()),
                },

                success: function (data) {

                    $("#s-name-" + id).text($.trim($("#new_title").val()));
                    swal("Променено!", "Заглавието на менюто беше променено!", "success");

                },

                error: function (data) {

                    swal({
                        title: "Проблем!",
                        text: "Моля бъдете сигурни че заглавието е над 4 символа!",
                        dangerMode: true,
                        icon: "warning",
                        button: "Ок.. Ще опитам пак!",
                    });

                }

            });

        } else {

            swal({
                title: "Проблем!",
                text: "Моля бъдете сигурни че заглавието е над 4 символа!",
                dangerMode: true,
                icon: "warning",
                button: "Ок.. Ще опитам пак!",
            });

        }
    });
}

function hideSidebar(id) {
    var CSRF = $('meta[name="csrf-token"]').attr('content');
    var SLUG = $('meta[name="site-slug"]').attr('content');
    $.ajax({
        url: '/manage/site/' + SLUG + '/design/sidebars/update/' + id + '/hide',
        type: 'POST',
        dataType: 'JSON',
        data: {
            _token: CSRF,
        },

        success: function (data) {
            if (data == 1) {
                $("#hideicon-sidebar-" + id).removeClass('text-danger');
            } else if (data == 0) {
                $("#hideicon-sidebar-" + id).addClass('text-danger');
            }
        }

    });
}

function changeContent(id) {
    var CSRF = $('meta[name="csrf-token"]').attr('content');
    var SLUG = $('meta[name="site-slug"]').attr('content');

    $.ajax({
        url: '/manage/site/' + SLUG + '/design/sidebars/update/' + id + '/content',
        type: 'POST',
        dataType: 'JSON',

        data: {
            _token: CSRF,
            content: CKEDITOR.instances['new_content_' + id].getData(),
        },

        success: function (data) {
            swal("Готово!", "Менюто беше обновено!", "success");
        },
        error: function (data) {
            swal({
                title: "Проблем!",
                text: "Нещо не е наред! Опитайте по-късно!",
                dangerMode: true,
                icon: "warning",
                button: "Добре!",
            });

        }
    });

}

function deleteNotification(id) {

    var CSRF = $('meta[name="csrf-token"]').attr('content');
    var SLUG = $('meta[name="site-slug"]').attr('content');
    swal({
        title: "Сигурен ли си?",
        text: "След като натиснете \"OK\" нотификацията ще бъде изтрита завинаги!",
        icon: "warning",
        buttons: ["Отказ", true],
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {

            $.ajax({

                url: '/manage/site/' + SLUG + '/design/category/notifications/' + id + '/delete',
                dataType: 'JSON',
                type: 'DELETE',
                data: {
                    _token: CSRF,
                },

                success: function (data) {
                    swal("Изтрито!", "Менюто беше изтрито!", "success");
                    $("#notification-" + id).remove();
                },

                error: function (data) {
                    swal({
                        title: "Проблем с изтриването на нотификацията!",
                        text: "Моля опитайте по-късно!",
                        dangerMode: true,
                        icon: "warning",
                        button: "Добре!",
                    });
                },
            });
        }
    });

}

function changeTitleNotification(id) {

    var CSRF = $('meta[name="csrf-token"]').attr('content');
    var SLUG = $('meta[name="site-slug"]').attr('content');
    swal("Въведи новото заглавие:", {
        content: {
            element: "input",
            attributes: {
                placeholder: "Въведи новото име на менюто",
                type: "text",
                id: "new_title",
                minlenght: "4",
                value: $.trim($("#notification-title-" + id).text()),
            }
        },
        buttons: ["Отказ", true],
    }).then((value) => {
        if ($.trim($("#new_title").val()) == $.trim($("#notification-title-" + id).text())) {
            return false;
        }
        if ($.trim($("#new_title").val()).length > 3) {

            $.ajax({
                url: '/manage/site/' + SLUG + '/design/category/notifications/' + id + '/editTitle',
                dataType: 'JSON',
                type: 'POST',
                data: {
                    _token: CSRF,
                    title: $.trim($("#new_title").val()),
                },

                success: function (data) {

                    $("#notification-title-" + id).text($.trim($("#new_title").val()));
                    swal("Променено!", "Заглавието на нотификацията беше променено!", "success");

                },

                error: function (data) {

                    swal({
                        title: "Проблем!",
                        text: "Моля бъдете сигурни че заглавието е над 4 символа!",
                        dangerMode: true,
                        icon: "warning",
                        button: "Ок.. Ще опитам пак!",
                    });

                }

            });

        } else {
            console.log($.trim($("#new_title").val()));
            swal({
                title: "Проблем!",
                text: "Моля бъдете сигурни че заглавието е над 4 символа!",
                dangerMode: true,
                icon: "warning",
                button: "Ок.. Ще опитам пак!",
            });

        }
    });

}

function deleteServer(id) {

    var CSRF = $('meta[name="csrf-token"]').attr('content');
    var SLUG = $('meta[name="site-slug"]').attr('content');
    swal({
        title: "Сигурен ли си?",
        text: "След като натиснете \"OK\" сървъра ще бъде изтрит завинаги!",
        icon: "warning",
        buttons: ["Отказ", true],
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {

            $.ajax({

                url: '/manage/site/' + SLUG + '/server/' + id + '/delete',
                dataType: 'JSON',
                type: 'DELETE',
                data: {
                    _token: CSRF,
                },

                success: function (data) {
                    swal("Изтрито!", "Сървъра беше изтрит!", "success");
                    $("#server-" + id).remove();
                    $("#counter").html(+$("#counter").text() + 1);
                },

                error: function (data) {
                    swal({
                        title: "Проблем с изтриването на нотификацията!",
                        text: "Моля опитайте по-късно!",
                        dangerMode: true,
                        icon: "warning",
                        button: "Добре!",
                    });
                },
            });
        }
    });

}

function editText(id) {
    var text = $("#sms-text-" + id);
    text.removeAttr("onclick");
    text.html("<input type='text' name='new-sms-text' value='" + text.text() + "'>");
    $("#new-sms-text").focus();

    $("#new-sms-text").on('change', function () {
        text.html($("#new-sms-text").val());
        $("#new-sms-text").remove();
        text.attr("onclick", "editText(" + id + ")");
    });
}


$(document).on('submit', '#addSidebar', function (e) {
    var SLUG = $('meta[name="site-slug"]').attr('content');
    e.preventDefault();

    // Check coupon
    var form = $("#addSidebar");
    var data = form.serializeArray();

    $.ajax({

        url: '/manage/site/' + SLUG + '/design/sidebars/create',
        dataType: 'JSON',
        type: 'POST',
        data: data,

        success: function (data) {
            $("errorDiv").hide();
            $("addSidebar").modal('hide');
            window.location.reload();
        },

        error: function (data) {
            $("addSidebar").modal('hide');
            $("errorDiv").show();
            $("errorDesc").html(data.responseJSON);

        }

    });
});

$(document).on('submit', '#notification_create', function (e) {
    var SLUG = $('meta[name="site-slug"]').attr('content');
    e.preventDefault();

    var form = $("#notification_create");
    var data = form.serializeArray();

    $.ajax({
        urL: '/manage/site/' + SLUG + '/design/category/notifications',
        type: 'POST',
        dataType: 'JSON',
        data: data,

        success: function (data) {
            swal('Готово', 'Вашата нотификация е създадена!', 'success');
            window.location.reload();
        },

        error: function (data) {
            swal({
                title: "Проблем!",
                text: "Нещо не е наред! Опитайте по-късно! (Бъдете сигурни, че заглавието има над 4 символа и е избрана категория)",
                dangerMode: true,
                icon: "warning",
                button: "Добре!",
            });
        }
    });


});

$(document).on('submit', '#update_notification', function (e) {
    var SLUG = $('meta[name="site-slug"]').attr('content');
    e.preventDefault();

    var form = $("#update_notification");
    var data = form.serializeArray();

    $.ajax({
        url: '/manage/site/' + SLUG + '/design/category/notifications/edit',
        type: 'POST',
        data: data,
        dataType: 'JSON',

        success: function (data) {
            $('#editNotification' + $("#notification_id").val()).modal('hide');
            swal('Успешно!', 'Нотификацията е обновена', 'success');
        },

        error: function (data) {
            swal({
                title: "Проблем!",
                text: "Нещо не е наред! Опитайте по-късно! (Бъдете сигурни, че е избрана категория)",
                dangerMode: true,
                icon: "warning",
                button: "Добре!",
            });
        }

    });
});

$(document).on('submit', '#updateHomepage', function (e) {
    var SLUG = $('meta[name="site-slug"]').attr('content');
    e.preventDefault();

    var form = $("#updateHomepage");
    var data = form.serializeArray();

    $.ajax({
        url: '/manage/site/' + SLUG + '/design/homepage',
        type: 'POST',
        dataType: 'JSON',
        data: data,

        success: function (data) {
            swal('Готово', 'Страницата е обновена успешно', 'success')
        },

        error: function (data) {
            swal({
                title: "Проблем!",
                text: "Нещо не е наред! Опитайте по-късно! (Бъдете сигурни, че заглавието е над 4 символа)",
                dangerMode: true,
                icon: "warning",
                button: "Добре!",
            });
        }
    });

});

$(document).on('submit', '#addServer', function (e) {
    var SLUG = $('meta[name="site-slug"]').attr('content');
    e.preventDefault();

    var form = $("#addServer");
    var data = form.serializeArray();

    $.ajax({
        url: '/manage/site/' + SLUG + '/server/add',
        type: 'POST',
        dataType: 'JSON',
        data: data,

        success: function (data) {
            swal('Готово', 'Сървъра е добавен успешно!', 'success');
            window.location.reload();
        },

        error: function (data) {
            if (data.responseJSON.max) {
                swal({
                    title: "Проблем!",
                    text: "Вие достигнахте лимита на плана си! Ъпгрейднете до по-горен план: www.mymcshop.com",
                    dangerMode: true,
                    icon: "warning",
                    button: "Добре!",
                });
            } else {
                swal({
                    title: "Проблем!",
                    text: "Нещо не е наред! Опитайте по-късно! (Бъдете сигурни, че името на сървъра е над 2 символа)",
                    dangerMode: true,
                    icon: "warning",
                    button: "Добре!",
                });
            }
        }
    });

});

$(document).on('submit', '#add_sms', function (e) {
    var SLUG = $('meta[name="site-slug"]').attr('content');
    e.preventDefault();

    var form = $("#add_sms");
    var data = form.serializeArray();

    $.ajax({
        url: '/manage/site/' + SLUG + '/sms/add',
        type: 'POST',
        data: data,
        dataType: 'JSON',

        success: function (data) {
            swal('Готово!', "СМС-а беше добавен", "success");
            window.location.reload();
        },

        error: function (data) {
            swal({
                title: "Проблем!",
                text: "Нещо не е наред! Опитайте по-късно!",
                dangerMode: true,
                icon: "warning",
                button: "Добре!",
            });
        }

    });
});

$(document).on('submit', '#create-coupon', function (e) {

    var SLUG = $('meta[name="site-slug"]').attr('content');
    e.preventDefault();

    var form = $("#create-coupon");
    var data = form.serializeArray();

    $.ajax({
        url: '/manage/site/' + SLUG + '/coupons/create',
        type: 'POST',
        data: data,
        dataType: 'JSON',

        success: function (data) {
            swal('Готово!', "Купона е добавен", "success");
            window.location.reload();
        },

        error: function (data) {
            swal({
                title: "Проблем!",
                text: "Нещо не е наред! Опитайте по-късно!",
                dangerMode: true,
                icon: "warning",
                button: "Добре!",
            });
        }


    });
});

$(document).on('submit', '#paypal-update', function (e) {

    var SLUG = $('meta[name="site-slug"]').attr('content');
    e.preventDefault();

    var form = $("#paypal-update");
    var data = form.serializeArray();

    $.ajax({
        url: '/manage/site/' + SLUG + '/paypal/update',
        type: 'POST',
        data: data,
        dataType: 'JSON',

        success: function (data) {
            swal('Готово!', "Вашата информация е обновена", "success");
        },

        error: function (data) {
            swal({
                title: "Проблем!",
                text: "Нещо не е наред! Опитайте по-късно!",
                dangerMode: true,
                icon: "warning",
                button: "Добре!",
            });
        }
        
    });

});
