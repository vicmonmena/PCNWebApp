<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Empresa */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Empresa',
]) . ' ' . $model->idempresa;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Empresas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idempresa, 'url' => ['view', 'id' => $model->idempresa]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="empresa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
