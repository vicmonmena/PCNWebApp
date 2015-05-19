<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proceso */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Proceso',
]) . ' ' . $model->idproceso;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Procesos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idproceso, 'url' => ['view', 'id' => $model->idproceso]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="proceso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
