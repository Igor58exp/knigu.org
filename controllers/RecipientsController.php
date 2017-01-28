<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\Recipients;
use app\models\RecipientsSearch;

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

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Recipients model.
     * @param integer $id
     * @return mixed
     */
    public function actionSend($id)
    {
        return $this->render('send', [
            'model' => $this->findModel($id),
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
