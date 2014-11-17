<?php
namespace app\MyFilters;

class TutorialFilter
    extends \yii\base\ActionFilter
{
    public function beforeAction($action)
    {
        
        return false;
    }
    
    public function afterAction($action, $result)
    {
        parent::afterAction($action, $result);
    }
}