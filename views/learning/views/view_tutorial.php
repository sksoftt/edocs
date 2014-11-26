<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier; //make encode and save string (better that html::encode), but it is not fast

$content = "Hello world! <script>alert('Broken!');</script><br>";
//print $content; - самый небезопасный способ вывода данных пользователя
print Html::encode($content); // нейтрализует специальные символы, делая их неактивными.
print yii\helpers\HtmlPurifier::process($content); //медленная функция, но полностью убирает опасные символы

// вызвать вид с любого места в программе
//print \Yii::$app->view->renderFile("@app/views/site/index.php");

// $this->context  содержит контроллер, предоставляя доступ и его публичиным свойствам
print $this->context->message;

$this->params["breadcrumbs"][] = ['label' => 'Tutorial', 'url' => ['/learning/views']];

// передача данных между различными видами. 
// по этому же принципу работает и breadcrums
$this->params["some data"] = "Some data";

// рендериг другого вида из вида.
print $this->render("view_tutorial2");


//LAYOUTS
//Вложение одного шаблона в другой.
$this->beginContent("@app/views/layout/parent_layout");
    // Here is the code of child-layout
$this->endContent();

/*
 * BLOCKS
 * Блок может быть создан в одном месте, но показан в другом, например
 * создан во view, а показан в layout-е.
 */
$this->beginBlock("block_name");
    //содержимое блока.
$this->endBlock();

//потом в layout-e
if (isset($this->blocks["block_name"]))
{
    print $this->block["block_name"];
}
else
{
    print "Если блока не существует, то можно вывести код по умолчанию";
}

$this->title = " вносим заголовок в виде";
print $this->title; //выводим заголовок в layout-e

$this->registerMetaTag(["carset" => "UTF=8"]);
$this->registerLinkTag([
    'title' => 'Сводка новостей по Yii',
    'rel' => 'alternate',
    'type' => 'application/rss+xml',
    'href' => 'http://www.yiiframework.com/rss.xml/',
]);