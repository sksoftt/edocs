<?php
namespace app\MyRbac;

class ThirdRule
    extends \yii\rbac\Rule
{
    public $name = "thirdRule";
    
    public function execute($user, $item, $params)
    {
        $cnt = 1;
        $cnt++;
        return true;
    }
}