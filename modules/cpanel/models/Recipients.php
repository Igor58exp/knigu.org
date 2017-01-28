<?php

namespace app\modules\cpanel\models;

use Yii;

use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "recipients".
 *
 * @property integer $id
 * @property string $name
 * @property integer $country_id
 * @property integer $region_id
 * @property string $address
 * @property integer $is_pickup
 * @property string $created_at
 * @property string $updated_at
 */
class Recipients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recipients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['name', 'country_id', 'region_id', 'address'], 'required'],
            [['country_id', 'region_id', 'is_pickup'], 'integer'],
            [['name', 'address', 'created_at', 'updated_at'], 'safe'],
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
            'name' => Yii::t('app', 'Name'),
            'country_id' => Yii::t('app', 'Country'),
            'region_id' => Yii::t('app', 'Region'),
            'address' => Yii::t('app', 'Address'),
            'is_pickup' => Yii::t('app', 'Pickup'),
            'created_at' => Yii::t('app', 'Created'),
            'updated_at' => Yii::t('app', 'Updated'),
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
		return $this->hasMany(Books::className(), ['id' => 'book_id'])->viaTable('sent_books', ['recipient_id' => 'id']);
	}
	
	/**
	* 
	*/
    public function getPickupStatusesList()
    {
        return [
            0 => Yii::t('app', 'No'),
            1 => Yii::t('app', 'Yes'),
        ];
    }
}
