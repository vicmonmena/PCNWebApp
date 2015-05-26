<?php
use yii\widgets\Menu;

/* @var $this yii\web\View */

$this->title = Yii::t('app','Dashboard');
?>
<div class="dashboard-index">

    <div class="jumbotron">
        <h1>Dashboard</h1>

        <p class="lead">Desde aquí puedes administrar todas las tablas de la BBDD</p>
    </div>

    <div class="body-content">
        <div class="row">
            <?php 
				echo Menu::widget([
					'items' => [
						//['label' => Yii::t('app','Usuario'), 'url' => ['user/index']],
						['label' => Yii::t('app','Usuario'), 'url' => ['/user/admin']],
						['label' => Yii::t('app','Rol'), 'url' => ['rol/index']],
					],
				]);
					
				echo Menu::widget([
					'items' => [
						// not just as 'controller' even if default action is used.
						['label' => Yii::t('app','Notificacion'), 'url' => ['notificacion/index']],
						['label' => Yii::t('app','Proceso'), 'url' => ['proceso/index']],
						['label' => Yii::t('app','Empresa'), 'url' => ['empresa/index']],
						['label' => Yii::t('app','Ubicacion'), 'url' => ['ubicacion/index']],
					],
				]);
			?>
        </div>
		

    </div>
</div>
