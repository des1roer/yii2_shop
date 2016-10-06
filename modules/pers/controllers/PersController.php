<?php

namespace app\modules\pers\controllers;

use Yii;
use app\modules\pers\models\Pers;
use app\modules\pers\models\PersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PersController implements the CRUD actions for Pers model.
 */
class PersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pers model.
     * @param integer $id
     * @param integer $story_id
     * @param integer $castle_id
     * @return mixed
     */
    public function actionView($id, $story_id, $castle_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $story_id, $castle_id),
        ]);
    }

    /**
     * Creates a new Pers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pers();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'story_id' => $model->story_id, 'castle_id' => $model->castle_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $story_id
     * @param integer $castle_id
     * @return mixed
     */
    public function actionUpdate($id, $story_id, $castle_id)
    {
        $model = $this->findModel($id, $story_id, $castle_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'story_id' => $model->story_id, 'castle_id' => $model->castle_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $story_id
     * @param integer $castle_id
     * @return mixed
     */
    public function actionDelete($id, $story_id, $castle_id)
    {
        $this->findModel($id, $story_id, $castle_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $story_id
     * @param integer $castle_id
     * @return Pers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $story_id, $castle_id)
    {
        if (($model = Pers::findOne(['id' => $id, 'story_id' => $story_id, 'castle_id' => $castle_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
