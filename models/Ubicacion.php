<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "ubicacion".
 *
 * @property integer $idubicacion
 * @property string $nombre
 * @property string $fecha_creacion
 * @property string $fecha_modificacion
 *
 * @property Notificacion[] $notificacions
 */
class Ubicacion extends ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName(){
        return 'ubicacion';
    }

    /**
     * @inheritdoc
     */
    public function rules(){
        return [
            [['nombre'], 'required'],
            [['fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['nombre'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(){
        return [
            'idubicacion' => Yii::t('app', 'Idubicacion'),
            'nombre' => Yii::t('app', 'Nombre'),
            'fecha_creacion' => Yii::t('app', 'Fecha Creacion'),
            'fecha_modificacion' => Yii::t('app', 'Fecha Modificacion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificacions()
    {
        return $this->hasMany(Notificacion::className(), ['ubicacion' => 'idubicacion']);
    }
	
	/**
     * @inheritdoc
     */
    public function behaviors() {
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
