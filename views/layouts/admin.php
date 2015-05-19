<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
	<header>
	<?php
		$items = [
			['label' => Yii::t('app','Home'), 'url' => ['/site/index']],
			['label' => Yii::t('app','Notificacion'), 'url' => ['notificacion/index']],
			['label' => Yii::t('app','Proceso'), 'url' => ['proceso/index']],
			['label' => Yii::t('app','Empresa'), 'url' => ['empresa/index']],
			['label' => Yii::t('app','Ubicacion'), 'url' => ['ubicacion/index']],
		];
		if (Yii::$app->user->isGuest) {
			array_push($items,['label' => 'Login', 'url' => ['/user/login']]);
		} else {
			if (Yii::$app->user->can("admin")) {
				array_push($items,['label' => Yii::t('app','Dashboard'), 'url' => ['/dashboard']]);
			}
			array_push($items,
				['label' => 'Logout (' . Yii::$app->user->displayName . ')',
				'url' => ['/user/logout'],
				'linkOptions' => ['data-method' => 'post']]
			);
		}
		
		NavBar::begin([
			'brandLabel' => '<img src="../images/logo_telefonica_azul.png">',
			'brandUrl' => Yii::$app->homeUrl,
			'options' => [
				'class' => 'navbar-inverse navbar-fixed-top',
			],
		]);
		echo Nav::widget([
			'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => $items,
		]);
		NavBar::end();
	?>
	</header>
	<?php $this->beginBody() ?>
		<div class="wrap">

			<div class="container">
				<?= Breadcrumbs::widget([
					'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
				]) ?>
				<?= $content ?>
			</div>
		</div>

		<footer class="footer">
			<div class="container">
				<p class="pull-left">&copy; My Company <?= date('Y') ?></p>
				<p class="pull-right"><?= Yii::powered() ?></p>
			</div>
		</footer>
	<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
