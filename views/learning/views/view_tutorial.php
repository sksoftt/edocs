<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier; //make encode and save string (better that html::encode), but it is not fast

$content = "Hello world! <script>alert('Broken!');</script><br>";
//print $content;
print Html::encode($content);
//print yii\helpers\HtmlPurifier::process($content);

