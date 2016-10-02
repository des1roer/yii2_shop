<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\myshop\models\Item */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$val = $this->params['uuid'];
$iid = (!empty($this->params['iid'])) ?  $this->params['iid'] : -1;

?>
<div class="item-view">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <div id="success"> </div> <!-- For success message -->
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if (Yii::$app->request->post('edit') != '0') {
            echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);

            echo Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'img',
                'value' => $model->imageurl,
                'format' => ['image', ['width' => '100', 'height' => '100']],
            ],
            'cost',
        ],
    ])
    ?>
    <?php if (!empty(Yii::$app->request->post('btn_text'))) { ?>
        <div class="form-group text-right">
            <?= Html::submitButton('Отправить', ['id' => 'send_btn', 'class' => 'btn btn-success', 'onclick' => '(function ( $event ) { sale(' . $model->id . ', ' . $val . ', ' . $model->cost . ', ' . $iid . '); })();']) ?>
        </div>
    <?php } ?>
</div>
