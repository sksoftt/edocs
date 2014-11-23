<?php

/*
 * Asset в YII это файл содержащий CSS или JS. Если заявить о нем в Виде, то он
 * предстваит все эти файлы.
 * 
 * AssetsBundle - это класс, который содержит в себе несколько других Ассетов
 */

namespace app\MyAssets\Learn\AssetsTutorial;

class AssetTutorial
    extends \yii\web\AssetBundle
{
//    public $sourcePath = "@app\MyAssets\Learn\AssetsTutorial";
    public $basePath = "@webroot";
    public $baseUrl = "@web/MyAssets/Learn/AssetsTutorial";
    public $css =
    [
        
    ];
    
    public $js = ["js/1.js",];
    
    public $depends = [];
}


