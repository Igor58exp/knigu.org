<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "sent_books".
 *
 * @property integer $id
 * @property integer $book_id
 * @property integer $recipient_id
 * @property string $created_at
 * @property string $updated_at
 */
class SentBooks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sent_books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['book_id', 'recipient_id'], 'required'],
            [['book_id', 'recipient_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
            'book_id' => Yii::t('app', 'Book'),
            'recipient_id' => Yii::t('app', 'Recipient'),
            'created_at' => Yii::t('app', 'Created'),
            'updated_at' => Yii::t('app', 'Updated'),
        ];
    }
}
