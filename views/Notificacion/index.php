<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Ubicacion;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotificacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Notificacions');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="notificacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Notificacion'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'motivo',
            'codigo',
			[
				'attribute' => 'ubicacion',
				'value' => 'ubicacion.nombre'
			],
			'fecha_creacion',
            'fecha_modificacion',
			'atendida',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
