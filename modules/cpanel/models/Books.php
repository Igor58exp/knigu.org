<?php

namespace app\modules\cpanel\models;

use Yii;

use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $author
 * @property string $hash
 * @property integer $year
 * @property string $created_at
 * @property string $updated_at
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['user_id', 'title', 'author', 'year'], 'required'],
            [['user_id', 'year'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'author', 'hash'], 'string', 'max' => 255],
        ];
    }
	
	/**
     * @inheritdoc
     */
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
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'author' => Yii::t('app', 'Author'),
			'year' => Yii::t('app', 'Year'),
            'hash' => Yii::t('app', 'Code'),
            'user_id' => Yii::t('app', 'User'),
            'created_at' => Yii::t('app', 'Created'),
            'updated_at' => Yii::t('app', 'Updated'),
        ];
    }
	
	/**
	 * @inheritdoc
	 */
	public function beforeSave($insert)
	{
		if (parent::beforeSave($insert)) {
			$this->hash = $this->generateCode();
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * 
	 */
	public function getUser()
	{
		return $this->hasOne(Users::className(), ['id' => 'user_id']);
	}
	
	/**
	 * 
	 */
	public function generateCode()
	{
		return md5('Title: ' . $this->title . ' Author: ' . $this->author . ' Year: ' . $this->year . ' User ID: ' . $this->user_id);
	}
	
	/**
	* 
	*/
    public static function getUsersList()
    {
        return ArrayHelper::map(Users::find()->all(), 'id', 'email');
    }
	
	/**
	* 
	*/
    public static function getYearsList()
    {
        return array_combine (range(date(Y), date(Y) - 200), range(date(Y), date(Y) - 200));
    }
}
