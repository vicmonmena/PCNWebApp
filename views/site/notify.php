<?php
use yii\bootstrap\Dropdown;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Ubicacion;

/* @var $this yii\web\View */
/* @var $model app\models\NotifyForm */

$this->title = Yii::t('app','PCN');
?>
<div class="site-index">
	<div class="body-content">
		<div class="jumbotron">
			<h2><?=Yii::t('app','PCN')?></h2>
			<p class="lead"><?=Yii::t('app','Notificar-ayuda')?></p>
			<?php $form = ActiveForm::begin([
				'id' => 'inputcode-form', 
				'method' => 'post',
				'action' => ['sendNotify']
			]);?>
			<p>			
				<?= $form->field($model, 'location') 
					->dropDownList(
						ArrayHelper::map(Ubicacion::find()->all(), 'idubicacion', 'nombre'))
				?>
			</p>
			<p>
				<?= $form->field($model, 'subject')->textInput(array('placeholder' => Yii::t('app','Motivo'))) ?>
			<p>
			<div class="form-group">
				<?= Html::submitButton(Yii::t('app','Enviar'), ['class' => 'btn btn-primary', 'name' => 'inputcode-button']) ?>
			</div>
			<?php ActiveForm::end(); ?>
		</div>
    </div>
</div>
