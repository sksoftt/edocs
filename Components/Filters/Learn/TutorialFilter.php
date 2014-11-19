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
        print \Yii::$app->view->renderFile("@app/views/learning/Filters/BeforeError.php");
        print $action->controller->render("BeforeError");
        return true;
        
    }
    
    public function afterAction($action, $result)
    {
        return parent::afterAction($action, $result);
    }
}