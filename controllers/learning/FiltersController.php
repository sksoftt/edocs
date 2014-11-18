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
                "class" => "app\Components\Filters\Learn\TutorialFilter",
                "only" => ["filter-learn"],
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