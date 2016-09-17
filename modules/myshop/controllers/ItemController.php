<?php

namespace app\modules\myshop\controllers;

use Yii;
use app\modules\myshop\models\Item;
use app\modules\myshop\models\ItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionSale() {
        $item_id = Yii::$app->request->post('item_id');
        $unit_id = Yii::$app->request->post('unit_id');
        $type = Yii::$app->request->post('type');
        $cost = Yii::$app->request->post('cost');
        $col =  'user_id';
        $connection = Yii::$app->getDb();
        if ($type == 'inventory') {
            $command = $connection->createCommand("update user set money = money - $cost");
            $result = $command->execute();

            $command = $connection->createCommand("insert into $type ($col, item_id) VALUES ($unit_id, $item_id) ");
            $result = $command->execute();
        } else {
            $command = $connection->createCommand("update user set money = money + $cost");
            $result = $command->execute();

            $command = $connection->createCommand("delete from inventory where $col = $unit_id and item_id = $item_id");
            $result = $command->execute();
        }
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Item model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        if (Yii::$app->request->post('act') == 'modal') {
            $this->view->params['uuid'] = Yii::$app->request->post('unit_id');
            return $this->renderPartial('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Item();
        $model->cost = 0;

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'img');

            if (isset($file)) {
                $filename = uniqid() . '.' . $file->extension;
                $path = 'images/' . $filename;

                if ($file->saveAs($path)) {
                    $model->img = $filename;
                }
            }

            if ($model->save()) {
                return $this->redirect('index');
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

//    public function actionCreate() {
//        $model = new Item();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('create', [
//                        'model' => $model,
//            ]);
//        }
//    }

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $oldFile = 'images/' . $model->img;
        $oldFileName = $model->img;

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'img');
            if (isset($file)) {
                if (file_exists($oldFile))
                    @unlink($oldFile);
                $filename = uniqid() . '.' . $file->extension;
                $path = 'images/' . $filename;
                if ($file->saveAs($path)) {
                    $model->img = $filename;
                }
            } else
                $model->img = $oldFileName;

            if ($model->save()) {
                return $this->redirect(['index']);
            }
        } else {
          
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

//    public function actionUpdate($id) {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('update', [
//                        'model' => $model,
//            ]);
//        }
//    }

    /**
     * Deletes an existing Item model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        @unlink('images/' . $model->img);

        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

//    public function actionDelete($id) {
//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
//    }

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
