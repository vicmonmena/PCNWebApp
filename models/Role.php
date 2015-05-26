<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "role".
 *
 * @property integer $id
 * @property string $name
 * @property string $create_time
 * @property string $update_time
 * @property integer $can_admin
 *
 * @property User[] $users
 */
class Role extends ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['create_time', 'update_time'], 'safe'],
            [['can_admin'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'can_admin' => Yii::t('app', 'Can Admin'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['role_id' => 'id']);
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
                    ActiveRecord::EVENT_BEFORE_INSERT => 'create_time',
					ActiveRecord::EVENT_BEFORE_UPDATE => 'update_time'
                ],
            ],
        ];
    }
}
