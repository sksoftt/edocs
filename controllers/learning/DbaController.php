<?php

/*
 * Learining how to work with DataBase Access Controller
 */

namespace app\controllers\learning;
class DbaController
    extends \yii\web\Controller
{
    public function actionBasic()
    {
        // Принимаем соединение с БД. Возвращаямый объект используется
        // для создания команд SQL
        $connection = \Yii::$app->db;
        
        
        $command = $connection->createCommand("SELECT * FROM USERS WHERE user_id = 156");
        
        $users = $command->queryAll(); // возвращает массив данных или пустой массив
        $users = $command->queryOne(); // возвращает одиночный массив или false
        
        $command = $connection->createCommand("SELECT COUNT(u.user_id) FROM USERS u WHERE user_id = 156");
        $count = $command->queryScalar(); //Возвращает только число, на случай если не нужно возвращать массив с данными.
        
        // используется в тех случаях, когда не нужно возвращать значение
        // например, UPDATE, INSERT, DELETE
        $count = $command->execute();
        
        $connection->createCommand()->insert("table_name", ["field_name" => "value",])->execute();
        
        $connection->createCommand()->update("table_name", ["field" => "value"], "condition_field < cond_value")
        ->execute();
        
        $connection->createCommand()->delete("table_name", "cond_field = cond_value")->execute();
        
    }
}