<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\CodeForm */

$this->title = Yii::t('app','PCN');
?>
<div class="site-index">
	<div class="body-content">
		<div class="jumbotron">
			<h2><?=Yii::t('app','PCN')?></h2>

			<p class="lead">
				<?=Yii::t('app','PCNInputCode')?>
			</p>
			<p>
			<?php $form = ActiveForm::begin([
				'id' => 'inputcode-form', 
				'method' => 'post',
				'action' => ['code']
			]);?>
				<?= $form->field($model, 'code')->textInput(array('placeholder' => Yii::t('app','Codigo'))) ?>
				<div class="form-group">
					<?= Html::submitButton(Yii::t('app','Enviar'), ['class' => 'btn btn-primary', 'name' => 'inputcode-button']) ?>
				</div>
			<?php ActiveForm::end(); ?>
			</p>
			<? if (isset($msg)) { ?>
			<p class="help-block help-block-error">
				<?= Yii::t('app','codigo no valido') ?>
			</p>
			<? }?>
		</div>

    </div>
</div>
