<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\NotSupportedException;
use yii\helpers\Security;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $idusuario
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $password_reset_token
 * @property string $email
 * @property string $telefono
 * @property string $movil
 * @property string $nombre
 * @property string $apellidos
 * @property integer $empresa
 * @property integer $proceso
 * @property integer $rol
 *
 * @property Rol $rol0
 * @property Empresa $empresa0
 * @property Proceso $proceso0
 * @property UsuarioAccion[] $usuarioAccions
 * @property UsuarioAccion[] $usuarioAccions0
 * @property UsuarioNotificacion[] $usuarioNotificacions
 * @property UsuarioNotificacion[] $usuarioNotificacions0
 */
class User extends ActiveRecord implements IdentityInterface {

    private static $users = [
        '100' => [
            'idusuario' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'auth_key' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'idusuario' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'auth_key' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];
	
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'auth_key', 'email', 'movil', 'nombre', 'apellidos', 'empresa', 'proceso', 'rol'], 'required'],
            [['empresa', 'proceso', 'rol'], 'integer'],
            [['username', 'password', 'email', 'telefono', 'movil', 'nombre', 'apellidos'], 'string', 'max' => 45],
            [['auth_key'], 'string', 'max' => 32],
            [['password_reset_token'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idusuario' => Yii::t('app', 'Idusuario'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'telefono' => Yii::t('app', 'Telefono'),
            'movil' => Yii::t('app', 'Movil'),
            'nombre' => Yii::t('app', 'Nombre'),
            'apellidos' => Yii::t('app', 'Apellidos'),
            'empresa' => Yii::t('app', 'Empresa'),
            'proceso' => Yii::t('app', 'Proceso'),
            'rol' => Yii::t('app', 'Rol'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol0()
    {
        return $this->hasOne(Rol::className(), ['idrol' => 'rol']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa0()
    {
        return $this->hasOne(Empresa::className(), ['idempresa' => 'empresa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProceso0()
    {
        return $this->hasOne(Proceso::className(), ['idproceso' => 'proceso']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioAccions()
    {
        return $this->hasMany(UsuarioAccion::className(), ['emisor' => 'idusuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioAccions0()
    {
        return $this->hasMany(UsuarioAccion::className(), ['destinatario' => 'idusuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioNotificacions()
    {
        return $this->hasMany(UsuarioNotificacion::className(), ['destinatario' => 'idusuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioNotificacions0()
    {
        return $this->hasMany(UsuarioNotificacion::className(), ['emisor' => 'idusuario']);
    }
	
	/*********************************************/
	/** INCLUDE USER LOGIN VALIDATION FUNCTIONS **/
	/*********************************************/
	
	/**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
          return static::findOne(['access_token' => $token]);
    }
 
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === sha1($password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Security::generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

	/**********************************/
	/** CUSTOM METHODS BY VICMONMENA **/
	/**********************************/
	
	public function isAdmin() {
		return $this->username == 'admin';
	}	
}