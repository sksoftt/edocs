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
        
        // добавление и экранирование параметров.
        // должнобыть использовано практически всегда для предотвращения
        // внедрение в БД и выполнения несанкционированных команд.
        
        $command = \yii::$app->db;
        $command->crteateCommand("SELECT * FROM tale WHERE Id = :id AND status = :status")
        ->bindValue([":id", \yii::$app->request->get("id")])
        -> bindValue([":status", "this is the status value"])
        ->queryOne();
        
        //точно также можно использовать bindParam()
        // В этом случае переменная передается по ссылке. Т.е. можно изменять
        // только ее и получать разные результаты той же команды.
        
        $params = [":id" => $_GET["id"], ":status" => "This is the status"];
        $command->createCommand("SELECT * FROM table WHERE id = :id AND status = :status")
        ->bindValues($params);
        
        // используется в тех случаях, когда не нужно возвращать значение
        // например, UPDATE, INSERT, DELETE
        $count = $command->execute();
        
        $connection->createCommand()->insert("table_name", ["field_name" => "value",])->execute();
        
        $connection->createCommand()->update("table_name", ["field" => "value"], "condition_field < cond_value")
        ->execute();
        
        $connection->createCommand()->delete("table_name", "cond_field = cond_value")->execute();
        
        // экранирование имен таблиц и столбцов.
        // [[TableName]] {{%columnName}}
        // % будет заменен на префикс если он определен.
    }
}