<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
?>

<div>
    <h1>Countries: </h1>
    <ul>
    <?php 
    foreach ($countries as $country)
    { ?>
        <li>
            <?php print Html::encode($country->name." ".$country->code);?>
            <?php print Html::encode("Population: ".$country->population);?>
        </li>
    <?php
    }
    ?>
    </ul>
    
    <div>
        <?php 
           print  LinkPager::widget(["pagination" => $pages]);
        ?>
    </div>
</div>

