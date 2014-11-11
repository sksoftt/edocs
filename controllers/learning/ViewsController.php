<?php

namespace app\controllers\learning;

class ViewsController
    extends \yii\web\Controller
{
    public function init()
    {
        parent::init();
        $this->defaultAction = "view-tutorial";
    }

    public function actionViewTutorial()
    {
        return $this->render("view_tutorial");
    }
}