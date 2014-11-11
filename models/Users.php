<?php
namespace app\models;

class Users
    extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return "users";
    }
}