<?php

namespace app\controllers\learning;

use yii\filters\AccessControl;

class FiltersController
    extends \yii\web\Controller
{
    public function behaviors()
    {
        parent::behaviors();
        return
        [
            [
                // класс фильтра
                "class" => "app\Components\Filters\Learn\TutorialFilter",
                
                // к каким действиям его применять "only" или "exept"
                "only" => ["filter-learn"], 
            ],
            
            "access" =>
            [
                "class" => AccessControl::className(),
                "rules" =>
                [
                    "allow" => true,
                    "roles" => "@",
                ],
            ],
        ];
    }
    
    public function actionFilterLearn($val = false)
    {
        return $this->render("NoErrors");
    }
    
    public function actionFilterError($message = null)
    {
        if($message == null)
        {
            return $this->renderPartial("BeforeError");
        }
    }
}