<?php
/*
 * Прежде всего необходимо выбрать менеджер в настройках приложения.
 * 'authManager' => [
            'class' => 'yii\rbac\PhpManager', // ведет записи в файлах.
            "class" => "yii\rbac\DbManager", // ведет записи в БД. Схему можно найти в папке migrations
            'defaultRoles' => ['guest'],
        ],
 */

namespace app\controllers\learning;


class RbacController
    extends \yii\web\Controller
{
    // функция устанавливает разрешения(permissions) и роли (Roles)
    public function actionInit()
    {
        $authManager = \Yii::$app->authManager;
        
        // класс необязательно брать из конфигурации приложения, для сохранения автокомплита
        // единственная разница состоит в том, что можно ошибиться в том случае если используется PHPManager
        $authManager = new \yii\rbac\DbManager(); 
        
        // Создание и запись в БД нового разрегения.
        $createPost = $authManager->createPermission("createPost");
        $createPost->description = "Gives permission to user create new posts";
        $authManager->add($createPost);
        
        $updatePost = $authManager->createPermission("updatePost");
        $updatePost->description = "Gives to user permission to update created posts";
        $authManager->add($updatePost);
        
        // содание и запись в  БД новой роли.
        $author = $authManager->createRole("author");
        $authManager->add($author);
        // присвоение роли разрегения.
        $authManager->addChild($author, $createPost);
        
        $admin = $authManager->createRole("admin");
        $authManager->add($admin);
        $authManager->addChild($admin, $updatePost);
        
        // админ получает все разрешения автора.
        $authManager->addChild($admin, $author);
        
        
    }
    /*
     * Функция для обучения и проверки функциональности
     */
    public function actionFuncs()
    {
        $authManager = new \yii\rbac\DbManager(); 
        
        // получает объект роли.
        $var = $authManager->getRole("admin");
        
        $stamRole = $authManager->createRole("stamRole");
        $stamRole->description = "This is role for trying";
        
        if($authManager->getRole("stamRole") == null)
        {
            $authManager->add($stamRole);
        }
        
        // удаляем роль.
        // $authManager->remove($stamRole); 
        
        $user_id = \Yii::$app->user->id;
        $user_roles = $authManager->getRolesByUser($user_id); // возвр. массив с Ролями и Разрешениями
        if(!isset($user_roles["admin"]))
        {
            $adminRole = $authManager->getRole("admin");
            $authManager->assign($adminRole, $user_id);
        }
        
        $updatePost = $authManager->getPermission("updatePost");
        
        if(!isset($user_roles["updatePost"]))
        {
            $authManager->assign($updatePost, $user_id);
        }
        
        /*
         * работа с правилами
         * проверка иерархии.
         */
        $rules = $authManager->getRules();
        
        // создается правило, если его не существует.
        // правило - только для пользователей которых зовут "s" или "slava"
        if (!isset($rules["for_s"]))
        {
            $rule = new \app\MyRbac\FirstRule();
            $authManager->add($rule);
        }
        
        // создается правило, если его не существует.
        // правило - только для пользователей ID  которого = "1"
        if (!isset($rules["only_admin"]))
        {
            $rule = new \app\MyRbac\SecondRule();
            $authManager->add($rule);
        }
        
        $rules = $authManager->getRules();
        if (!$registrated = $authManager->getPermission("registrated"))
        {
            $registrated = $authManager->createPermission("registrated");
            $registrated->description = "Action for only users with S name";
            $registrated->ruleName = $rules["for_s"]->name;
            $authManager->add($registrated);
        }
        
        if (!$adminOnly = $authManager->getPermission("adminOnly"))
        {
            $adminOnly = $authManager->createPermission("adminOnly");
            $adminOnly->description = "Action can be done only by user with ID = 1";
            $adminOnly->ruleName = $rules["only_admin"]->name;
            $authManager->add($adminOnly);
        }
        
        $permissions = $authManager->getPermissions();
        if (isset($permissions["registrated"]) && isset($permissions["adminOnly"]))
        {
            $registrated = $permissions["registrated"];
            $adminOnly = $permissions["adminOnly"];
            
            // при проверки Разрешений $adminOnly будет проверяться и правила $registrated
            $authManager->addChild($registrated, $adminOnly);
            
            $stamRole = $authManager->getRole("stamRole");
            
            /***************************************************
             * ВАЖНО!! Механизм наследования Разрешений и Правил
             **************************************************/
            
            /*
             * Наследование Разрешений и Ролей происходит от Сына к Отцу.
             * в примере мы использовали $authManager->addChild($registrated, $adminOnly);
             * т.е. Роль обладающая Разрешением $registrated будет обладать и Разрешением $adminOnly,
             * но не наоборот. Т.е. если бы мы назначили Роли другое
             *  Разрешение: $authManager->addChild($stamRole, $adminOnly), а не
             * $authManager->addChild($stamRole, $registrated);
             *  То при вызове user->can(registrated)
             * Все время выдавало бы false так как Разрешение не было назначено Роли.
             * 
             * 
             * Вместе с темнаследование Правил (rules) проходит по обычному механизму наследования классов.
             * Т.е. При вызове $authManager->addChild($registrated, $adminOnly);
             * user->can("registrated"adminOnly") будет происходить проверка Правил всех отцов.
             */
            
            // В случае $authManager->addChild($stamRole, $adminOnly);
            // несмотря на то, что $registrated - отец, а $adminOnly сын
            // у пользователей Роли $stamRole Разрешение $registrated при проверке \Yii::$app->user->can("adminOnly")
            // все время будет выдавать false
            // так как роли оно не назначено. 
            
            // При првоерки Разрешения $adminOnly для пользователей Роли $stamRole
            // будет проверяться и правило $registrated, 
            // так как $adminOnly унаследовано от $registrated
            $authManager->addChild($stamRole, $registrated);
            $authManager->assign($stamRole, "1");
            $authManager->assign($stamRole, "2");
            $authManager->assign($stamRole, "3");
        }   
    }
    
    public function actionHierarchyCheck()
    {
        $can = \Yii::$app->user->can("adminOnly", ["array" => "for params"]);
        if ($can)
        {
            print "Can";
            exit;
        }
        print "Can not";
    }
    
    
}


















