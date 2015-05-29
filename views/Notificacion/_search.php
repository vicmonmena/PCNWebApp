<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NotificacionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notificacion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idnotificacion') ?>

    <?= $form->field($model, 'motivo') ?>

    <?= $form->field($model, 'codigo') ?>

    <?= $form->field($model, 'fecha_creacion') ?>
	
	<?= $form->field($model, 'fecha_modificacion') ?> 

    <?= $form->field($model, 'ubicacion') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>
   
    <?php ActiveForm::end(); ?>

</div>
