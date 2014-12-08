<?php
namespace app\controllers\learning;

use app\models\learn_user;

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
        $us = \Yii::$app->user;
        $guest = \Yii::$app->user->isGuest;
        if (\Yii::$app->user->isGuest)
        {
            if (!$model->load(\Yii::$app->request->post()) || !$model->validate())
            {
                return $this->render("login", ["model" => $model]);
            }
            $model->findOne($model->user_name);
            // $user = learn_user::findByName($model->user_name);
            
            $user = $model->findByName();
            
            
            
            $atr = $user->getAttributes();
            
            $id = $model->getId();
            
            
//            $user->user_id = $user->attributes;
            $id = $user->getId();
            $id = $user->user_id;
            
           // $user->user_id = 1;
            //$user->user_name = "s";
            
            
            $login = \Yii::$app->user->login($user, 3600000);
            return $this->goHome();
        }
    }
    
    public function actionLogout()
    {
        \Yii::$app->user->logout();
    }
}