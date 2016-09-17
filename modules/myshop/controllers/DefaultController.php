<?php
namespace app\modules\myshop\controllers;

use Yii;
use app\modules\myshop\models\SignupForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Default controller for the `myshop` module
 */
class DefaultController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        $this->view->registerCssFile('css/style.css');
        return $this->render('index');
    }

    // Всплывшее модальное окно заполняем представлением signup.php формы с полями
    public function actionSignup() {
        $model = new SignupForm();
        //  $model = new \app\models\SignupForm();
        //$model->id =$id;
        return $this->renderPartial('signup', [
                    'model' => $model,
        ]);
    }

// По нажатию в модальном окне на Отправить - форма отправляется администратору на почту     
    public function actionSubmitsignup() {
        $model = new SignupForm();
        $model->load(Yii::$app->request->post());

        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {

            //save the password
            $success = true;
            return json_encode($success);
        } else {
            return $this->renderPartial('signup', [
                        'model' => $model,
            ]);
        }
    }

}
