<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Notificacion;
use app\models\Role;

/**
 * CodeForm is the model behind the InputCode form.
 */
class NotifyForm extends Model {
	
	/* Ubicación donde se ha producido la incidencia */
	public $location;
	/* Motivo de la incidencia */
	public $subject;

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
	 * 1. Creamos la notificación
	 * 2. Obtenemos el listado de directores
	 * 3. Registramos una usuario_notificacion por cada director
	 * 4. Envía un email por director
	 * 5. Envía un SMS por director
     */
    public function sendNotify($code, $notifier) {
		/*
		 * TODO Envíar un email+SMS a cada directivo, 
		 * indicando el asunto, la localización y el código.
		 * ¡¡El código debe ser único para cada directivo!!
		 */
		Yii::trace('MOTIVO: ' . $this->subject);
		Yii::trace('UBICACION: ' . $this->location);
		Yii::trace('CODIGO: ' . $code);
		
		// Esto debe ser transaccional:
		$connection = Yii::$app->db;
		$transaction = $connection->beginTransaction();
		try {

			// 1. Creamos la notificación
			$notificacion = new Notificacion();
			$notificacion->motivo = $this->subject;
			$notificacion->ubicacion = $this->location;
			$notificacion->codigo = $code;
			$notificacion->atendida = Notificacion::NO_ATENDIDA;
			$notificacion->save();
			
			// 2. Obtenemos los directores
			// directores = SELECT id, nombre, apellidos, email, movil FROM user WHERE role_id = Role:DIRECTOR
			// Yii::$app->user->
			$directores = User::find()
				->where(['role_id' => Role::ROLE_DIRECTOR])
				->all();
				
			// 3. Creamos la relación  - notificacón <> notificador <> director 
			$modelUN = new UsuarioNotificacion();
			$modelUN->idnotificacion = $notificacion->idnotificacion;
			$modelUN->emisor = $notifier;
			
			/* for (i=0 i < directores.size; i++) {
			 * 	insert into usuario_notificacion (notificacion,emisor,destinatario)
			 *  values ($notificacion->idnotificacion, $notifier->id, directores[i]->id)
			 * $modelUN->destinatario = $notificacion->idnotificacion;
			 * $modelUN->save();
			 * }
			 */		 
		 
			// Termina la transacción
			$transaction->commit();
			
		} catch (Exception $e) {
			$transaction->rollBack();
		}
		
		// 4. Envío de emails
		/* Plantilla donde aparezca: 
		 * Nombre y apellidos de la persona que notifica la incidencia,
		 * Nombre y apellidos del directivo
		 * Ubicacion donde se produjo la incidencia
		 * Link con el código
		 */
		
		// 5. Envío de SMS
        return true;
    }
	
	/**
	 * Login de usuario a partir del código recibido por sms/email
	 * 1. Busca el código en BBDD.
	 * 2. Si no existe lo indica
	 * 3. Si existe => extrae los datos del directivo
	 * 4. Se loga en el sistema: usr y pass del directivo del que extrae los datos.
	 * 5. Redirecciona a la vista con la información referente a la incidencia.
     */
	public function login($code) {
		
		// 1. Busca código de notificación en BBDD
		$modelUN = UsuarioNotificacion::find
			->where(['codigo' => $code])
			->one();

		// 2. Si no existe lo indica
		
		
		// 3. Extrae los datos del directivo de la BBDD
		$modelDestinatario = User::find()
			->where(['id' => $modelUN->idestinatario])
			->one();
		$modelEmisor = User::find()
			->where(['id' => $modelUN->idemisor])
			->one();
			
		// 4. LOGIN
		
		// 5. Redirecciona a la vista donde se muestra la información de la incidencia.
	}
}
