<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "proceso".
 *
 * @property integer $idproceso
 * @property string $nombre
 * @property string $fecha_creacion
 * @property string $fecha_modificacion
 */
class Proceso extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proceso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['nombre'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idproceso' => Yii::t('app', 'Idproceso'),
            'nombre' => Yii::t('app', 'Nombre'),
            'fecha_creacion' => Yii::t('app', 'Fecha Creacion'),
            'fecha_modificacion' => Yii::t('app', 'Fecha Modificacion'),
        ];
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
