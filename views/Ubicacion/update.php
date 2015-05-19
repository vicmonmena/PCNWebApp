<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ubicacion */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Ubicacion',
]) . ' ' . $model->idubicacion;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ubicacions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idubicacion, 'url' => ['view', 'id' => $model->idubicacion]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ubicacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
