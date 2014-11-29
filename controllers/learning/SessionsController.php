<?php
/*
 * Пример использования сессий.
 */

namespace app\controllers\learning;

class SessionsController
    extends \yii\web\Controller
{
    public function actionRequests()
    {
        $request = \Yii::$app->request;
        
        $request->get(); //  = $_GET;
        $request->get("id"); // $_GET["id"];
        
        // возвращает true / false
        $request->isAjax;
        $request->isGet;
        $request->isPost;
        
        
    }

    public function actionЫуыышщты()
    {
        $session = \Yii::$app->session; //получаем объект с сессиями
        
        $session->set("slava", "This is session value"); //установка сессии
        //
        // закрывает сессию, но при использовании get / set сессия открывается автоматически
        $session->close(); 
        $res = $session->get("slava"); //получение данных с сессии.
        
        $session->remove("slava");
        
        // ввиду ограничений эти две строки работать не будут.
        $session["slava"]["name"] = "slava";
        $session["slava"]["last_name"] = "bla bla bla";
        
        // а это рабочий код.
        $session["slava"] = 
        [
            "name" => "slava",
            "'ast_name" => "bla bla bla",
        ];
        
        // или
        
       $slava = $session["slava"];
       $slava["name"] = "sds";
       $slava["last_name"] = "ghfgh";
        
        print $session["slava"]["name"]; //этот кодж будет работать.
    }
}