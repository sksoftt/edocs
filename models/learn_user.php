<?php

namespace app\models;

class learn_user
extends yii\db\ActiveRecord
implements \yii\web\IdentityInterface
{
    
    public $id;
    public $auth_key;
    
    public $user_name;
    public $email;
    public $password;
    public $status;
    public $role;






    /*
     * Воспроизводит функции интерфейса
     */
    
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function findIdentity($id)
    {
        return static::findOne(["id" => $id]);
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
        return "learn_user";
    }
}