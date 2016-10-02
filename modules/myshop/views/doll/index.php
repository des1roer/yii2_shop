<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\myshop\models\DollSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerJsFile(
        'scripts/dnd.js', ['depends' => 'app\assets\AppAsset']
);

$this->registerJsFile(
        'scripts/index.js', ['depends' => 'app\assets\AppAsset']
);

$this->registerCssFile('css/dnd.css', ['depends' => ['app\assets\AppAsset']]);

$connection = Yii::$app->getDb();
$command = $connection->createCommand("select shop.name as shop, shop.id as sid, item.name, item.id, item.img from item, assorty, shop"
        . " where shop_id = shop.id and item_id = item.id and shop.id = 1 ");

$result = $command->queryAll();

$command = $connection->createCommand("select user.name as user, money, user.id as uid, item.name, item.id, "
        . "item.img, item.type, inventory.active from user, inventory, item"
        . " where user_id = user.id and item_id = item.id and user.id = 1 ");

$result2 = $command->queryAll();

$cnt = count($result);
$col_cnt = 3; //число стлобцов
$row_cnt = ceil($cnt / $col_cnt); //число строк
$num = $num2 = 0;
?>
<div id="doll-index">
    <table class="table" style="width: 300px; border: 0;">
        <thead>
        <th colspan="<?= $col_cnt ?>">
            <h3><?= $result[0]['shop'] ?></h3>
        </th>
        <th>&nbsp;</th>
        <th colspan="<?= $col_cnt ?>">
            <h3><?= $result2[0]['user'] ?>&nbsp;<?= $result2[0]['money'] ?></h3>
        </th>
        </thead>
        <?php
        for ($r = 0; $r < $row_cnt; $r++) { //строки
            ?>
            <tr>
                <?php for ($i = 0; $i < $col_cnt; $i++) { //столбцы торговца ?>
                    <td>      
                        <div class="myDiv" onclick="myclick(<?= $result[$num]['id'] ?>, 0, 'Купить', '<?= $result[0]['sid'] ?>')"> 
                            <?= ($result[$num]['img']) ? Html::img('/images/' . $result[$num]['img']) : $result[$num]['name'] ?>
                        </div>
                    </td>
                    <?php
                    $num++;
                }
                ?>
                <td bgcolor="#FF0000">
                    &nbsp;
                </td>
                <?php for ($i2 = 0; $i2 < $col_cnt; $i2++) { //столбцы инвентаря ?>
                    <td>     
                        <?php
                        if (!empty($result2[$num2]['id'])) {
                            if ($result2[$num2]['active'] == 1) {
                                $inv[$result2[$num2]['type']] = $result2[$num2]['img'];
                            } else {
                                ?>
                                <div id='<?= $result2[$num2]['id'] ?>_<?= $result2[$num2]['uid'] ?>' 
                                     class="draggable myDiv type_<?= $result2[$num2]['type'] ?>" 
                                     ondblclick="myclick(<?= $result2[$num2]['id'] ?>, 0, 'Продать',
                                                     '<?= $result2[0]['uid'] ?>')">  
                                     <?= ($result2[$num2]['img']) ? Html::img('/images/' . $result2[$num2]['img']) : $result2[$num2]['name'] ?>
                                </div>
                            <?php } ?>
                        </td>                  
                        <?php
                        $num2++;
                    };
                };
                ?>                   
            </tr>
            <?php
        };
        ?>
    </table>

    <table class="table table-bordered" style="width: 300px; border: 0;">
        <tr>
            <td>Голова</td>
            <td>Тело</td>
            <td>Ноги</td>
        </tr>
        <tr>
            <td><div class="imag invent type_0" id="0"><?= Html::img('/images/' . $inv[0]); ?></div></td>
            <td><div class="imag invent type_1" id="1"><?= Html::img('/images/' . $inv[1]); ?></div></td>
            <td><div class="imag invent type_2" id="2"><?= Html::img('/images/' . $inv[2]); ?></div></td>
        </tr>
    </table>

</div>
