$(function () {
    function find_class(el) {

        var items = [];

        $.each(el.attr('class').split(/\s+/), function (index, item) {
            items.push(item);
        });

        return items;
    }

    $('div.draggable').draggable({
        snap: ".invent",
        snapMode: "both",
        //snapTolerance: 50,
        tolerance: "fit",
        revert: true
    });

    $('.invent').droppable({
        activeClass: "active",
        hoverClass: "hover",
        drop: function (event, ui) {
            var act = '/myshop/doll/invent';
            var id = ui.helper.attr('id');
            var arr = id.split('_');
            var one = find_class(ui.helper);
            var two = find_class($(event.target));

            var idx = 0;
            for (var i = 0; i < two.length; i++)
            {
                idx = one.indexOf(two[i]);
                if (idx >= 0) //совпадают классы
                {
                    var data =
                            {
                                type: $(event.target).attr('id'),
                                item_id: arr[0],
                                user_id: arr[1]
                            };
                    $.ajax({
                        url: act,
                        type: "POST",
                        data: data,
                        success: function (data) {
                            //console.log(data);
                            //$('#doll-index').html(data);
                        }
                    });
                }
            }






        },
        out: function (event, ui) {
            //ui.helper.css("border", "")
        }
    });
});