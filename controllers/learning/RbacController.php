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
        
        $authManager = new \yii\rbac\DbManager();
        
        $createPost = $authManager->createPermission("createPost");
        $createPost->description = "Gives permission to user create new posts";
        $authManager->add($createPost);
        
        $updatePost = $authManager->createPermission("updatePost");
        $updatePost->description = "Gives to user permission to update created posts";
        $authManager->add($updatePost);
        
        $author = $authManager->createRole("author");
        $authManager->add($author);
        $authManager->addChild($author, $createPost);
        
        $admin = $authManager->createRole("admin");
        $authManager->add($admin);
        $authManager->addChild($admin, $updatePost);
        $authManager->addChild($admin, $author);
        
        
    }
    
    public function actionFuncs()
    {
        $authManager = new \yii\rbac\DbManager();
        
        $var = $authManager->getRole("admin");
        
        $stamRole = $authManager->createRole("stamRole");
        $stamRole->description = "This is role for trying";
        
        if($authManager->getRole("stamRole") == null)
        {
            $authManager->add($stamRole);
        }
        
        $authManager->remove($stamRole);
        
        $user_id = \Yii::$app->user->id;
        $user_roles = $authManager->getRolesByUser($user_id); // возвр. массив с ролями и разрешениями
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
        
    }
    
    
}


















