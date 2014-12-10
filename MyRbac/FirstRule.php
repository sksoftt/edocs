<?php
namespace app\MyRbac;

class FirstRule
    extends \yii\rbac\Rule
{
    
    public $name = "for_s";
    
    public function execute($user, $item, $params)
    {
        $username = \app\models\learn_user::findOne(["user_id" => $user]);
        $username = $username->user_name;
        
        if (($username != "slava" ) && ($username != "s"))
        {
            return false;
        }
        return true;
    }
}