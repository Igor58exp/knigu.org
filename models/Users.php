<?php

namespace app\models;

use Yii;

use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $password
 * @property integer $country_id
 * @property string $email
 * @property integer $emailVerified
 * @property string $verificationToken
 * @property integer $is_blocked
 * @property string $created_at
 * @property string $updated_at
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password', 'email', 'country_id', 'region_id'], 'required'],
            [['country_id', 'region_id', 'emailVerified', 'is_blocked'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'surname', 'password', 'email'], 'string', 'max' => 255],
            [['verificationToken'], 'string', 'max' => 512],
			[['email'], 'email'],
			['email', 'unique'],
			// [['name', 'surname'], 'unique', 'targetAttribute' => ['name', 'surname']],
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
            'surname' => Yii::t('app', 'Surname'),
            'password' => Yii::t('app', 'Password'),
            'country_id' => Yii::t('app', 'Country'),
            'region_id' => Yii::t('app', 'Region'),
            'email' => Yii::t('app', 'E-mail'),
            'emailVerified' => Yii::t('app', 'Email Verified'),
            'verificationToken' => Yii::t('app', 'Verification Token'),
            'is_blocked' => Yii::t('app', 'Blocked'),
            'created_at' => Yii::t('app', 'Created'),
            'updated_at' => Yii::t('app', 'Updated'),
        ];
    }
	
	public function behaviors()
	{
		return [
			[
				'class' => TimestampBehavior::className(),
				'createdAtAttribute' => 'created_at',
				'updatedAtAttribute' => 'updated_at',
				'value' => new Expression('NOW()'),
			],
		];
	}
	
	/**
	 * 
	 */
	public function getCountry()
	{
		return $this->hasOne(Countries::className(), ['id' => 'country_id']);
	}
	
	/**
	 * 
	 */
	public function getRegion()
	{
		return $this->hasOne(Regions::className(), ['id' => 'region_id']);
	}
	
	/**
	* 
	*/
	public function getBooks()
    {
        return $this->hasMany(Books::className(), ['user_id' => 'id']);
    }
	
	/**
	* 
	*/
    public function getEmailVerifiedStatusesList()
    {
        return [
            0 => Yii::t('app', 'No'),
            1 => Yii::t('app', 'Yes'),
        ];
    }
	
	/**
	* 
	*/
    public function getBlockedStatusesList()
    {
        return [
            0 => Yii::t('app', 'No'),
            1 => Yii::t('app', 'Yes'),
        ];
    }
}
