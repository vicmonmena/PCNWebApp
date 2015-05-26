<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "accion".
 *
 * @property integer $idaccion
 * @property string $procedimiento
 * @property string $fecha_creacion
 * @property string $fecha_modificacion
 *
 * @property UsuarioAccion[] $usuarioAccions
 */
class Accion extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['procedimiento'], 'required'],
            [['fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['procedimiento'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idaccion' => Yii::t('app', 'Idaccion'),
            'procedimiento' => Yii::t('app', 'Procedimiento'),
            'fecha_creacion' => Yii::t('app', 'Fecha Creacion'),
            'fecha_modificacion' => Yii::t('app', 'Fecha Modificacion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioAccions()
    {
        return $this->hasMany(UsuarioAccion::className(), ['accion' => 'idaccion']);
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
