<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\data\SqlDataProvider;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\Recipients;
use app\models\RecipientsSearch;
use app\models\User;
use app\models\ContactForm;

/**
 * RecipientsController implements the CRUD actions for Recipients model.
 */
class RecipientsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'send'],
				'rules' => [
					// allow authenticated users
					[
						'allow' => true,
						'roles' => ['@'],
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
     * Lists all Recipients models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RecipientsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		$modelContactForm = new ContactForm();
        if ($modelContactForm->load(Yii::$app->request->post()) && $modelContactForm->contact(Yii::$app->params['contactsEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'userModel' => User::findOne(Yii::$app->getUser()->getId()),
            'modelContactForm' => $modelContactForm,
        ]);
    }

    /**
     * Displays a single Recipients model.
     * @param integer $id
     * @return mixed
     */
    public function actionSend($id)
    {
        $dataProvider = new SqlDataProvider([
            'sql' => '
				SELECT t.* FROM 
					books AS t
				LEFT JOIN 
					sent_books AS sb ON t.id = sb.book_id
				WHERE
					t.user_id = ' . Yii::$app->getUser()->getId() . '
					AND
					sb.id IS NULL;
			',
            'pagination' => [
                'pageSize' => 999999,
            ],
        ]);
		
		
		return $this->render('send', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Recipients model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Recipients the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Recipients::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
