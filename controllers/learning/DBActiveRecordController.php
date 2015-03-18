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
        // Сохранение данных произврдится   по средствам
        // присвоения данных к свойствам AR объекта и задействования функции save()
        // функция save() АВТОМАТИЧЕСКИ вызвает проверку (validate())
        
        $customer = new \yii\db\ActiveRecord();
        $customer->name = "Slava";
        $customer->save();
        
        //если объект новый, то метод save() добавит новую строчку в БД.
        // если объект получен из запроса SQL то произведется его обновление update.
        // Проверить новый ли объект или полученный от запроса можно посредствам
        // свойства getIsNewRecord
        // однако, можно вызвать функции insert() update() напрямую.
    }
    
    /*
     * ПРИСВОЕНИЯ ДАННЫХ
     */
    public function massiveAssignment()
    {
        // AR поддерживает масивное присвоение аргументов.
        // работает точно также как и в обычных моделях.
        // т.е. присвоение производится только безопасным аттрибутам - 
        // тем, которые перечилсены в сценарии scenario()
        // или те, которые упомянаются в правилах rules()
        $ar = new \yii\db\ActiveRecord();
        $ar->attributes = $values;
        
        
        // UPDATE AR_table set counter = counter + 2
        // функция используется для предотвращения неверных результатов в случаях,
        // когда один и тот же счетчик может быть обновлен одновременно несколькими пользователями.
        $ar->updateCounters(["counter" => 2]);
        
        // UPDATE `customer` SET `age` = `age` + 1
        Customer::updateAllCounters(['age' => 1]);
        
        // обновление нескольких строк одновременно
        // UPDATE `customer` SET `status` = 1 WHERE `email` LIKE `%@example.com`
        Customer::updateAll(['status' => Customer::STATUS_ACTIVE], ['like', 'email', '@example.com']);
        
    }
    
    public function transaction()
    {
        // транзакции используются для того, чтобы иметь возможность вернуть Бд 
        // в прежднее состояние если в цепочке запросов произошла ошибка. 
        // Есть 2 способа использовать Транзакции.
        
        $transaction = $this->getDb()->beginTransaction();
        
        try
        {
            $this->find()->where(["field" => "value"])->all();
            // другие запросы
            
            // если все удалось, то "сохраняем"
            $transaction->commit();
        }
        catch (Exception $ex)
        {
            $transaction->rollBack();
            throw $ex;
        }
    }
    
    //второй способ использовать Транзакции
    // переопределить функцию transaction()
    public function transactions()
    {
        return
        [
            "scenario_name" => self::OP_DELETE | self::OP_UPDATE,
        ];
    }
}

























