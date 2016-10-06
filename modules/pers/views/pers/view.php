<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\pers\models\Pers */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'story_id' => $model->story_id, 'castle_id' => $model->castle_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'story_id' => $model->story_id, 'castle_id' => $model->castle_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'lvl',
            'exp',
            'img',
            'story_id',
            'castle_id',
        ],
    ]) ?>

</div>
