<?php

namespace app\controllers\learning;

class ViewsController
    extends \yii\web\Controller
{
    public $message;
    public function init()
    {
        parent::init();
        $this->defaultAction = "view-tutorial";
        $this->message = "Controller message.";
    }

    public function actionViewTutorial()
    {
        return $this->render("view_tutorial");
    }
}