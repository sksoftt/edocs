<?php

namespace app\models;

//the main difference between model and ActiveRecord is
// the class ActiveRecord works with spec table
// and model = creates SQL query
class CountryRecord
    extends \yii\db\ActiveRecord
{
    // assocci
    public static function tableName()
    {
        // associate with table "country"
        // needed if the name of the class do not match with table name
        return "country";
        
    } 
}
