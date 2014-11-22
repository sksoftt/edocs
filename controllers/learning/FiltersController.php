<?php

namespace app\controllers\learning;

use yii\filters\AccessControl;

class FiltersController
    extends \yii\web\Controller
{
    public function behaviors()
    {
//        parent::behaviors();
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
                'class' => \yii\filters\AccessControl::className(),
                "only" => ["act1"],
                "rules" =>
                [
                    [
                        "allow" => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            
            [
                "class" => AccessControl::className(),
                "only" => ["act2"],
                "rules" =>
                [
                    [
                        "allow" => true,
                        "roles" => ["?"],
                    ],
                    
                ],
            ]
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
    
    public function actionAct1()
    {
        return $this->render("PrintMessages", ["messages" => "This is First action function"]);
    }
    
    public function actionAct2()
    {
        return $this->render("PrintMessages", ["messages" => "This is Second action function."]);
    }
    
    
}