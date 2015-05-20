<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
/*use kartik\date\DatePicker;*/
use app\models\Ubicacion;

/* @var $this yii\web\View */
/* @var $model app\models\Notificacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notificacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'motivo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

	<?php // $form->field($model, 'atendida')->dropDownList(['0' => Yii::t('app', 'no'), '1' => Yii::t('app', 'si')]); ?>
	
	<?= $form->field($model, 'ubicacion') 
		->dropDownList(
			ArrayHelper::map(Ubicacion::find()->all(), 'idubicacion', 'nombre'))
	?>	
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
