<?php

namespace app\models;

class learn_user
extends \yii\db\ActiveRecord
implements \yii\web\IdentityInterface
{
    
    public $user_id;
    public $auth_key;
    
    public $user_name;
    public $user_email;
    public $user_password;
    public $user_status;
    
    public function rules()
    {
        return
        [
            [["user_name", "user_email", "user_password"], "required"],
            [["user_email"], "email"],
        ];
    }

    /*
     * Воспроизводит функции интерфейса
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    
    public function getId()
    {
        return $this->user_id;
    }
    
    public static function findIdentity($id)
    {
        return static::findOne(["user_id" => $id]);
    }
    
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(["access_token" => $token]);
    }
    
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() == $authKey;
    }
    
    public static function tableName()
    {
        return "users";
    }
}