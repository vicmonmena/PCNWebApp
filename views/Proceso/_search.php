<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProcesoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proceso-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idproceso') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'fecha_creacion') ?>

    <?= $form->field($model, 'fecha_modificacion') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
