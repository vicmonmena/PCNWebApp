<?php

namespace app\controllers;

class DashboardController extends \yii\web\Controller
{
	public $layout = 'admin';
	
    public function actionIndex()
    {
        return $this->render('index');
    }

}
