<?php

/*
 * Asset в YII это файл содержащий CSS или JS. Если заявить о нем в Виде, то он
 * предстваит все эти файлы.
 * 
 * AssetsBundle - это класс, который содержит в себе несколько других Ассетов
 * 
 * Чтобы использовать AssetsBundle его надо зарегистрировать в Представлении
 * в данном примере:
 * use app\MyAssets\Learn\AssetsTutorial\AssetTutorial; - путь к классу
 * AssetTutorial::register($this): $this - этор объект представления.
 */


namespace app\controllers\learning;

class AssetsController
    extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render("index");
    }
}

