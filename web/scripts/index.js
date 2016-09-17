function myclick(id, edit)
{
    if (typeof edit == 'undefined')
        edit = '0';
    
        var url = '/myshop/item/view?id='+id;
        var clickedbtn = $(this);
        //var UserID = clickedbtn.data("userid");

        var modalContainer = $('#my-modal');
        var modalBody = modalContainer.find('.modal-body');
        modalContainer.modal({show: true});
        $.ajax({
            url: url,
            type: "POST",
            data: {'id':id, 'act': 'modal', 'edit': edit},
            success: function (data) {
                $('.modal-body').html(data);
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
                console.log(result);
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