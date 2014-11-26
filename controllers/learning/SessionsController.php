<?php
/*
 * Пример использования сессий.
 */

namespace app\controllers\learning;

class SessionsController
    extends \yii\web\Controller
{
    public function actionIndex()
    {
        $session = \Yii::$app->session;
        
        $res = $session->set("slava", "This is session value");
        $session->close();
        $res = $session->get("slava");
    }
}