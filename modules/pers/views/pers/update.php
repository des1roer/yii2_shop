<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pers\models\Pers */

$this->title = 'Update Pers: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id, 'story_id' => $model->story_id, 'castle_id' => $model->castle_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
