<?php

use yii\helpers\Html;

$this->registerJsFile(
        'scripts/index.js', ['depends' => 'app\assets\AppAsset']
);



$connection = Yii::$app->getDb();
$command = $connection->createCommand("select item.name, item.id, item.img from item, assorty, shop"
        . " where shop_id = shop.id and item_id = item.id and shop.id = 1 ");

$result = $command->queryAll();

foreach ($result as $key => $value) {
    ?>
    <div class="img" onclick="myclick(<?= $value['id'] ?>)">  <?= ($value['img']) ? Html::img('/images/' . $value['img'], ['width' => 100, 'height' => 100]) : $value['name'] ?></div>
    <?php
}
?>

<p><a class="btn btn-success signup" data-userid="22" >Записаться на занятия</a></p>

<!--http://loco.ru/materials/502-yii2-modalnoe-okno-s-formoi-obratnoi-svyazi-po-ajax-->

