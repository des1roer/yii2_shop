<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\pers\models\Pers */

$this->title = 'Create Pers';
$this->params['breadcrumbs'][] = ['label' => 'Pers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
