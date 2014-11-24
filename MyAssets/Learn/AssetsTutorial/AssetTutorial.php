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
    public $basePath = "@webroot";
    public $baseUrl = "@web/MyAssets/Learn/AssetsTutorial";
    public $css =
    [
        
    ];
    
    public $js = ["js/1.js",];
    
    public $depends = [];
    
    public function setOptions()
    {
        $this->jsOptions = [];
        
//    The HTML attributes for the script tag. The following options are specially 
//    handled and are not treated as HTML attributes:
//
//    depends: array, specifies the names of the asset bundles that this JS file depends on.
//    position: specifies where the JS script tag should be inserted in a page. 
//    The possible values are:
//        POS_HEAD: in the head section
//        POS_BEGIN: at the beginning of the body section
//        POS_END: at the end of the body section. This is the default value.
        
        $this->cssOptions = [];
        
//    condition: specifies the conditional comments for IE, e.g., lt IE 9. 
//    When this is specified, the generated link tag will be enclosed within the conditional 
//    comments. This is mainly useful for supporting old versions of IE browsers.
//    noscript: if set to true, link tag will be wrapped into <noscript> tags.


    }
}


