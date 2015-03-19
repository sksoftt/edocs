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
            
            $childPermission = $rbac->getPermission("childPermission");
            $parentPermission = $rbac->getPermission("parentPermission");
            $rbac->addChild($childRole, $parentPermission);
        }
        
        $childPermission = $rbac->getPermission("childPermission");
        $parentPermission = $rbac->getPermission("parentPermission");
        $childRole = $rbac->getRole("childRole");
        
        if (!$rbac->hasChild($childRole, $parentPermission))
        {
            $rbac->addChild($childRole, $parentPermission);
        }
    }
    
    /*
     * assign roles to user before testing
     */
    public function actionAssign()
    {
        $rbac = new \yii\rbac\DbManager();
        $id = \Yii::$app->user->identity->user_id;
        
//        $childRole = $rbac->getRole("childRole");
//        $res = $rbac->assign($childRole, $id);
//
        $childPermission = $rbac->getPermission("childPermission");
//        $parentPermisstion = $rbac->getPermission("parentPermission");
        $childRole = $rbac->getRole("childRole");
//        
//        $rbac->removeChild($childRole, $childPermission);
//        $rbac->addChild($childRole, $parentPermisstion);
        
        $thirdRule = new \app\MyRbac\ThirdRule();
        $rbac->add($thirdRule);
        
        $secParentPermission = $rbac->createPermission("secParentPermission");
        $secParentPermission->description = "Second parent permission";
        $secParentPermission->ruleName = "thirdRule";
        
        
        $rbac->add($secParentPermission);
        $secParentPermission = $rbac->getPermission("secParentPermission");
        $rbac->addChild($secParentPermission, $childPermission);
        $rbac->addChild($childRole, $secParentPermission);
        

        
    }
    
    public function actionF()
    {
        $rbac = new \yii\rbac\DbManager();
        $user = \Yii::$app->user->identity;
        if (\Yii::$app->user->can("childPermission"))
        {
            print "User can!";
            return;
        }
        print "User can't.";
    }
}

/*
 * 1. К parentPermission добавлено Разрешение childPermission. Разрешения добавлены ролям соответстввенно.
 *    К пользователю Child добавляем роль childRole. Запускаем проверку user->can("childPermission")
 *    Сработали правила childRule. parentRule не запустился, разрешение дано. 
 *    При проверке на parentPermission разрешения нету.
 *    
 * 2. К parentPermission добавлено Разрешение childpermission. Дабавляем parentPermission к childRole
 *    и проверяем parentPermission - роль есть и срабатывает только ее правило. 
 *    Проверяем childPermission - производится проверка childpermission и parentPermission 
 * 
 * 3. Создал еще одно правило $secParentPermission и добавил его родителем к $childPermission.
 *    В случаях когда проверяется user->can("secParentPermission"), то как и полодено проверяется первое правило.
 *    Когда же проверяется $childPermission, то будет проверяться $childPermission и все его родители до первого
 *    вернувшего true, 
 * 
 * 4. Проверки происходят от Чилда к Паренту назначенному определенной Роли. 
 *    Таким образом ПАРЕНТ ДОПОЛНЯЕТСЯ ЧИЛДАМИ.
 *    Т.е. Если речь идет о Разрегениях, то самое легкое разрешение (которое добавляется админам
 *    или более привелегированным пользователям) должно быть Чилдом более строго Разрегения,
 *    (которое добавляется менее привелегированным пользователям). Разрегение Парент, получает 
 *    ограничения всех Чилдов в его иерархии. Потому что, делается проверка на самый младший Чилд 
 *    и она будет проходить по всем Чилдам пока не дойдет до Парента Данного той Роли.
 *     
 *    Что же касается РОЛЕЙ. То, если мы хотим Чтобы Админ получил Разрешения других Ролей
 *    то он должен стать их Парентом. Тогда, по логике YII проверка будет проходить от Чилда
 *    к Паренту пока не дойдет до главного Парента - Админа. Таким образом
 *    точно также, как и Разрешение Парент получает ограничения (Правила Rules) Разрегений чилодов в его иерархии,
 *    так и Роль Парент получает Разрешения всех Чилдов Ролей.
 *    
 *    
 */