<?php
use yii\helpers\Html;
?>
<div>
    <p>
        User entered: <?php print $received;?>
    </p>
    
    <p>
        <?php Html::encode("User entered: ".$received);?>
    </p>
</div>