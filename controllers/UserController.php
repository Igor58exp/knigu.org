<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\User;
use app\models\ChangePasswordForm;

/**
 * UserController implements the CRUD actions for Users model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['profile', 'changepassword', 'emailverification', 'resetpassword'],
                'rules' => [
					// allow authenticated users
					[
						'allow' => true,
						'actions' => ['index', 'create'],
						'roles' => ['@'],
					],
                    [
                        // allow authenticated users
						'actions' => ['profile', 'changepassword', 'emailverification'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
					// everything else is denied
					[
						'allow' => false,
						'actions' => ['resetpassword'],
					],
                ],
            ]
        ];
    }
	

    /**
     * Profile action.
     *
     * @return string
     */
    public function actionProfile()
    {	
		if (Yii::$app->user->isGuest) {
            return Yii::$app->getResponse()->redirect('signup');
        }
		
		if (($model = User::findOne(Yii::$app->getUser()->getId())) !== null) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
				Yii::$app->session->setFlash('profileFormSubmitted');
				return $this->refresh();
			}
			return $this->render('profile', [
				'model' => $model,
			]);
        } else {
            throw new NotFoundHttpException('The requested profile does not exist.');
        }
    }
	
	/**
     * Change password action.
     *
     * @return string
     */
    public function actionChangepassword()
    {
		if (Yii::$app->user->isGuest) {
            return Yii::$app->getResponse()->redirect('signup');
        }
		
		$model = new ChangePasswordForm();
        if ($model->load(Yii::$app->request->post()) && $model->changePasswor()) {
			Yii::$app->session->setFlash('passwordChangedSuccessfully');
			return $this->refresh();
		}
		
        return $this->render('changepassword', [
            'model' => $model,
        ]);
    }

    /**
     * Email verification action.
     *
     * @return string
     */
    public function actionResetpassword()
    {
        if (Yii::$app->user->isGuest) {
            return Yii::$app->getResponse()->redirect('signup');
        }
		
		return $this->render('resetpassword', [
		]);
    }
	
	/**
     * Email verification action.
     *
     * @return string
     */
    public function actionEmailverification()
    {
        if (Yii::$app->user->isGuest) {
            return Yii::$app->getResponse()->redirect('signup');
        }
		
		return $this->render('emailverification', [
		]);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
