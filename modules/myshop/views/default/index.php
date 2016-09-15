<?php
$connection = Yii::$app->getDb();
$command = $connection->createCommand("select item.name, item.id from item, assorty, shop"
        . " where shop_id = shop.id and item_id = item.id and shop.id = 1 ");

$result = $command->queryAll();

foreach ($result as $key => $value) {
    ?>
    <div><?= $value['name'] ?></div>
    <?php
}
?>

<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
