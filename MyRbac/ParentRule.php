<?php
namespace app\MyRbac;

class ParentRule
    extends \yii\rbac\Rule
{
    public $name = "parentRule";
    
    public function execute($user, $item, $params)
    {   
        $username = \Yii::$app->user->identity->user_name;
        if ($username == "parent" || $username == "child")
        {
            return true;
        }
        return false;
    }
}