<?php
/*
 * RBAC second
 * Еще раз идет отточка RBAC, в особенности поведение наследуемых Разрешений и Ролей.
 */

namespace app\controllers\learning;
class RbacsController
    extends \yii\web\Controller
{
    public function actionInit()
    {
        $authManager = new \yii\rbac\DbManager();
        
        //get rules
        $rules = $authManager->getRules();
        if (!isset($rules["parentRule"]))
        {
            $parentRule = new \app\MyRbac\ParentRule();
            $authManager->add($parentRule);
        }
        
        if (!isset($rules["childRule"]))
        {
            $childRule = new \app\MyRbac\ChildRule();
            $authManager->add($childRule);
        }
        
        $parentRule = $authManager->getRule("parentRule");
        $childRule = $authManager->getRule("childRule");
        
        $parentPermission = $authManager->createPermission("parentPermission");
        if(!$authManager->getPermission("parentPermission"))
        {
            $parentPermission->description = "This is a parent permission";
            $parentPermission->ruleName = $parentRule->name;
            $authManager->add($parentPermission);
        }
        
        if (!$authManager->getPermission("childPermission"))
        {
            $childPermission = $authManager->createPermission("childPermission");
            $childPermission->ruleName = $childRule->name;
            $childPermission->description = "This is a child permission";
            $authManager->add($childPermission);
        }
        
        $parentPermission = $authManager->getPermission("parentPermission");
        $childPermission = $authManager->getPermission("childPermission");
        
        if (!$authManager->hasChild($parentPermission, $childPermission))
        {
            $authManager->addChild($parentPermission, $childPermission);
        }
    }
    
    public function actionInitRoles()
    {
        $rbac = new \yii\rbac\DbManager();
        
        $roles = $rbac->getRoles();
        
        if (!isset($roles["parentRole"]))
        {
            $parentRole = $rbac->createRole("parentRole");
            $parentRole->description = "Parent role";
            $rbac->add($parentRole);
            
            $parentPermission = $rbac->getPermission("parentPermission");
            $rbac->addChild($parentRole, $parentPermission);
        }
        
        if(!isset($roles["childRole"]))
        {
            $childRole = $rbac->createRole("childRole");
            $childRole->description = "This is the child role";
            $rbac->add($childRole);
            
            $rbac->add($childRole);
            $childPermission = $rbac->getPermission("childPermission");
            $rbac->addChild($childRole, $childPermission);
        }
        
        $childPermission = $rbac->getPermission("childPermission");
        $childRole = $rbac->getRole("childRole");
        if (!$rbac->hasChild($childRole, $childPermission));
        {
            $rbac->addChild($childRole, $childPermission);
        }
    }
}