<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
?>
<div class="user-index">
	Hola manola
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idusuario',
            'username',
            'password',
            'auth_key',
            'password_reset_token',
            // 'email:email',
            // 'telefono',
            // 'movil',
            // 'nombre',
            // 'apellidos',
            // 'empresa',
            // 'proceso',
            // 'rol',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
