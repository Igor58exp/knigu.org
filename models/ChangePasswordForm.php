<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\User;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class ChangePasswordForm extends Model
{
    public $oldPassword;
    public $newPassword;
    public $newPasswordRepeat;
	
	private $_user = false;
	
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['oldPassword', 'newPassword', 'newPasswordRepeat'], 'required'],
			['oldPassword', 'validatePassword'],
            ['newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword', 'message' => Yii::t('app', "Passwords don't match")],
            
        ];
    }
	
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'oldPassword' => Yii::t('app', 'Old password'),
            'newPassword' => Yii::t('app', 'Password'),
            'newPasswordRepeat' => Yii::t('app', 'Password repeat'),
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
		if (!$this->hasErrors()) {
			if (($user = $this->getUser()) !== null) {
				if (!$user->validatePassword($this->oldPassword)) {
					$this->addError($attribute, Yii::t('app', 'Incorrect old password.'));
				}
            }
        }
    }
	
	/**
     * Change the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function changePasswor()
    {
        if ($this->validate() && !$this->hasErrors()) {
			if (($user = $this->getUser()) !== null) {
				$user->password = Yii::$app->getSecurity()->generatePasswordHash($this->newPassword);
				return $user->save();
			}
        }
		
		return false;
    }
	
	/**
     * Finds user by [[id]]
     *
     * @return User|null
     */
    public function getUser()
    {
		if ($this->_user === false) {
            $this->_user = User::findOne(Yii::$app->getUser()->getId());
        }
		
        return $this->_user;
    }
}
