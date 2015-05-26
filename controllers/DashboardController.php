<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class DashboardController extends Controller {
	public $layout = 'admin';
	
	/**
     * @inheritdoc
     */
    public function init()
    {
        // check for admin permission (`tbl_role.can_admin`)
        // note: check for Yii::$app->user first because it doesn't exist in console commands (throws exception)
        if (!empty(Yii::$app->user) && !Yii::$app->user->can("admin")) {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }

        parent::init();
    }
	
    public function actionIndex() {
        return $this->render('index');
    }

}
