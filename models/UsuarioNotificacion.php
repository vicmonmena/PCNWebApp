<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "usuario_notificacion".
 *
 * @property integer $idusu_notif
 * @property integer $notificacion
 * @property integer $emisor
 * @property integer $destinatario
 * @property integer $atendida
 *
 * @property User $destinatario0
 * @property User $emisor0
 * @property Notificacion $notificacion0
 */
class UsuarioNotificacion extends ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario_notificacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notificacion', 'emisor', 'destinatario', 'atendida'], 'required'],
			[['fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['notificacion', 'emisor', 'destinatario', 'atendida'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idusu_notif' => Yii::t('app', 'Idusu Notif'),
            'notificacion' => Yii::t('app', 'Notificacion'),
            'emisor' => Yii::t('app', 'Emisor'),
            'destinatario' => Yii::t('app', 'Destinatario'),
            'atendida' => Yii::t('app', 'Atendida'),
			'fecha_creacion' => Yii::t('app', 'Fecha Creacion'),
            'fecha_modificacion' => Yii::t('app', 'Fecha Modificacion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDestinatario0()
    {
        return $this->hasOne(User::className(), ['id' => 'destinatario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmisor0()
    {
        return $this->hasOne(User::className(), ['id' => 'emisor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificacion0()
    {
        return $this->hasOne(Notificacion::className(), ['idnotificacion' => 'notificacion']);
    }
	
	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class'      => 'yii\behaviors\TimestampBehavior',
                'value'      => new Expression('NOW()'),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'fecha_creacion',
					ActiveRecord::EVENT_BEFORE_UPDATE => 'fecha_modificacion'
                ],
            ],
        ];
    }
}
