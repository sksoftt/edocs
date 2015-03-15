<?php

namespace app\controllers\learning;

class DBActiveRecordController
    extends \yii\db\ActiveRecord
{
    /*
     * Active Record расширяется от класса DB/Query
     * А значит поддерживает все его функции. В том числе и возможность 
     * составлять запрос из функций, как и в QueryBuilder
     */
    
    /*
     * ВАЖНО: аттрибуты полей класс добавит самостоятельно
     * выбрав их мз указанной таблицы. НЕЛЬЗЯ определять их самостоятельно.
     */
    
    const CONSTANT = "This is the constant value";


    // обязательно необходимо переопределить эту функцию.
    // она должна вернуть имя таблицы с которой булет работать данный Active Record класс
    public static function tableName()
    {
        return "tableName";
    }
    
    // функция для переопределения подключения к БД.
    // нужно для тех случаев, когда используются несколько БД.
    public static function getDb()
    {
        return \YII::$app->db;
    }

    public function actionQueringData()
    {
        // SELECT * FROM tableName WHERE id = 123
        $customer = self::find()->where(["id" => 123])->one();
        
        // Хорошая практика использовать константы, а не значения.
        $customer = self::find()->where(["status" => self::CONSTANT])->all();
        
        $customer = self::find()->where($condition)->all();
        
        $customer = self::find()->where($condition)->count();
    }
    
    
    public function actionAccessingData()
    {
        /*
         * Доступ к полям объекта происходит как и к обычным свойствам.
         * 
         * НЕЛЬЗЯ самому определять свойства объекта. Они определятся автоматически.
         */
        $this->id;
    }
    
    public function actionSavingData()
    {
        // Сохранение данных произврдится по средствам
        // присвоения данных к свойствам AR объекта и задействования функции save()
        
        $customer = new \yii\db\ActiveRecord();
        $customer->name = "Slava";
        $customer->save();
        
        //если объект новый, то метод save() добавит новую строчку в БД.
        // если объект получен из запроса SQL то произведется его обновление update.
        // Проверить новый ли объект или полученный от запроса можно посредствам
        // свойства getIsNewRecord
        // однако, можно вызвать функции insert() update() напрямую.
    }
}

























