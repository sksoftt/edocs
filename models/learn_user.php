<?php
/*
    @property string $id;
    @property integer $user_id;
    @property string $auth_key;
    
    @property string $user_name;
    @property string $user_email;
    @property string $user_password;
    @property string $user_status;
     * 
     */
namespace app\models;

class learn_user
extends \yii\db\ActiveRecord
implements \yii\web\IdentityInterface
{
    
    
    
    // yii::$app->user  обращается к свойству username
    // поэтому оно должно быть инициализированно
    // либо воспроизведено через функцию getUsername()
    //public $username;
    
    public function rules()
    {
        return
        [
//            [["user_name", "user_email", "user_password"], "required"],
//            [["user_email"], "email"],
            [["user_name"], "required"],
        ];
    }
    
    public function getUser_id()
    {
        return $this->user_id;
    }
    
    public function setUser_id($val)
    {
        $this->getId();
    }
    
    public function getUsername()
    {
        return $this->user_name;
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
    
    public function findByName($usename = null)
    {
        if ($usename == null)
        {
            return $this->findOne(["user_name" => $this->user_name]);
        }
        
        return static::findOne(["user_name" => $usename]);
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