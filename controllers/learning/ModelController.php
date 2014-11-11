<?php
namespace app\controllers\learning;

use Yii;

class ModelController
    extends \yii\web\Controller
{
    public $title;
    public function actionModelValidateTutorial()
    {
        $model = new \app\models\tutorial\MdlTutorial();
        $model->scenario = "scenario_validate";
        
        $post = Yii::$app->request->post("MdlTutorial");
        
        
        if (empty($post))
        {
            return $this->render("BuildForm", ["model" => $model]);
        }
        
        $model->attributes = $post;
    }
}