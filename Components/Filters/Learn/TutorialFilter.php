<?php
namespace app\components\filters\learn;

use yii\base\InlineAction;

class TutorialFilter
    extends \yii\base\ActionFilter
{
    public function beforeAction($action)
    {
        parent::beforeAction($action);
        
        // invoke render view - but only this file, without 
//        print \Yii::$app->view->renderFile("@app/views/learning/Filters/BeforeError.php");
        
        //запускает от имени контроллера рендеринг вида
        // не разрушает layout
        print $action->controller->render("@app/views/learning/Filters/BeforeError.php");
        
        //если вернет false, то действие не будет выполнено.
        return false;
        
    }
    
    
    public function afterAction($action, $result)
    {   //проверить, что включает в себя результат (возможно дейтсвия)
        return parent::afterAction($action, $result);
    }
}