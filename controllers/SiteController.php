<?php

namespace app\controllers;

use Yii;

use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\data\ArrayDataProvider;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;

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
		
		$model = new User(['scenario' => User::SCENARIO_SIGNUP]);

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
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['contactsEmail'])) {
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
            'query' => User::find()->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
		
		$data = [
			[
				'title' => 'Исповедь',
				'author' => 'Августин (Блаженный) Аврелий',
				'link' => 'avreliy.doc',
			],[
				'title' => 'Новый Завет',
				'author' => 'Автор неизвестен',
				'link' => 'bible.doc',
			], [
				'title' => 'Божественная комедия',
				'author' => 'Алигьери Данте',
				'link' => 'dante.doc',
			], [
				'title' => 'Чёрные маски',
				'author' => 'Андреев Леонид',
				'link' => 'andreev.doc',
			], [
				'title' => 'Отец Горио',
				'author' => 'Бальзак Оноре',
				'link' => 'balzak.doc',
			], [
				'title' => 'Сборник стихов',
				'author' => 'Блок Александр',
				'link' => 'blok.doc',
			], [
				'title' => 'Мертвые души',
				'author' => 'Гоголь Николай',
				'link' => 'gogol.doc',
			], [
				'title' => 'Илиада.Одиссея',
				'author' => 'Гомер',
				'link' => 'gomer.doc',
			], [
				'title' => 'Оды',
				'author' => 'Гораций Квинт',
				'link' => 'kvint.doc',
			], [
				'title' => 'Мамаша Кемских',
				'author' => 'Горький Максим',
				'link' => 'gorkij.doc',
			], [
				'title' => 'Жизнь и удивительные приключения Робинзона Крузо ',
				'author' => 'Дефо Даниэль',
				'link' => 'defo.doc',
			], [
				'title' => 'Бесы',
				'author' => 'Достоевский Федор',
				'link' => 'dostoevsky.doc',
			], [
				'title' => 'Добыча',
				'author' => 'Золя Эмиль',
				'link' => 'zoya.doc',
			], [
				'title' => 'Карьера Ругонов',
				'author' => 'Золя Эмиль',
				'link' => 'zoya2.doc',
			], [
				'title' => 'Стихотворения',
				'author' => 'Киплинг Редьярд',
				'link' => 'kipling.doc',
			], [
				'title' => 'Звезда Соломона',
				'author' => 'Куприн Александр',
				'link' => 'kuprin.doc',
			], [
				'title' => 'Герой нашего времени',
				'author' => 'Лермонтов Михаил',
				'link' => 'lermontov.doc',
			], [
				'title' => 'Тартюф',
				'author' => 'Мольер Жан-Батист',
				'link' => 'batist.doc',
			], [
				'title' => 'Тартюф-1',
				'author' => 'Мольер Жан-Батист',
				'link' => 'batist1.doc',
			], [
				'title' => 'Русские женщины',
				'author' => 'Некрасов Николай',
				'link' => 'nekrasov.doc',
			], [
				'title' => 'Метаморфозы',
				'author' => 'Публий Овидий',
				'link' => 'ovidij.doc',
			], [
				'title' => 'Евгений Онегин',
				'author' => 'Пушкин Александр',
				'link' => 'pushkin.doc',
			], [
				'title' => 'Том 8. Помпадуры и помпадурши. История одного города',
				'author' => 'Салтыков-Щедрин Михаил',
				'link' => 'soltikov.doc',
			], [
				'title' => 'Путешествия Лемюэля Гулливера',
				'author' => 'Свифт Джонатан',
				'link' => 'svift.doc',
			], [
				'title' => 'Приключение Гекльберри Финна',
				'author' => 'Твен Марк',
				'link' => 'tven.doc',
			],  [
				'title' => 'Отцы и дети',
				'author' => 'Тургенев Иван',
				'link' => 'turgen.doc',
			], [
				'title' => 'Том 7. Отцы и дети. Дым. Повести и рассказы 1861-1867',
				'author' => 'Тургенев Иван',
				'link' => 'turgen2.doc',
			], [
				'title' => 'Палата',
				'author' => 'Чехов Антон',
				'link' => 'cheh.doc',
			], [
				'title' => 'Гамлет 2',
				'author' => 'Шекспир Уильям',
				'link' => 'shekspir.doc',
			]
		];
		
		$dataProvider = new ArrayDataProvider([
			'allModels' => $data,
			'pagination' => [
				'pageSize' => 9999,
			],
			'sort' => [
				'attributes' => ['title', 'author'],
			],
		]);
		
		return $this->render('downloads', ['listDataProvider' => $dataProvider]);
    }
}
