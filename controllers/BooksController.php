<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\Books;
use app\models\BooksSearch;

use app\models\SentBooks;
use app\models\Recipients;

/**
 * BooksController implements the CRUD actions for Books model.
 */
class BooksController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete'],
				'rules' => [
					// allow authenticated users
					[
						'allow' => true,
						'actions' => ['index', 'create'],
						'roles' => ['@'],
					],
					// allow authenticated users
					[
						'allow' => true,
						'actions' => ['update', 'view'],
						'roles' => ['@'],
						'matchCallback' => function ($rule, $action) {
							return $this->findModel(Yii::$app->request->get('id'))->user_id == Yii::$app->user->id;
						},
					],
					// everything else is denied
					[
						'allow' => false,
					],
				],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
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
     * Lists all Books models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BooksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Books model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Books model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    { 
        $model = new Books(); 
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
	
	/**
     * 
     */
    public function actionSend()
    {
		if (Yii::$app->request->isPost)
		{
			foreach((array) Yii::$app->request->post('book_ids') AS $book_id)
			{
				#
				if (($modelBooks = Books::findOne([
					'id' => $book_id,
					'user_id' => Yii::$app->user->getId(),
				])) == null) {
					// throw new NotFoundHttpException('The requested page does not exist. 1');
				}
				// echo '<pre>book_id = ', print_r($modelBooks->id, true), '</pre>';
				
				
				#
				if (($modelRecipient = Recipients::findOne(Yii::$app->request->post('recipient_id'))) == null) {
					// throw new NotFoundHttpException('The requested page does not exist. 2');
				}
				// echo '<pre>recipient_id = ', print_r($modelRecipient->id, true), '</pre>';
				
				
				if (($modelSentBooks = SentBooks::findOne([
					// 'recipient_id' => $modelRecipient->id,
					'book_id' => $modelBooks->id,
				])) == null) {
					
					$model = new SentBooks(); 
					$model->recipient_id = $modelRecipient->id;
					$model->book_id = $modelBooks->id;
					
					// echo '<pre>', print_r($model, true), '</pre>'; exit();
			
					if ($model->save(false)) {
						Yii::$app->session->setFlash('book_is_send_successfully');
					} else {
						// echo '<pre>', print_r($model->getErrors(), true), '</pre>'; exit();
					}
					
				} else {
					
					// throw new NotFoundHttpException('The requested page does not exist. 3');
				}
			}
		}
		
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Books model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Books::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
