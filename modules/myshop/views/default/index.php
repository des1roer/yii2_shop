<?php
$this->registerJsFile(
        'scripts/index.js', ['depends' => 'app\assets\AppAsset']
);


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
    
<p><a class="btn btn-success signup" data-userid="22" >Записаться на занятия</a></p>
<!-- Modal "Записаться на занятия" -->
<div class="modal fade" id="my-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm">
     <div class="modal-content">
       <div class="modal-body">
         ...
       </div>
     </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
<!--<div id ="myModal"></div>-->
