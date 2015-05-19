<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Notificacion */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Notificacion',
]) . ' ' . $model->idnotificacion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Notificacions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idnotificacion, 'url' => ['view', 'id' => $model->idnotificacion]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="notificacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
