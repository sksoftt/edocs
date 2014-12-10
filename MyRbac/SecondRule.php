<?php

namespace app\MyRbac;


/*
 * only user with id 1 can proceed the action
 */
class SecondRule
    extends \yii\rbac\Rule
{
    public $name = "only_admin";

    public function execute($user, $item, $params)
    {
       if ($user == "1")
       {
           return true;
       }
       return false;
    }
}