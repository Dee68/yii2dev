<?php

namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "gender".
 *
 * @property int $id
 * @property string $gender_name
 */
class Gender extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gender';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gender_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gender_name' => 'Gender Name',
        ];
    }
    /*
     * get profiles of users
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['gender_id' => 'id']);
    }
}
