function myedit(id,  act)
{
    var modalContainer = $('#my-modal');
    $.ajax({
        url: '/myshop/user/'+act,
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

function sale(item_id, unit_id, cost)
{
    var url = '/myshop/item/sale';
    var type = $('#send_btn').html();
    if (type == 'Купить')
        type = 'inventory';
    else
        type = 'assorty';

    $.ajax({
        url: url,
        type: "POST",
        data: {'item_id': item_id, 'unit_id': unit_id, 'type': type, 'cost': cost},
        success: function (data) {
            $("#my-modal").modal('hide');
            location.reload();
        }
    });
}
function myclick(id, edit, btn_text, unit_id)
{
    if (typeof edit == 'undefined')
        edit = '0';
    if (typeof btn_text == 'undefined')
        btn_text = null;
    if (typeof unit_id == 'undefined')
        unit_id = null;

    var url = '/myshop/item/view?id=' + id;
    var clickedbtn = $(this);
    //var UserID = clickedbtn.data("userid");

    var modalContainer = $('#my-modal');
    var modalBody = modalContainer.find('.modal-body');

    modalContainer.modal({show: true});
    $.ajax({
        url: url,
        type: "POST",
        data: {'id': id, 'act': 'modal', 'edit': edit, 'btn_text': btn_text, 'unit_id': unit_id},
        success: function (data) {
            $('.modal-body').html(data);
            $('#send_btn').html(btn_text);

            modalContainer.modal({show: true});
        }
    });

    $("#send_btn").click(function () {
        alert(id);
    });
}

$(document).ready(function () {
    $('.signup').click(function (event) { // нажатие на кнопку - выпадает модальное окно
        event.preventDefault();

        var url = '/myshop/default/signup';
        var clickedbtn = $(this);
        //var UserID = clickedbtn.data("userid");

        var modalContainer = $('#my-modal');
        var modalBody = modalContainer.find('.modal-body');
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