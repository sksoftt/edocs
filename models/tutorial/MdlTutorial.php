<?php

namespace app\models\tutorial;

class MdlTutorial
    extends \yii\base\Model
{
    public $title;
    // define model attributes
    public $code;
    public $name;
    public $population;
   
    //this function sets labels for input and output
    public function attributeLabels()
    {
        // return different label according to different scenario (my guess - need to check it)
        if ($this->scenario == "some scenario")
        {
            return
            [
               
            ];
        }
        
        
        return
        [
            "code" => "Enter the code of the country",
            "name" => "Country name",
            "population" => "Country's popuation",
        ];
    }
   
    // this function set new additional scenario
    public function scenarios()
    {
        $present_scenarios = parent::scenarios();
       
        // in each scenario we deside wich attributes  will be open for massive assigment
        // for example: during registration we would like some attributes
        // will be modefiable only by administration
        $present_scenarios["scenario name"] = ["list", "of", "attributes",];
        
        // в сценарии указываются поля которые будут учавствовать в масовом присваивании
        // и валидации. Те поля, которые не указаны - не учавствуют в массовом
        // в массововом присваивании $model->attributes + $model->load
        // и валидации, даже если для них установлено правило.
        //
        $present_scenarios["scenario_validate"] = ["code", "name", "population"];
        
        // Все три поля будут подвержены проверке.
        // Но только ко двум из них будет применено массовое присвоение
        //
        $present_scenarios["secret"] = ["code", "name", "!secret"];
        return $present_scenarios;
    }
   
    //et validation rules
    public function rules()
    {
        return
        [
            [["code", "population", "name"], "required", "on" => "scenario_validate"],
           
            // email field runs email validator
            ["population", "email",],
        ];
    }
   
}