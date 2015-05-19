<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "notificacion".
 *
 * @property integer $idnotificacion
 * @property string $motivo
 * @property string $codigo
 * @property string $fecha_creacion
 * @property integer $ubicacion
 * @property string $fecha_modificacion
 *
 * @property Ubicacion $ubicacion0
 * @property UsuarioNotificacion[] $usuarioNotificacions
 */
class Notificacion extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notificacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['motivo', 'codigo', 'ubicacion'], 'required'],
            [['fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['ubicacion'], 'integer'],
            [['motivo', 'codigo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idnotificacion' => Yii::t('app', 'Idnotificacion'),
            'motivo' => Yii::t('app', 'Motivo'),
            'codigo' => Yii::t('app', 'Codigo'),
            'fecha_creacion' => Yii::t('app', 'Fecha Creacion'),
            'ubicacion' => Yii::t('app', 'Ubicacion'),
            'fecha_modificacion' => Yii::t('app', 'Fecha Modificacion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUbicacion()
    {
        return $this->hasOne(Ubicacion::className(), ['idubicacion' => 'ubicacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioNotificacions()
    {
        return $this->hasMany(UsuarioNotificacion::className(), ['notificacion' => 'idnotificacion']);
    }
	
	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class'      => 'yii\behaviors\TimestampBehavior',
                'value'      => function () { return date("dd-mm-yyyy H:i:s"); },
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'fecha_creacion',
					ActiveRecord::EVENT_BEFORE_UPDATE => 'fecha_modificacion'
                ],
            ],
        ];
    }
}
