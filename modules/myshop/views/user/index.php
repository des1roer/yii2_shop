<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->registerJsFile(
        'scripts/index.js', ['depends' => 'app\assets\AppAsset']
);
/* @var $this yii\web\View */
/* @var $searchModel app\modules\myshop\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$controller = Yii::$app->controller->id;
$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

    <p>
    <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'money',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($url, $model) use ($controller) {
                        return Html::a("<span class='glyphicon glyphicon-pencil' onclick='myedit(" . $model->id . " , \"modalupdate\"); return false;'></span>", $url, [
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
