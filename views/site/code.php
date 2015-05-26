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
			<h3>Html::encode(Código introducido: <?= Html::encode($code) ?></h3>
			<p><?= Html::encode($target) ?></p>
			<p>Indica el procedimiento a seguir y el presonal crítico al que se le va a notificar:</p>
		</div>
    </div>
</div>
