function myedit(id, act)
{
    var modalContainer = $('#my-modal');
    act = '/myshop/user/' + act;
    $.ajax({
        url: act,
        type: "POST",
        data: {'id': id, 'act': 'modal'},
        success: function (data) {
            $('.modal-body').html(data);
            modalContainer.modal({show: true});

            $("#user-form").on("submit", function (event) {
                event.preventDefault();
                var data = $(this).serialize();
                data.id = id;
                $.ajax({
                    url: act,
                    type: "POST",
                    data: data,
                    success: function (data) {
                        $('.modal-body').html(data);
                    }
                });
            });
        }
    });
}

function sale(item_id, unit_id, cost, iid)
{
    var url = '/myshop/item/sale';
    var type = $('#send_btn').html();
    if (type == 'Купить')
        type = 'inventory';
    else
        type = 'assorty';
    
    if (typeof iid == 'undefined')
        iid = null;
    
    $.ajax({
        url: url,
        type: "POST",
        data: {'item_id': item_id, 'unit_id': unit_id, 'type': type, 'cost': cost, 'iid': iid},
        success: function (data) {
            $("#my-modal").modal('hide');
            location.reload();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            $('.modal-body').html('Недостаточно денег');
        }
    });
}


function myclick(id, edit, btn_text, unit_id, iid)
{
    if (typeof edit == 'undefined')
        edit = '0';
    if (typeof btn_text == 'undefined')
        btn_text = null;
    if (typeof unit_id == 'undefined')
        unit_id = null;
    if (typeof iid == 'undefined')
        iid = null;

    var url = '/myshop/item/view?id=' + id;
    var clickedbtn = $(this);
    //var UserID = clickedbtn.data("userid");

    var modalContainer = $('#my-modal');

    modalContainer.modal({show: true});

    $.ajax({
        url: url,
        type: "POST",
        data: {'id': id, 'act': 'modal', 'edit': edit, 'btn_text': btn_text, 'unit_id': unit_id, 'iid': iid},
        success: function (data) {
            $('.modal-body').html(data);
            $('#send_btn').html(btn_text);

            modalContainer.modal({show: true});
        }
    });


}

$(document).ready(function () {
    $('.signup').click(function (event) { // нажатие на кнопку - выпадает модальное окно
        event.preventDefault();

        var url = '/myshop/default/signup';
        var clickedbtn = $(this);
        //var UserID = clickedbtn.data("userid");

        var modalContainer = $('#my-modal');
        modalContainer.modal({show: true});
        $.ajax({
            url: url,
            type: "GET",
            data: {/*'userid':UserID*/},
            success: function (data) {
                $('.modal-body').html(data);
                modalContainer.modal({show: true});
            }
        });
    });
    $(document).on("submit", '.signup-form', function (e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: "/myshop/default/submitsignup",
            type: "POST",
            data: form.serialize(),
            success: function (result) {
                var modalContainer = $('#my-modal');
                var modalBody = modalContainer.find('.modal-body');
                var insidemodalBody = modalContainer.find('.gb-user-form');

                if (result == 'true') {
                    insidemodalBody.html(result).hide(); // 
                    //$('#my-modal').modal('hide');
                    $('#success').html("<div class='alert alert-success'>");
                    $('#success > .alert-success').append("<strong>Спасибо! Ваше сообщение отправлено.</strong>");
                    $('#success > .alert-success').append('</div>');

                    setTimeout(function () { // скрываем modal через 4 секунды
                        $("#my-modal").modal('hide');
                    }, 4000);
                } else {
                    modalBody.html(result).hide().fadeIn();
                }
            }
        });
    });

});