<?php

namespace app\actions;

class ActionTutorial
    extends \yii\base\Action
{
    public $v;
    public $page_title;


    public function beforeRun()
    {
        //parent::beforeRun();
        $cnt = 1;
        return true; // return true to continue the action
    }


    /*
     *  run - this is necessary function When action implements by class (Satndalone action)
     * function run() become MIAN function
     */

        // action get parameters as every other function
    public function run($param = "Nothing")
    {
        // render view of controller that called the Standalone action
        return $this->controller->render("index", ["message" => $param]);
    }
   
    public function afterRun()
    {
        parent::afterRun();
        $cnt = 2;
    }
}