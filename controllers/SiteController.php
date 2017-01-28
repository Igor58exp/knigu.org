<?php

namespace app\controllers;

use Yii;

use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Users;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup', 'profile'],
                'rules' => [
					[
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        // allow authenticated users
						'actions' => ['logout', 'profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
		
		Yii::$app->user->logout();

        return $this->goHome();
    }
	
	/**
     * Sign Up action.
     *
     * @return string
     */
    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
		
		$model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('signUpFormSubmitted');
            return $this->refresh();
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
	
    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
	
	/**
     *
     */
    public function actionStatistics()
    {
        $dataProvider = new SqlDataProvider([
            'sql' => '
				SELECT gr.`name`, COUNT(*) AS amount, r.`region_id`  FROM 
					sent_books AS t
				LEFT JOIN 
					recipients AS r ON t.recipient_id = r.id
				LEFT JOIN
					geo_regions AS gr ON r.region_id = gr.id
				GROUP BY r.`region_id`;
			',
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
		
		return $this->render('statistics', ['dataProvider' => $dataProvider]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
	
	/**
     * Displays about page.
     *
     * @return string
     */
    public function actionDownloads()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Users::find()->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
		
		return $this->render('downloads', ['listDataProvider' => $dataProvider]);
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
		
		if (($model = Users::findOne(Yii::$app->getUser()->id)) !== null) {
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
}
