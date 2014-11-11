<?php
namespace app\controllers;
//use yii\web\Controller;

use Yii;

//for ActiveRecord example
use app\models\CountryRecord;

// pager for actionArecord
use yii\data\Pagination;

class SayHelloController
    extends \yii\web\Controller
{
    // get started
    public function actionHelloWorld($messages = "Hello world")
    {
        return $this->render("index", ["received" => $messages]);
    }
    
    // working with forms
    public function actionBuildForm()
    {
        $model = new \app\models\EntryForm();
        
        //load data from post and validate it
        // $formName parament = "" if form element name != array (name != FormModel[name])
        if ($model->load(Yii::$app->request->get()) && $model->validate())
        {
            return $this->render("BuildFormShow", ["model" => $model]);
        }
        
        return $this->render("BuildForm", ["model" => $model]);
    }
    
    // working with ActiveRecord
    public function actionArecord()
    {
        // get all countries
        // find() returns ActiveQuery. 
        // all() = executes query and returns rows objects in array;
        $countries = CountryRecord::find()->orderBy("name")->all();
        $countries = CountryRecord::find();
        
        //find only one row according to primary key in the table
        $country = CountryRecord::findOne("US");
        
        //paginator
        $pages = new Pagination([
            "defaultPageSize" => 3,
            "totalCount" => $countries->count("code"),
        ]);
        
        $countries = $countries
                ->orderBy("name")
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        
        return $this->render("arecord", ["countries" => $countries, "pages" => $pages]);
        
        
        
        
        for ($cnt = 0; $cnt != count($countries); ++$cnt)
        {
            print $countries[$cnt]->name."<br>";
        }
    }
}