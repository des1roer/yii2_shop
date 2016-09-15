<?php
$connection = Yii::$app->getDb();
$command = $connection->createCommand("select item.name, item.id from item, assorty, shop"
        . " where shop_id = shop.id and item_id = item.id and shop.id = 1 ");

$result = $command->queryAll();

foreach ($result as $key => $value) {
    ?>
    <div onclick="myfunc(<?= $value['id'] ?>)"><?= $value['name'] ?></div>
    <?php
}
?>
<!--http://loco.ru/materials/502-yii2-modalnoe-okno-s-formoi-obratnoi-svyazi-po-ajax-->
<script type="text/javascript">
    function myfunc(id)
    {
        $('#myModal').removeData('bs.modal');
        $('#myModal').modal({remote: '/myshop/item.php'});
        $('#myModal').modal('show');
//        $.ajax({
//            url: "/myshop/item.php",
//            success: function (data) {
//                $("#myModal").html(data);
//            }
//        });
        //alert(id);
        // $('#myModal').modal('show');
    }
</script>
<div id ="myModal"></div>
