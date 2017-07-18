<?php

namespace frontend\models;

use Yii;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $birthdate
 * @property int $gender_id
 * @property string $created_at
 * @property string $updated_at
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'gender_id'], 'integer'],
            [['birthdate', 'created_at', 'updated_at'], 'safe'],
            [['gender_id','user_id','birthdate'], 'required'],
            [['birthdate'], 'date', 'format'=>'Y-m-d'],
            [['gender_id'], 'in' , 'range' => array_keys($this->getGenderList())],
            [['first_name', 'last_name'], 'string', 'max' => 255],
        ];
    }
    /*
     * 
     */
    public function behaviors() {
        return [
            'class' => 'yii\behaviors\TimestampBehavior',
            'timestamp' => [
                'attributes' => [
                  ActiveRecord::EVENT_BEFORE_INSERT =>['created_at','updated_at'],
                ActiveRecord::EVENT_BEFORE_UPDATE =>['updated_at'],  
                ],
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'birthdate' => 'Birthdate',
            'gender_id' => 'Gender ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    /*
     * get gender
     */
    public function getGender()
    {
        return $this->hasOne(Gender::className(), ['id' => 'gender_id']);
    }
    /*
     * get gender name
     */
    public function getGenderName()
    {
        return $this->gender->gender_name;
    }
    /*
     * get list of genders
     */
    public static function getGenderList()
    {
        $dropoptions = Gender::find()->asArray()->all();
        return ArrayHelper::map($dropoptions, 'id', 'gender_name');
    }
    /*
     * get user from profile
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    /*
     * get user name
     */
    public function getUserName()
    {
        return $this->user->username;
    }
    /*
     * @getuserId
     */
    public function getUserId()
    {
        return $this->user ?$this->user->id : 'none';
    }
    /*
     * @get user link
     */
    public function getUserLink()
    {
        $url = Url::to(['user/view', 'id' => $this->UserId]);
        $options = [];
        return Html::a($this->getUserName(), $url, $options);
    }
    /*
     * get user profile link
     */
    public function getProfileIdLink()
    {
        $url = Url::to(['profile/update', 'id' => $this->id]);
        $options = [];
        return Html::a($this->id, $url, $options);
    }
}
