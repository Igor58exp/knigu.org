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
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
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
            [['name', 'surname', 'password', 'email', 'authKey', 'accessToken'], 'string', 'max' => 255],
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
			'authKey' => Yii::t('app', 'authKey'),
			'accessToken' => Yii::t('app', 'accessToken'),
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
	 * @inheritdoc
	 */
	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			if ($this->isNewRecord) {
				$this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
				$this->emailVerified = 1;
				$this->is_blocked = 0;
				$this->verificationToken = Yii::$app->security->generateRandomString();
			}
			return true;
		} else {
			return false;
		}
	}
	
	/**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
		return static::findOne(['id' => $id, 'emailVerified' => 1, 'is_blocked' => 0]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token, 'emailVerified' => 1, 'is_blocked' => 0]);
    }

    /**
     * Finds user by e-mail
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
		return static::findOne(['email' => $email, 'emailVerified' => 1, 'is_blocked' => 0]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }
	
	/**
	* 
	*/
	public function generateAuthKey()
	{
		$this->authKey = Yii::$app->security->generateRandomString();
	}

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) // admin@mail.net
    {
		return Yii::$app->getSecurity()->validatePassword($password, $this->password);
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
