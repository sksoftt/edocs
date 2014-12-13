<?php
namespace app\controllers\learning;

use app\models\learn_user;

class UserController
    extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render("index");
    }
    
    public function actionLoginUser()
    {
        // необходимо прописать в настройках web.php
        // 'identityClass' => 'app\models\learn_user',
        
        $url = \yii\helpers\BaseUrl::previous();
        $model = new \app\models\learn_user();
        
        $guest = \Yii::$app->user->isGuest;
        
        if (!\Yii::$app->user->isGuest)
        {
            return $this->logout();
        }
        if (\Yii::$app->user->isGuest)
        {
            // загружаем модель и проверяем ее
            if (!$model->load(\Yii::$app->request->post()) || !$model->validate())
            {   //если не прошло, то вызываем форму логина.
                return $this->render("login", ["model" => $model]);
            }
            
            // если полученные данные от формы корректны
            // производим поиск из БД
            $user = $model->findByName($model->user_name);
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
    
    public function logout()
    {
        return $this->render("logout");
    }
    
    public function actionPreviousPage()
    {
        $url = \yii\helpers\BaseUrl::previous();
        \Yii::$app->getUser()->setReturnUrl(\yii\helpers\BaseUrl::previous());
        return $this->goBack();
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();
        $this->goHome();
    }
}