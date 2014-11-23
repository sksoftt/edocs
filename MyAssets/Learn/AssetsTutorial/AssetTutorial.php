<?php

/*
 * Asset в YII это файл содержащий CSS или JS. Если заявить о нем в Виде, то он
 * предстваит все эти файлы.
 * 
 * AssetsBundle - это класс, который содержит в себе несколько других Ассетов
 */

namespace app\MyAssets\Learn\AssetsTutorial;

class AssetsTutorial
    extends \yii\web\AssetBundle
{
    public $sourcePath = "@webroot/MyAssets/Learn/AssetsTutorial";
    public $basePath = "@webroot/MyAssets/Learn/AssetsTutorial";
    public $baseUrl = "@webroot/MyAssets/Learn/AssetsTutorial";
    public $css =
    [
        
    ];
    
    public $js = ["js/1.js",];
    
    public $depends = [];
}


