<?php
namespace app\controllers\learning;

class RbacController
    extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render("index");
    }
    
    public function actionLoginUser()
    {
        $model = new \app\models\learn_user();
        
        if (\Yii::$app->user->isGuest && (!$model->load(\Yii::$app->request->post()) || !$model->validate()))
        {
//            \Yii::$app->user->login($model, (3600));
            return $this->render("login", ["model" => $model]);
        }
        
        return $this->goHome();
    }
}