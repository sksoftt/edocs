<?php

namespace app\controllers;

use Yii;

class HelloController
    extends yii\base\Controller
{
    private $users_model;
    
    function actionIndex()
    {
        if (\Yii::$app->user->isGuest())
        {
            
        }
    }
}