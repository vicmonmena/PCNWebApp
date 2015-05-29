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
			<?php $form = ActiveForm::begin([
				'id' => 'inputcode-form', 
				'method' => 'post',
				'action' => ['send']
			]);?>
			<p class="lead"><?=Yii::t('app','Notificar_ayuda_ubicacion')?></p>
			<p>			
				<?= $form->field($model, 'location')
					->dropDownList(ArrayHelper::map(Ubicacion::find()->all(), 'idubicacion', 'nombre'))
					->label(false)
				?>
			</p>
			<p class="lead"><?=Yii::t('app','Notificar_ayuda_motivo')?></p>
			<p>
				<?= $form->field($model, 'subject')
					->textArea(array('placeholder' => Yii::t('app','Motivo')))
					->label(false)
				?>
			<p>
			<div class="form-group">
				<?= Html::submitButton(Yii::t('app','Enviar'), ['class' => 'btn btn-primary', 'name' => 'inputcode-button']) ?>
			</div>
			<?php ActiveForm::end(); ?>
		</div>
    </div>
</div>
