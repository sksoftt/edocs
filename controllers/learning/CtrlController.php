<?php

// if controller present in sub-folder it have to be reflected in nam,namespace
namespace app\controllers\learning;

class CtrlController
    extends \yii\web\Controller
{
    public $v;
    public $page_title;
   
    public $mess;
    public $defaultAction = "default"; //set default action




    // this function should be used besides cunstructor
    public function init()
    {
        parent::init();
        $this->mess = "Yes it is.";
       
        $this->defaultAction = "default"; //set default action from init function (same thing)
    }
   
    public function actionDefault()
    {
//        print "This is Controller tutorial.";
        $message = "This is Controller tutorial rendered with view: ";
        $message .= "views/learn/ctrl";
        return $this->render("index", ["message" => $this->mess]);
    }
   
    public function actions()
    {
        return
        [
            "actionClass" => "app\actions\ActionTutorial",
        ];
    }
}