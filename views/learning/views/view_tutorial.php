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