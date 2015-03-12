<?php

namespace app\controllers\learning;

class DbQueryBuilderController 
    extends \yii\web\Controller
{
    public function actionIndex()
    {
        print "This is DbQueryBuilder Controller";
        return;
    }
    
    public function actionSelect()
    {
        //Создаем объект который и будет строить все запросы или команды.
        $queryBuilder = new \yii\db\Query();
        
        //две эквивалентные части кода
        $result = $queryBuilder->select("Id, name")->from("querybuilder")->all();;
        
        // вторая эквивалентная часть кода.
        $query = $queryBuilder->select("Id, name")->from("querybuilder");
        $command = $query->createCommand();
        $result = $command->queryAll();
        
        //Лучше использовать массив в функции SELECT потому как выражения SELECT могут быть
        // разделены запятыми
        $queryBuilder->select(["Id", "name"]);
        
        //SELECT user.id AS user_id
        $queryBuilder->select(["user_id" => "user.Id"]);
        
        //кроме того массивы могут содержать такие выражения как AS или подзапросы.
        $subQuery = $queryBuilder->select("COUNT(*)")->from("querybuilder");
        
        // Тоже самое что и 
        // SELECT Id as user_id, (SELECT COUNT(*) FROM querybuilder) AS Count FROM querybuilder
        $query = $queryBuilder->select(["user_id" => "Id", "Count" => $subQuery]);
        
        //Add DISTINCT
        $queryBuilder->select(["name"])->distinct();
    }
    
    public function actionFrom()
    {
        // SELECT FROM table.column c
        (new \yii\db\Query)->select($columns)->from(["column c"]);
        
        // SELECT FROM table.column c
        (new \yii\db\Query)->select($columns)->from(["c" => "column"]);
        
        // Помимо прочего, вместо таблиц можно записывать и подзапросы
        $subQuery = (new \yii\db\Query)->select(["t.id"])->from(["t" => "table name"]);
        (new \yii\db\Query)->select($columns)->from(["table" => $subQuery]);
    }
    
    public function actionWhere()
    {
        // законное выражение, но НИКОГДА НЕ ИСПОЛЬЗУЕТСЯ.
        // плохая практика вставлять данные через переменные
        // поскольку Запрос становится уязвимым к внедрению SQL вредоноского кода.
        (new \yii\db\Query)->select(["column"])->from(["t" => "table"])
        ->where(["status" => $status]);
        
        // экранирует возможный SQL запрос
        (new \yii\db\Query)->where(["status" => ":status"], [":status" => $status]);
        
        // добавление AND и OR через функции
        (new \yii\db\Query)->orWhere($condition)->andWhere($condition);
        
        // where(["operator", "operand1", "operand2", ....]);
        (new \yii\db\Query)->where(["and", "id=1", "id = 2", "id = 3"]);
        
        // SELECT... WHERE id = 1 AND (name = slava OR name = GP)
        (new \yii\db\Query)->where(["and", "id=1", ["or", "name = slava", "name = GP"]]);
    }
    
    public function actionOrderBy()
    {
        (new \yii\db\Query)->orderBy("id ASC")->addOrderBy("name DESC");//string|array
    }
    
    public function actionGroupBy()
    {
        (new \yii\db\Query)->groupBy(["id", "name"]); //string|array
        
        $query->having(['status' => 1])
              ->andHaving(['>', 'age', 30]);
    }
    
    public function actionJoin()
    {
        // join($type, $table, $on);
        (new \yii\db\Query)->join("INNER JOIN", "table name", "table.filed= secTable.field");
        
        
        (new \yii\db\Query)->leftJoin($table, $on);
        (new \yii\db\Query)->leftJoin(["t" => "table"], "t.field = otherTable.field");
    }
    
    public function actionIndexing()
    {
        // Результатом выполнения запроса является массив с выбранными данными.
        // массив индексируется обычным каунтером 0, 1, 2, 3, 4, 5....
        // но это индексирование можно изменить.
        
        (new \yii\db\Query)->indexBy($column);
        
        // а этой анонимной функии $row представляет собой массив текущей строки
        (new \yii\db\Query)->indexBy(function ($row)
        {
            return $row["Id"].$row["username"];
        });
    }
    
    public function actionBatch()
    {
        $query = (new \yii\db\Query)->from(["user_table"]);
        
        // foreach($query->batch($batchSize) as $key => $value)
        foreach ($query->batch($batchSize) as $user)
        {
            //здесь $user получает по 100 "строчек" по умолчанию
        }
        
        // foreach($query->each($batchSize) as $key => $value)
        foreach ($query->each() as $user)
        {
            // этот метод вернет каждого пользователя в $user
        }
    }
}


























