<?php
namespace app\models;

//модель родитель классов не относящихся к определенной таблице.
// в отличие от класса ActiveRecord который родительским классом для моделей
//  относящихся к определенной таблеце в БД.
use \yii\base\Model;

class EntryForm
    extends \yii\base\Model 
{
    public $name;
    public $email;
    public $title;
    
    function rules()
    {
        return
        [
            [["name", "email"], "required"],
//            ["email", "email"],
        ];
    }
}