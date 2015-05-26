<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "empresa".
 *
 * @property integer $idempresa
 * @property string $nombre
 * @property string $web
 * @property string $fecha_creacion
 * @property string $fecha_modificacion
 */
class Empresa extends ActiveRecord
{
	/**
     * @var int Admin user empresa
     */
    const EMPRESA_TELEFONICA_SA = 1;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'empresa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['nombre'], 'string', 'max' => 45],
            [['web'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idempresa' => Yii::t('app', 'Idempresa'),
            'nombre' => Yii::t('app', 'Nombre'),
            'web' => Yii::t('app', 'Web'),
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
