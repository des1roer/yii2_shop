<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\pers\models\PersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'lvl') ?>

    <?= $form->field($model, 'exp') ?>

    <?= $form->field($model, 'img') ?>

    <?php // echo $form->field($model, 'story_id') ?>

    <?php // echo $form->field($model, 'castle_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
