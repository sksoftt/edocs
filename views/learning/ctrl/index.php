<?php
use yii\helpers\Html;


if (!isset($message))
{
    print Html::encode("This is Controller tutrial rendered from view.");
    return;
}

print Html::encode($message);