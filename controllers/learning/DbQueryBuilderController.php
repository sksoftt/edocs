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
        
        //кроме того массивы могут содержать такие выражения как AS или подзапросы.
        $subQuery = $queryBuilder->select("COUNT(*)")->from("querybuilder");
        
        // Тоже самое что и 
        // SELECT Id as user_id, (SELECT COUNT(*) FROM querybuilder) AS Count FROM querybuilder
        $query = $queryBuilder->select(["user_id" => "Id", "Count" => $subQuery]);
    }
}