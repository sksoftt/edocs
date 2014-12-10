<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

print yii\helpers\Html::encode("Please input field bellow: <br>");

$form = ActiveForm::begin(["id" => "loginForm"]);

print $form->field($model, "user_name");
print $form->field($model, "user_password")->passwordInput();
print $form->field($model, "user_email");

print Html::submitButton("Submit form");
ActiveForm::end();


