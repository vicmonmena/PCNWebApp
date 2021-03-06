<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\CodeForm;
use app\models\NotifyForm;


class SiteController extends Controller {
	
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions() {
		Yii::trace('actions method invoked');
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
		if (Yii::$app->user->can("admin")) {
			Yii::trace('Ya viene de vuelta, lo mandamos para otro lado');
			//return $this->render('/notificacion/index');
		}
		$model = new CodeForm();
		return $this->render('index', [
                'model' => $model,
            ]);
    }

	// No se utiliza, se usa el módulo user de la extensión amnah/yii2-user
    public function actionLogin() {
		Yii::trace('ejecutando - actionLogin');	
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
	
	// No se utiliza, se usa el módulo user de la extensión amnah/yii2-user
    public function actionLogout() {
		Yii::trace('ejecutando - actionLogout');	
        Yii::$app->user->logout();

        return $this->goHome();
    }

	/*
	NO SE UTILIZA
	public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout() {
        return $this->render('about');
    }
	*/
	
	/*
	 * Recoge el código pasado como parámetro en la url, lo valida y devuelve una respuesta.
	 */
	public function actionCodelogin($code) {
		
		$model = new CodeForm();
		if (isset($code)) {
			// Parámetro por URL
			Yii::trace('Codigo URL: ' . $code);	
			if ($model->checkCode($code)) {
				return $this->render('index', ['model' => $model, 'msg' => 'Código válido']);
			} else {
				return $this->render('index', ['model' => $model, 'msg' => 'Código no válido']);
			}
		} else {
			return $this->render('index', ['model' => $model]);
		}
	}
	
	/* 
	 * Recoge el código introducido, lo valida y devuelve una respuesta.
	 */
	public function actionCode() {
		$model = new CodeForm();
		if ($model->load(Yii::$app->request->post())) {
			Yii::trace('Codigo: ' . $model->code);	
			if ($model->checkCode($model->code)) {
				return $this->render('index', ['model' => $model, 'msg' => 'Código válido']);
			} else {
				return $this->render('index', ['model' => $model, 'msg' => 'Código no válido']);
			}
		} else {
			return $this->render('index', ['model' => $model]);
		}
	}
	
	/*
	 * Redirecciona al formulario de notificación de incidencias.
	 */
	public function actionNotify() {
		$model = new NotifyForm();
		return $this->render('notify', ['model' => $model]);
    }
	
	/*
	 * Redirecciona al formulario de notificación de incidencias.
	 */
	public function actionSend() {
		
		$model = new NotifyForm();
		if ($model->load(Yii::$app->request->post())) {
			$code = uniqid();
			$model->sendNotify($code, Yii::$app->user->displayName);
		}
		Yii::$app->session->setFlash('Se ha notificado la incidencia.');
		return $this->render('notify', ['model' => $model]);
    }
	
}
