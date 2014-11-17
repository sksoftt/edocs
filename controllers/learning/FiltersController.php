<?php

namespace app\controllers\learning;

class FiltersController
    extends \yii\web\Controller
{
    public function behaviors()
    {
        parent::behaviors();
        return
        [
            [
                "class" => "app\MyFilters\TutorialFilter",
                "only" => ["filter-learn"],
            ],
        ];
    }
    
    public function actionFilterLearn($val = false)
    {
        print "Received value: ".$val;
    }
}