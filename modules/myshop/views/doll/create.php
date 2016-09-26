<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\myshop\models\Doll */

$this->title = 'Create Doll';
$this->params['breadcrumbs'][] = ['label' => 'Dolls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doll-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
