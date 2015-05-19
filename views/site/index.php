<?php
use yii\bootstrap\Dropdown;

/* @var $this yii\web\View */
$this->title = <?=Yii::t('app','PCN')?>;
?>
<div class="site-index">

    <div class="jumbotron">
        <h2><?=Yii::t('app','PCN')?></h2>

        <p class="lead"><?=Yii::t('app','PCNhelp')?></p>
		<p>
			<div class="dropdown">
				<a href="#" data-toggle="dropdown" class="dropdown-toggle"><?=Yii::t('app','Ubicacion')?><b class="caret"></b></a>
				<?php
					echo Dropdown::widget([
						'items' => [
							['label' => 'Oeste 1', 'url' => '/'],
							['label' => 'Oeste 2', 'url' => '/'],
							['label' => 'Oeste 3', 'url' => '/'],
							['label' => 'Norte 1', 'url' => '/'],
							['label' => 'Norte 2', 'url' => '/'],
							['label' => 'Norte 3', 'url' => '/'],
							['label' => 'Sur 1', 'url' => '/'],
							['label' => 'Sur 2', 'url' => '/'],
							['label' => 'Sur 3', 'url' => '/'],
							['label' => 'Este 1', 'url' => '/'],
							['label' => 'Este 2', 'url' => '/'],
							['label' => 'Este 3', 'url' => '/']
						],
					]);
				?>
			</div>
		</p>
        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Enviar</a></p>
    </div>

    <div class="body-content">
	<!--
        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>
		-->
    </div>
</div>
