<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->registerJsFile(
        'scripts/index.js', ['depends' => 'app\assets\AppAsset']
);
/* @var $this yii\web\View */
/* @var $searchModel app\modules\myshop\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            [
                'attribute' => 'img',
                'format' => 'html',
                'value' => function($data) {
                    return Html::img($data->imageurl, ['width' => '100']);
                },
                    ],
                    'cost',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a("<span class='glyphicon glyphicon-eye-open' onclick='myclick(" . $model->id . ", 1); return false;'></span>", $url, [
                                            'title' => Yii::t('app', 'view'),
                                ]);
                            },
                                ],
                                'template' => '{view} {update} {delete}',
                            ]
                        ],
                    ]);
                    ?>
                    <?php Pjax::end(); ?></div>
