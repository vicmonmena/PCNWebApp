<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * CodeForm is the model behind the InputCode form.
 */
class NotifyForm extends Model {
    
	/* Ubicaci�n donde se ha producido la incidencia */
	public $location;
	/* Motivo de la incidencia */
	public $subject;
	/*Will be auto-generated*/
	public $code;

    /**
     * @return array the validation rules.
     */
    public function rules(){
        return [
            [['location', 'subject'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels(){
        return [
            'verifyCode' => 'Verification Code',
        ];
    }
	
    /**
	 * 1. Busca el c�digo en BBDD.
	 * 2. Si no existe lo indica
	 * 3. Si existe => extrae los datos del directivo.
	 * 4. Se loga en el sistema: usr y pass del directivo del que extrae los datos.
	 * 5. Muestra la informaci�n referente a la incidencia.
     */
    public function sendNotify($code, $subject, $location) {
		/*
		 * TODO Env�a un email+SMS a cada directivo, indicando el asunto, la localizaci�n y el c�digo.
		 * �El c�digo debe ser �nico para todos los directivos?
		 */
        return true;
    }
}
