<?php

namespace backend\models;

use yii\db\ActiveRecord;
use common\models\User;
/**
 * This is the model class for table "user_type".
 *
 * @property int $id
 * @property string $user_type_name
 * @property int $user_type_value
 */
class UserType extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type_value'], 'integer'],
            [['user_type_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_type_name' => 'User Type Name',
            'user_type_value' => 'User Type Value',
        ];
    }
    /*
     * get users type
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['user_type_id' => 'user_type_value']);
    }
}
