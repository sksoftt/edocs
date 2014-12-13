<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

print yii\helpers\Html::encode("Please input field bellow: <br>");

$form = ActiveForm::begin(["id" => "loginForm"]);

print $form->field($model, "user_name");
print $form->field($model, "user_password")->passwordInput();
print $form->field($model, "user_email");
//print $form->field($model,'user_email')->widget(DatePicker::className(),['clientOptions' => ['defaultDate' => '2014-01-01']]);

print Html::submitButton("Submit form");
ActiveForm::end();


