<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "geo_countries".
 *
 * @property integer $id
 * @property string $name
 * @property integer $order
 * @property string $created_at
 * @property string $updated_at
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geo_countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['name'], 'required'],
            [['order'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'order' => Yii::t('app', 'Order'),
            'created_at' => Yii::t('app', 'Created'),
            'updated_at' => Yii::t('app', 'Updated'),
        ];
    }
	
	/**
	* Countries::getList()
	*/
    public static function getList()
    {
        return ArrayHelper::map(Countries::find()->all(), 'id', 'name');
    }
}
