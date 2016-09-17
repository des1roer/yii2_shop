<?php
use yii\helpers\Html;

$this->registerJsFile(
        'scripts/index.js', ['depends' => 'app\assets\AppAsset']
);

$connection = Yii::$app->getDb();
$command = $connection->createCommand("select shop.name as shop, shop.id as sid, item.name, item.id, item.img from item, assorty, shop"
        . " where shop_id = shop.id and item_id = item.id and shop.id = 1 ");

$result = $command->queryAll();

$command = $connection->createCommand("select user.name as user, money, user.id as uid, item.name, item.id, item.img from user, inventory, item"
        . " where user_id = user.id and item_id = item.id and user.id = 1 ");

$result2 = $command->queryAll();

$cnt = count($result);
$col_cnt = 3; //число стлобцов
$row_cnt = ceil($cnt / $col_cnt); //число строк
$num = $num2 = 0;
?>

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
        <?php for ($i = 0; $i < $col_cnt; $i++) { //столбцы?>
            <td>      
                <div class="myDiv" onclick="myclick(<?= $result[$num]['id'] ?>, 0, 'Купить', '<?= $result[0]['sid'] ?>')">  <?= ($result[$num]['img']) ? Html::img('/images/' . $result[$num]['img']) : $result[$num]['name'] ?></div>
            </td>
            <?php
            $num++;
        }
        ?>
        <td bgcolor="#FF0000">
            &nbsp;
        </td>
        <?php for ($i2 = 0; $i2 < $col_cnt; $i2++) { //столбцы?>
            <td>      
                <div class="myDiv" onclick="myclick(<?= $result2[$num2]['id'] ?>, 0, 'Продать', '<?= $result2[0]['uid'] ?>')">  <?= ($result2[$num2]['img']) ? Html::img('/images/' . $result2[$num2]['img']) : $result2[$num2]['name'] ?></div>
            </td>
            <td>
                <?php
                $num2++;
            }
            ?>
    </tr>
    <?php
}
?>
</table>
<p><a class="btn btn-success signup" data-userid="22" >Записаться на занятия</a></p>

<!--http://loco.ru/materials/502-yii2-modalnoe-okno-s-formoi-obratnoi-svyazi-po-ajax-->

