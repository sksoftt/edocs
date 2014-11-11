<?php
 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div>
    <?php 
        
        //start form - can receive html options
        $form = ActiveForm::begin(["method" => "post"]);
        
        // receiving model and attribute name. Retrieve rules and create JavaScript
        // JS script check it on client-side.
        print $form->field($model, "code");// lable avobe the field
        print $form->field($model, "name");// lable avobe the field
        print $form->field($model, "population");
        
        print Html::submitButton();
        ActiveForm::end();
    ?>
</div>

