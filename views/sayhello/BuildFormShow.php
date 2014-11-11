<?php

use yii\helpers\Html;

?>

<div>
    
    <p><?php print Html::encode("You have entered following vars: ");?></p>
    <ul>
        <?php
        foreach ($model as $key=>$value)
        {
            if ($value != null)
            {
            ?>
        <li>
            <?php print Html::encode($key.": ".$value);?>
            
        </li>
       <?php
       
            }
        }
        ?>
    </ul>
</div>